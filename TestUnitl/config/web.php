<?php
/**
* Created by PhpStorm.
* User: eson
* Date: 2018/12/25
* Time: 上午10:25
*/

$pic = require __DIR__ . "/pic.php";

return [
    /*域名地址*/
    'api_host_url' => 'http://dev.rongyipiao.com/',
    /*测试发送邮件模式*/
    'test_sending_mail_mode' => FALSE,
    /*yii框架的session加密token令牌*/
    'cookieValidationKey' => 'krvhP2NNZtIM1DnNgiNi1Yu-U0QUZGIM',
    /*缓存redis配置*/
    'redis' => [
        'host' => '127.0.0.1',
        'port' => 6379,
    ],
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
    /*文章模块*/
    /*文章推荐*/
    'api_ArticleRecommend' => [
        'url' => 'api/article/recommend',
        'param' => [
            'num' => 0,
        ]
    ],
    /*获取用户文章目录*/
    'api_ArticleShowList' => [
        'url' => 'api/article/showlist',
        'param' => [
            'username' => '1092917203',
        ]
    ],
    /*获取用户当前文章列表简介*/
    'api_ArticleList' => [
        'url' => 'api/article/list',
        'param' => [
            'page' => '1',
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
    /*获取文章标签*/
    'api_ArticleGetag' => [
        'url' => 'api/article/getag',
        'param' => [
            'id' => '662'
        ]
    ],
    /*获取常用标签*/
    'api_ArticleGetags' => [
        'url' => 'api/article/getags',
        'param' => []
    ],
    /*评论模块*/
    /*文章评论添加*/
    'api_CommentAdd' => [
        'url' => 'api/comment/add',
        'param' => [
            'comment_id' => 0,
            'user_id' => 1,
            'aid' => 352,
            'content' => 'PHPUntil',
            'nickname' => 'eson',
            'source_id' => 0,
            'floor' => 0
        ]
    ],
    /*文章评论查看*/
    'api_CommentShow' => [
        'url' => 'api/comment/show',
        'param' => [
            'aid' => 352,
            'num' => 0,
        ]
    ],
    /*评论点赞*/
    'api_CommentLike' => [
        'url' => 'api/comment/like',
        'param' => [
            'cid' => 55
        ]
    ],
    /*文章Markdown模块*/
    /*获取hash版本号*/
    'api_MarkdownVersion' => [
        'url' => 'api/markdown/version',
        'param' => []
    ],
    /*发送md文章*/
    /*add*//*注意version参数需要依赖api_MarkdownVersion的返回值*/
    'api_MarkdownRelease_add' => [
        'url' => 'api/markdown/release',
        'param' => [
            'aid' => '',
            'main' => 'PHPUntil add',
            'path' => './PHPUntil.md',
            'mod' => 'add',
        ]
    ],
    /*修改md文章*/
    /*edit*//*注意version&aid参数需要依赖api_MarkdownRelease_add的返回值*/
    'api_MarkdownRelease_edit' => [
        'url' => 'api/markdown/release',
        'param' => [
            'main' => 'PHPUntil edit',
            'path' => './PHPUntil.md',
            'mod' => 'edit',
        ]
    ],
    /*重命名md文章*/
    /*rename*//*注意version参数需要依赖api_MarkdownRelease_edit的返回值*/
    'api_MarkdownRename' => [
        'url' => 'api/markdown/rename',
        'param' => [
            'old_name' => './PHPUntil.md',
            'new_name' => './PHPUntilRename.md'
        ]
    ],
    /*创建md文件夹目录*/
    /*adddir*//*注意version参数需要依赖api_MarkdownRename的返回值*/
    'api_MarkdownDirAdd' => [
        'url' => 'api/markdown/diradd',
        'param' => [
            'dir_path' => './a/b/c/test',
            'base_path' => './a/b/c/',
            'dir_name' => 'test'
        ]
    ],
    /*删除md文章*/
    /*del*//*注意version参数需要依赖api_MarkdownRename的返回值*/
    'api_MarkdownDel' => [
        'url' => 'api/markdown/del',
        'param' => [
            'paths' => [
                './PHPUntilRename.md',
                './a/b/c/test/__create_dir.md'
            ]
        ]
    ],
    /*消息模块 - 尚未完成*/
    /*发送消息*/
    'api_MessageSend' => [],
    /*查看消息*/
    'api_MessageShow' => [],
    /*消息状态修改*/
    'api_MessageState' => [],
    /*消息状态批量修改*/
    'api_MessageStates' => [],
    /*举报模块*/
    /*举报信息*/
    'api_Report' => [
        'url' => 'api/report/index',
        'param' => [
            'id' => 352,
            'ip' => '127.0.0.1',
            'type' => 1,
            'info' => 'PHPUntil test'
        ]
    ],
    /*验证码模块*/
    /*验证码*/
    'api_VcodeTmp' => [
        'url' => 'api/vcode/tmp',
    ],
    /*用户模块*/
    /*电话号码注册*//*基境问题------------------*/
    'api_UserTelregister' => [
        'url' => 'api/user/Telregister',
        'param' => []
    ],
    /*发送手机验证码*/
    'api_UserTelCode' => [
        'url' => 'api/user/telcode',
        'param' => [
            'tel' => '13980812761'
        ]
    ],
    /*电子邮箱注册*//*基境问题------------------*/
    'api_UserEmailregister' => [
        'url' => '',
        'param' => []
    ],
    /*发送邮箱验证码*/
    'api_Emailcode' => [
        'url' => 'api/user/emailcode',
        'param' => [
            'email' => '834767372@qq.com'
        ]
    ],
    /*检查用户信息是否正确*/
    'api_UserCheckout' => [
        'url' => 'api/user/checkout',
        'param' => []
    ],
    /*获取用户信息*/
    'api_UserGetuserinfo' => [
        'url' => 'api/user/getuserinfo',
        'param' => []
    ],
    /*gogs密码修改*//*基境问题------------------*/
    'api_UserGogspass' => [
        'url' => 'api/user/gogspass',
        'param' => [
            "gogs_mi" => '123'
        ]
    ],
    /*用户中心模块*/
    /*昵称修改*/
    'api_UserinfoNick' => [
        'url' => 'api/userinfo/nick',
        'param' => []
    ],
    /*头像修改*/
    'api_UserinfoPic' => [
        'url' => 'api/userinfo/pic',
        'param' => [
            'base64' => $pic
        ]
    ],
    /*邮箱修改*//*基境问题*/
    /*手机修改*//*基境问题*/
    /*解除绑定*//*基境问题*/
    /*重置密码*//*基境问题*/
    /*作者推荐*/
    'api_UserinfoRecommend' => [
        'url' => 'api/userinfo/recommend',
        'param' => []
    ],
    /*换一换作者推荐*/
    'api_UserinfoChange' => [
        'url' => 'api/userinfo/change',
        'param' => [
            's' => 1
        ]
    ],
    /*所有作者查看*/
    'api_UserinfoAllrecommend' => [
        'url' => 'api/userinfo/allrecommend',
        'param' => []
    ],
    /*模糊匹配作者查询*/
    'api_UserinfoLookup' => [
        'url' => 'api/userinfo/lookup',
        'param' => [
            'like' => 'es'
        ]
    ],
    /*作者关注*/
    'api_UserinfoFollow' => [
        'url' => 'api/userinfo/follow',
        'param' => [
            'fuid' => 3
        ]
    ],
    /*获取关注信息*/
    'api_UserinfoGetfollow' => [
        'url' => 'api/userinfo/getfollow',
        'param' => []
    ],
    /*前后端同步登陆session*/
    'api_UserSynchrodata' => [
        'url' => 'api/user/synchrodata',
        'param' => [
            'id' => 1
        ]
    ],
];