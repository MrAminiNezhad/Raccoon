<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    die('403');
}
return [
    "panel_url" => "https://panel.com:2020/",
    "panel_user" => "admin",
    "panel_pass" => "admin",
    "nopanel" => 1
];
