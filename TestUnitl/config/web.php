<?php
/**
* Created by PhpStorm.
* User: eson
* Date: 2018/12/25
* Time: 上午10:25
*/

return [
    /*域名地址*/
    'api_host_url' => 'http://dev.rongyipiao.com/',
    /*测试发送邮件模式*/
    'test_sending_mail_mode' => FALSE,
    /*报警邮件*/
    'mail' => [
        'from' => [
            /*发送邮件相关配置*/
            'uname'     => 'ngcache@163.com',/*邮箱账号*/
            'passd'     => 'qwer0987',/*第三方授权码*/
            'address'   => 'ngcache@163.com',/*邮件来自地址*/
            'name'      => 'ngcache',/*邮箱来自名称*/
        ],
        'send' => [
            /*收件人配置*/
            '834767372@qq.com',
            '864521657@qq.com'
        ]
    ],
    /*登录*/
    'api_login' => [
        'url' => 'api/user/login',
        'param' => [
            "username" => "13980812761",
            "password" => "123"
        ]
    ],
    /*退出登录*/
    'api_logout' => [
        'url' => 'api/user/logout',
        'param' => []
    ],
    /**/
];