<?php

function url_encode_full($value)
{
    return implode("", array_map(function ($i) {
        return sprintf("%%%X", ord($i));
    }, str_split($value)));
}
function run_login_script($panel, $cookie_file)
{



    $url = $panel['panel_url'] . 'login';
    $data = ['username' => $panel['panel_user'], 'password' => $panel['panel_pass']];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $response = curl_exec($ch);
    if ($response === false) throw new Exception("خطا در اجرای مرحله ورود به پنل: " . curl_error($ch));
    curl_close($ch);
}


function client_info(array $info, string $type)
{


    $current_date = new DateTime();

    if ($type === 'xpanel') {



        if ($info['message'] === "Not Exist User") {
            include __DIR__ . '/notfound.html';
            die;
        }
        $info = $info[0];
        $config_status = $info['status'] == 'active' ? '🟢' : '🔴';
        $total = number_format($info['traffic'] / 1024, 2);
        $down = number_format($info['traffics'][0]['download'] / 1024, 2);
        $up = number_format($info['traffics'][0]['upload'] / 1024, 2);
        $remaning_traffic =  number_format(($info['traffic'] - $info['traffics'][0]['total']) / 1024, 2);


        $interval = $current_date->diff(new DateTime($info['end_date']));
        $remaining_days = $interval->days;

        $expiry_time_str = jdate($info['end_date']);
    } else {

        if ($info['obj'] === null) {
            include __DIR__ . '/notfound.html';
            die;
        }
        $up = number_format($info['obj']['up'] / (1024 * 1024 * 1024), 2);
        $down = number_format($info['obj']['down'] / (1024 * 1024 * 1024), 2);
        $total = number_format($info['obj']['total'] / (1024 * 1024 * 1024), 2);
        $total2 = number_format($info['obj']['total'] / (1024 * 1024 * 1024), 2);
        if ($total == 0) {
            $total = "نامحدود ";
        } else {
            $total = number_format($info['obj']['total'] / (1024 * 1024 * 1024), 2);
        }


        $expiry_time = $info['obj']['expiryTime'];
        if ($expiry_time === 0) {
            $expiry_time_str = "نامحدود ";
        } else {
            $expiry_datetime = new DateTime();
            $expiry_datetime->setTimestamp($expiry_time / 1000);

            $jalali_expiry = jdate('Y/m/d H:i:s', $expiry_datetime->getTimestamp());
            $expiry_time_str = $jalali_expiry;
        }

        $total_traffic = $up + $down;
        $expiry_date = $expiry_datetime;

        $remaning_traffic = $total - $total_traffic;
        if ($total2 <= 0) {
            $remaning_traffic = "نامحدود ";
        } else {
            $remaning_traffic = number_format($remaning_traffic, 2);
        }

        $interval = $current_date->diff($expiry_date);
        $remaining_days = $interval->days;

        if ($expiry_time === 0) {
            $remaining_days = "نامحدود ";
        } else {
            $interval = $current_date->diff($expiry_date);
            $remaining_days = $interval->days;

            if ($remaining_days <= 0 || $expiry_date < new DateTime()) {
                $remaining_days = 0;
            }
        }

        $enable = $info['obj']['enable'];
        $status = $enable === true ? 'فعال' : 'غیرفعال';
        $enable = $info['obj']['enable'];
        $config_status = $enable === true ? '🟢' : '🔴';
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
