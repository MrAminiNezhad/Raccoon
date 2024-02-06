<?php
session_start();

$max_requests = 100;
$time_interval = 60;
$ban_duration = 20 * 60;

if (!isset($_SESSION['request_count'])) {
    $_SESSION['request_count'] = 0;
    $_SESSION['request_start_time'] = time();
}

$_SESSION['request_count']++;

if ($_SESSION['request_count'] > $max_requests) {
    $elapsed_time = time() - $_SESSION['request_start_time'];
    if ($elapsed_time < $time_interval) {
        header(include __DIR__ . '/../assets/ban.html');
        exit;
    } else {
        $_SESSION['request_count'] = 1;
        $_SESSION['request_start_time'] = time();
    }
}


function run_login_script($panel, $cookie_file)
{
    if (in_array($panel['type'], ['sanaei', 'alireza', 'xpanel']) === false) throw new Exception('wrong panel type');
    if ($panel['type'] == 'xpanel') return;


    $url = $panel['panel_url'] . 'login';
    $data = ['username' => $panel['user'], 'password' => $panel['pass']];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        throw new Exception(curl_error($ch));
    }

    if (strpos($response, '"success":false') !== false) throw new Exception($response);
    curl_close($ch);
}


function update_users()
{
    global $db, $panels;




    $db->delete('user', []);
    $db->delete('data_time', []);

    $db->insert('data_time', ['data_time' => $db->raw('CURRENT_TIMESTAMP')]);


    foreach ($panels as $panel) {


        run_login_script($panel, '.cookie.txt');

        $final_url =  [
            'sanaei' => $panel['panel_url'] . 'panel/api/inbounds/list',

            'alireza' => $panel['panel_url'] . 'xui/API/inbounds/',

            'xpanel' => $panel['panel_url'] . "api/{$panel['api-key']}/listuser",
        ];

        $ch = curl_init($final_url[$panel['type']]);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($panel['type'] !== 'xpanel') curl_setopt($ch, CURLOPT_COOKIEFILE, '.cookie.txt');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $response = json_decode(curl_exec($ch), true);

        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }

        curl_close($ch);

        unlink('.cookie.txt');

        if ($panel['type'] == 'xpanel') {
            foreach ($response as $user) {



                $config_status = $user['status'] == 'active' ? true : false;


                $expire_time = $user['end_date'] == null ? 0 : $user['end_date'];

                $db->insert('user', [
                    'username' => $user['username'],
                    'status' => $config_status,
                    'total_traffic' => $user['traffic'],
                    'download' => $user['traffics'][0]['download'],
                    'upload' => $user['traffics'][0]['upload'],
                    'expire_time' => $expire_time
                ]);
            }
        } else {


            foreach ($response['obj'] as $inbound) {



                foreach ($inbound["clientStats"] as $user) {

                    $total = $user['total'] / (1024 * 1024);
                    $up = $user['up'] / (1024 * 1024);
                    $down = $user['down'] / (1024 * 1024);


                    $expire_time = $user['expiryTime'] == 0  ? 0 : date('Y-m-d H:i:s', $user['expiryTime'] / 1000);



                    foreach (json_decode($inbound['settings'], true)['clients'] as $user_conf) {
                        if ($user_conf['email'] == $user['email']) {
                            $id = $user_conf['id'];
                            break;
                        }
                    }

                    $db->insert('user', [
                        'username' => strtolower($user['email']),
                        'uuid' => $id ?? null,
                        'status' => $user['enable'],
                        'total_traffic' => $total,
                        'download' => $down,
                        'upload' => $up,
                        'expire_time' => $expire_time
                    ]);
                }
            }
        }
    }
}

function client_info($username = null, $uuid = null)
{

    global $db;

    $current_date = new DateTime();


    $data_time = $db->select('data_time', 'data_time')[0];

    if ($data_time == null) {
        update_users();
    } else {
        $data_time = new DateTime($data_time);


        $minutesDifference = ($current_date->getTimestamp() - $data_time->getTimestamp()) / 60;
        if ($minutesDifference > 5) update_users();
    }




    if ($uuid !== null) {
        $info = $db->select('user', '*', ['uuid' => $uuid])[0];
    } else {

        $info = $db->select('user', '*', ['username' => strtolower($username)])[0];
    }


    if ($info == null) {

        http_response_code(404);
        include __DIR__ . '/../assets/notfound.html';
        die;
    }




    $config_status = $info['status'] == true ? 'فعال 🟢' : 'غیر فعال 🔴';

    if ($info['total_traffic'] ==  0) {
        $total = "♾️";
        $remaning_traffic  = "♾️";
    } else {



        $total = number_format($info['total_traffic'] / 1024, 2);
        $remaning_traffic =  number_format(($info['total_traffic'] - ($info['download'] + $info['upload'])) / 1024, 2);
    }

    $down = number_format($info['download'] / 1024, 2);
    $up = number_format($info['upload'] / 1024, 2);

    if ($info['expire_time'] == 0) {
        $expiry_time_str = "♾️";
        $remaining_days  = "♾️";
    } else {
        $time = new DateTime($info['expire_time']);
        if ($time < $current_date) {
            $remaining_days = 0;
        } else {

            $interval = $current_date->diff($time);
            $remaining_days = $interval->days;
        }



        $expiry_time_str = jdate('Y-m-d', strtotime($info['expire_time']));
    }
    return [
        'username' => $info['username'],
        'status' => $config_status,
        'total' => $total,
        'traffic_used' => $up + $down,
        'download' => $down,
        'upload'  => $up,
        'remaining_traffic' => $remaning_traffic,
        'remaining_days' => $remaining_days,
        'expire_time' => $expiry_time_str
    ];
}