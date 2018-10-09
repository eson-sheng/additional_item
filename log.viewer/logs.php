<?php
// 复制此文件到logs.php进行配置，eg：
$paths = [
	'/home/www/mynote/basic/runtime/logs/.api_info.log',//接口请求信息
	'/home/www/mynote/basic/runtime/logs/.curl_error.log',//curl 模块错误消息
        '/home/www/mynote/basic/runtime/logs/.shell.log',//shell 执行日志
	'/home/www/mynote/basic/runtime/logs/app.log',//mynote 项目错误日志
	'/home/www/mynote/basic/runtime/logs/ct.txt',//ct 日志
        '/usr/local/mariadb/var/mariadb.err',//mysql 错误日志
        '/tmp/mysql.log',//mysql 查询日志
];

$read_size = 50000;

