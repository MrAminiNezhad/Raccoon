<?php

error_reporting(E_ERROR);

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    http_response_code(403);
    die;
}
require './static/Medoo.php';


use Medoo\Medoo;

$db = new Medoo([

    'type' => 'sqlite',
    'database' => '.db.db'

    // if using mysql instead of sqlite

    /*

    'type' => 'mysql',
    'database' => 'test',
    'username' => 'admin',
    'password' => 'admin'


    */



]);

$crisp = "ID"; // crisp id
$goftino = "ID"; // $goftino id
$raychat = "ID"; // raychat id

$panels = [

    [

        "panel_url" => "https://panel.com:2020/",
        "type" => "sanaei", // choose type between  [sanaei,alireza,xpanel]
        "user" => "admin",
        "pass" => "admin",
        "api-key" => '', // for xpanel only
    ],
    /*
    [

        "panel_url" => "https://panel.com:2020/",
        "type" => "sanaei", // choose type between  [sanaei,alireza,xpanel]
        "user" => "admin",
        "pass" => "admin",
        "api-key" => '', // for xpanel only
    ],
    */
    // add a list just like this for multi panels
];

$db->create('user', [
    'username' => 'TEXT',
    'uuid' => 'TEXT',
    'status' => 'BOOLEAN',
    'total_traffic' => 'INT',
    'download' => 'INT',
    'upload' => 'INT',
    'expire_time' => 'TIMESTAMP'
]);

$db->create('data_time', ['data_time' => 'TIMESTAMP']);
