<?php

// run this with cronjob every 1 day , 10 hours depends on your usage
// every time you run cron.php it updates list of client of servers 

require __DIR__ . '/config.php';
require __DIR__ . '/static/functions.php';

$db->drop('user');
$db->create('user', [
    'username' => 'TEXT',
    'uuid' => 'TEXT',
    'status' => 'BOOLEAN',
    'total_traffic' => 'INT',
    'download' => 'INT',
    'upload' => 'INT',
    'expire_time' => 'TIMESTAMP'

]);

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


                $expire_time = $user['expiryTime'] == 0  ? 0 : date('Y-m-d H:i:s', $expiry_time = $user['expiryTime'] / 1000);

                foreach (json_decode($inbound['settings'], true)['clients'] as $user_conf) {
                    if ($user_conf['email'] == $user['email']) {
                        $id = $user_conf['id'];
                        break;
                    }
                }

                $db->insert('user', [
                    'username' => $user['email'],
                    'uuid' => $id,
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
