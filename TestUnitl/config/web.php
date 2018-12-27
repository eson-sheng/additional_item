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
    /*文章推荐*/
    'api_ArticleRecommend' => [
        'url' => 'api/article/recommend',
        'param' => [
            'num' => 0,
        ]
    ],
    /*获取用户文章目录*/
    'api_ArticleShowlist' => [
        'url' => 'api/article/showlist',
        'param' => [
            'username' => '1092917203',
        ]
    ],
    /*获取文章详情页*/
    'api_ArticleShow' => [
        'url' => 'api/article/show',
        'param' => [
            'id' => 352,
        ]
    ],
    /*文章浏览量记录*/
    'api_ArticleAddpv' => [
        'url' => 'api/article/addpv',
        'param' => [
            'aid' => 352,
            'uid' => 1,
            'ip' => '127.0.0.1',
            'referer' => 'http://shengxuecheng.cn/',
        ]
    ],
    /*文章点赞*/
    'api_ArticleLike' => [
        'url' => 'api/article/like',
        'param' => [
            'aid' => 352
        ]
    ],
    /*文章附录信息*/
    'api_ArticleInfo' => [
        'url' => 'api/article/info',
        'param' => [
            'aid' => 352
        ]
    ],
    /*轮播图推荐*/
    'api_ArticleLunbotu' => [
        'url' => 'api/article/lunbotu',
        'param' => [
        ]
    ],
    /*轮播图添加*/
    'api_ArticleLunbotuAdd' => [
        'url' => 'api/article/lunbotuadd',
        'param' => [
            'id' => 0,
            'imgsrc' => '1',
            'href' => '1',
        ]
    ],
    /*文章统计汇总*/
    'api_ArticleCount' => [
        'url' => 'api/article/count',
        'param' => [
            'a' => 'a'
        ]
    ],
    /*文章索引*/
    'api_ArticleCatalog' => [
        'url' => 'api/article/catalog?pageNo=2'
    ],
    /**/
];