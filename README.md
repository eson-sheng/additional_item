# 项目`additional_item`仓库地址：
> 日志性能辅助项目：
`git@47.97.186.229:eson/additional_item.git`

## 部署步骤
 - 在`mynote`数据库中执行`./additional_item/log_analysis/sql/create.sql`
 - 配置文件添加修改:
 
 1 . `./additional_item/log_analysis/runner.my.php`
 
 ```shell
 vim ./additional_item/log_analysis/runner.my.php
 ```
 内容示例，返回数组：

```php
<?php 
// $items = [];

// please config $items in runner.my.php !

$items = [
    [
        "api" => "mynote_login/process.php", //固定写
        "path" => "/Users/eson/www_nginx/app/mynote/mynote/basic/runtime/seaslog/login" //实际情况写
    ],
    [
        "api" => "mynote_log/process.php", //固定写
        "path" => "/Users/eson/www_nginx/app/mynote/mynote/basic/runtime/seaslog/api" //实际情况写
    ],
    [
        "api" => "mynote_log/process.php", //固定写
        "path" => "/Users/eson/www_nginx/app/mynote/mynote/basic/runtime/seaslog/curl" //实际情况写
    ],
    [
        "api" => "mynote_log/process.php", //固定写
        "path" => "/Users/eson/www_nginx/app/mynote/mynote/basic/runtime/seaslog/shell" //实际情况写
    ],
    [
        "api" => "mynote_request/process.php", //固定写
        "path" => "/Users/eson/www_nginx/app/mynote/mynote/basic/runtime/logs/logs.txt" //实际情况写
    ]
];

$base_url = "http://localhost/app/mynote/additional_item/log_analysis/"; //实际情况写
```

2 .  `./additional_item/log.viewer/logs.php`

```shell
cd ./additional_item/log.viewer
cp logs_tmpl.php logs.php
vim logs.php
```

文件内容：(按照实际情况来填写)

```php
<?php
// 复制此文件到logs.php进行配置，eg：
$paths = [
    '/usr/local/var/mysql/general_log.log', // mysql 执行语句 临时日志
    '/usr/local/var/www/app/mynote/mynote/basic/runtime/logs/app.log', // mynote 报错日志
];

$read_size = 50000;
```
