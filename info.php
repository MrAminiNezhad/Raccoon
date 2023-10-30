<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    http_response_code(403);
    die('403');
}
return [
    "panel_url" => "https://panel.com:2020/",
    "panel_user" => "admin",
    "panel_pass" => "admin",
    "nopanel" => 1
];
