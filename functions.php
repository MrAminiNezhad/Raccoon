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

    if ($response === false) return false;

    curl_close($ch);
}
