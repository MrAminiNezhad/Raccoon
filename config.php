<?php

error_reporting(E_ERROR);

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    http_response_code(403);
    die('403');
}
require __DIR__ . '/static/Medoo.php';


use Medoo\Medoo;

$db = new Medoo([

    'type' => 'sqlite',
    'database' => 'db.db'

    // if using mysql instead of sqlite

    /*

    'type' => 'mysql',
    'database' => 'test',
    'username' => 'admin',
    'password' => 'admin'


    */



]);
$panels = [

    [

        "panel_url" => "https://panel.com:2020/",
        "type" => "sanaei", // choose type between  [sanaei,alireza,xpanel]
        "user" => "admin",
        "pass" => "admin",
        "api-key" => '', // for xpanel only
        "crisp" => "Your ID"
    ],
/*
    [

        "panel_url" => "https://panel.com:2020/",
        "type" => "sanaei", // choose type between  [sanaei,alireza,xpanel]
        "user" => "admin",
        "pass" => "admin",
        "api-key" => '', // for xpanel only
        "crisp" => "Your ID"
    ],
    */
    // add a list just like this for multi panels
];
