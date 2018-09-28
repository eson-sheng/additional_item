<?php 
// $items = [];

// please config $items in runner.my.php !

$items = [
    [
        "api" => "mynote_login/process.php",
        "path" => "/Users/eson/www_nginx/app/mynote/mynote/basic/runtime/seaslog/login"
    ],
    [
        "api" => "mynote_log/process.php",
        "path" => "/Users/eson/www_nginx/app/mynote/mynote/basic/runtime/seaslog/api"
    ],
    [
        "api" => "mynote_log/process.php",
        "path" => "/Users/eson/www_nginx/app/mynote/mynote/basic/runtime/seaslog/curl"
    ],
    [
        "api" => "mynote_log/process.php",
        "path" => "/Users/eson/www_nginx/app/mynote/mynote/basic/runtime/seaslog/shell"
    ],
    [
        "api" => "mynote_request/process.php",
        "path" => "/Users/eson/www_nginx/app/mynote/mynote/basic/runtime/logs/logs.txt"
    ]
];

$base_url = "http://localhost/app/mynote/mynote_res/log_analysis/";