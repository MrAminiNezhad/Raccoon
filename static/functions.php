<?php

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

    if (strpos($response, '"success":false') !== false) throw new Exception($response);
    curl_close($ch);
}


function client_info($username)
{

    global $db;

    $info = $db->select('user', '*', ['username' => $username])[0];

    if ($info == null) {

        http_response_code(404);
        include __DIR__ . '/../assets/notfound.html';
        die;
    }




    $current_date = new DateTime();
    $config_status = $info['status'] == true ? '🟢' : '🔴';

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
