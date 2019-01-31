<?php
require_once __DIR__ . "/Curl.php";

use PHPUnit\Framework\TestCase;

/**
 * @method markTestSkipped()
 * @method assertEquals($int, $errno)
 * @method markTestIncomplete()
 */
class StackTest extends TestCase
{
    public $config = NULL;

    public function __construct ()
    {
        /*父类调用*/
        parent::__construct();
        /*配置文件加载*/
        $config = require __DIR__ . '/config/web.php';
        if (is_file(__DIR__ . '/config/local_web.php')) {
            $local_web = require __DIR__ . '/config/local_web.php';
            $config = array_merge($config, $local_web);
        }
        $this->config = $config;
        /*启动会话*/
        @session_start();
    }

    public static function tearDownAfterClass ()
    {
        /*启动会话*/
        session_destroy();
    }

    /**
     * 调试查看参数
     * @param $url
     * @param $param
     * @param $info
     */
    public function echo_html ($url, $param, $info)
    {
        echo "<div style=\"border:1px solid lightskyblue\">";
        echo "<br>url: {$url}";
        echo "<br>param: " . http_build_query($param);
        echo "<br>return:";
        echo "<pre>";
        print_r($info);
        echo "</pre></div><hr>";
    }

    /**
     * 登录接口测试
     */
    public function testCurlForLogin ()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_login']['url']}";
        $param = $this->config['api_login']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 文章推荐
     */
    public function testCurlForArticleRecommend ()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_ArticleRecommend']['url']}";
        $param = $this->config['api_ArticleRecommend']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 获取用户文章目录
     */
    public function testCurlForArticleShowList ()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_ArticleShowList']['url']}";
        $param = $this->config['api_ArticleShowList']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 获取用户当前文章列表简介
     */
    public function testCurlForArticleList ()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_ArticleList']['url']}";
        $param = $this->config['api_ArticleList']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 获取文章详情页
     */
    public function testCurlForArticleShow ()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_ArticleShow']['url']}";
        $param = $this->config['api_ArticleShow']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 文章浏览量记录
     */
    public function testCurlForArticleAddpv ()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_ArticleAddpv']['url']}";
        $param = $this->config['api_ArticleAddpv']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 文章点赞
     */
    public function testCurlForArticleLike ()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_ArticleLike']['url']}";
        $param = $this->config['api_ArticleLike']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(-1111, $info['errno']);
    }

    /**
     * 文章附录信息
     */
    public function testCurlForArticleInfo ()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_ArticleInfo']['url']}";
        $param = $this->config['api_ArticleInfo']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 轮播图推荐
     */
    public function testCurlForArticleLunbotu ()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_ArticleLunbotu']['url']}";
        $param = $this->config['api_ArticleLunbotu']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 轮播图添加
     * @requires 添加接口跳过
     */
    public function testCurlArticleLunbotuAdd ()
    {
        $this->markTestSkipped();

        $url = "{$this->config['api_host_url']}{$this->config['api_ArticleLunbotuAdd']['url']}";
        $param = $this->config['api_ArticleLunbotuAdd']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 文章统计汇总
     */
    public function testCurlArticleCount ()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_ArticleCount']['url']}";
        $param = $this->config['api_ArticleCount']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 文章索引
     */
    public function testCurlArticleCatalog ()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_ArticleCatalog']['url']}";
        $curl = new Curltool();
        $curl->http_get($url);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, [], $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 获取文章标签
     */
    public function testCurlArticleGetag()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_ArticleGetag']['url']}";
        $param = $this->config['api_ArticleGetag']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 获取常用标签
     */
    public function testCurlArticleGetags()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_ArticleGetags']['url']}";
        $param = $this->config['api_ArticleGetags']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 添加文章标签
     * @requires 添加接口跳过
     */
    public function testCurlArticleAddtag()
    {
        $this->markTestSkipped();
    }

    /**
     * 删除文章标签
     * @requires 基境删除接口跳过
     */
    public function testCurlArticleDeltag()
    {
        $this->markTestSkipped();
    }

    /**
     * 文章评论添加
     * @requires 添加接口跳过
     */
    public function testCurlCommentAdd ()
    {
        $this->markTestSkipped();

        $url = "{$this->config['api_host_url']}{$this->config['api_CommentAdd']['url']}";
        $param = $this->config['api_CommentAdd']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 文章评论查看
     */
    public function testCurlCommentShow ()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_CommentShow']['url']}";
        $param = $this->config['api_CommentShow']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 评论点赞
     */
    public function testCurlCommentLike ()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_CommentLike']['url']}";
        $param = $this->config['api_CommentLike']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(-1111, $info['errno']);
    }

    /**
     * 获取hash版本号
     */
    public function testCurlForMarkdownVersion ()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_MarkdownVersion']['url']}";
        $param = $this->config['api_MarkdownVersion']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);

        return $info;
    }

    /**
     * 发送md文章
     * @depends testCurlForMarkdownVersion
     * @param array $stack
     * @return mixed
     */
    public function testCurlForMarkdownReleaseAdd (array $stack)
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_MarkdownRelease_add']['url']}";
        $param = $this->config['api_MarkdownRelease_add']['param'];
        $param['version'] = $stack['data'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);

        return $info;
    }

    /**
     * 修改md文章
     * @depends testCurlForMarkdownReleaseAdd
     * @param array $stack
     * @return mixed
     */
    public function testCurlForMarkdownReleaseEdit (array $stack)
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_MarkdownRelease_edit']['url']}";
        $param = $this->config['api_MarkdownRelease_edit']['param'];
        $param['version'] = $stack['data']['version'];
        $param['aid'] = $stack['data']['aid'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);

        return $info;
    }

    /**
     * 重命名md文章
     * @depends testCurlForMarkdownReleaseEdit
     * @param array $stack
     * @return mixed
     */
    public function testCurlForMarkdownRename (array $stack)
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_MarkdownRename']['url']}";
        $param = $this->config['api_MarkdownRename']['param'];
        $param['version'] = $stack['data']['version'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);

        return $info;
    }

    /**
     * 创建md文件夹目录
     * @depends testCurlForMarkdownRename
     * @param array $stack
     * @return mixed
     */
    public function testCurlForMarkdownDirAdd (array $stack)
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_MarkdownDirAdd']['url']}";
        $param = $this->config['api_MarkdownDirAdd']['param'];
        $param['version'] = $stack['data']['version'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);

        return $info;
    }

    /**
     * 删除md文章
     * @depends testCurlForMarkdownDirAdd
     * @param array $stack
     * @return mixed
     */
    public function testCurlMarkdownDel (array $stack)
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_MarkdownDel']['url']}";
        $param = $this->config['api_MarkdownDel']['param'];
        $param['version'] = $stack['data']['version'];
        $curl = new Curltool();
        $curl->http_post($url, http_build_query($param));
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);

        return $info;
    }

    /**
     * 发送消息
     */
    public function testCurlMessageSend ()
    {
        $this->markTestIncomplete();
    }

    /**
     * 查看消息
     */
    public function testCurlMessageShow ()
    {
        $this->markTestIncomplete();
    }

    /**
     * 消息状态修改
     */
    public function testCurlMessageState ()
    {
        $this->markTestIncomplete();
    }

    /**
     * 消息状态批量修改
     */
    public function testCurlMessageStates ()
    {
        $this->markTestIncomplete();
    }

    /**
     * 举报信息
     * @requires 添加接口跳过
     */
    public function testCurlReport ()
    {
        $this->markTestSkipped();

        $url = "{$this->config['api_host_url']}{$this->config['api_Report']['url']}";
        $param = $this->config['api_Report']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 验证码
     */
    public function testCurlVcode ()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_VcodeTmp']['url']}";
        $curl = new Curltool();
        $curl->http_get($url);
        $this->assertEquals(200, $curl->http_code);

        return ($this->_GetRedisForSessionArr());
    }

    /**
     * 电话号码注册
     */
    public function testCurlUserTelregister ()
    {
        $this->markTestIncomplete();
    }

    /**
     * 发送手机验证码
     */
    public function testCurlUserTelCode ()
    {
        $stack = $this->testCurlVcode();

        $url = "{$this->config['api_host_url']}{$this->config['api_UserTelCode']['url']}";
        $param = $this->config['api_UserTelCode']['param'];
        $param['vcode'] = $stack['vcode'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 电子邮箱注册
     */
    public function testCurlUserEmailregister ()
    {
        $this->markTestIncomplete();
    }

    /**
     * 发送邮箱验证码
     */
    public function testCurlEmailcode ()
    {
        $stack = $this->testCurlVcode();

        $url = "{$this->config['api_host_url']}{$this->config['api_Emailcode']['url']}";
        $param = $this->config['api_Emailcode']['param'];
        $param['vcode'] = $stack['vcode'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 检查用户信息是否正确
     */
    public function testCurlUserCheckout()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_UserCheckout']['url']}";
        $param = $this->config['api_UserCheckout']['param'];
        /*特殊参数获取*/
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
        $redis->auth('');

        $email = '834767372@qq.com';
        $code = $redis->get($email);

        $param['type'] = 'email';
        $param['code'] = $code;
        $param['number'] = $email;

        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * gogs密码修改
     * @requires 基境问题
     */
    public function testCurlUserGogspass ()
    {
        $this->markTestSkipped();

        $url = "{$this->config['api_host_url']}{$this->config['api_UserGogspass']['url']}";
        $param = $this->config['api_UserGogspass']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 前后端同步登陆session
     */
    public function testCurlForUserSynchrodata ()
    {
        $session = $this->_GetRedisForSessionArr();
        $hash = $this->_AES($session);

        $url = "{$this->config['api_host_url']}{$this->config['api_UserSynchrodata']['url']}";
        $param = $this->config['api_UserSynchrodata']['param'];
        $param['data'] = $hash;
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 获取用户信息
     */
    public function testCurlForUserGetuserinfo()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_UserGetuserinfo']['url']}";
        $param = $this->config['api_UserGetuserinfo']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 昵称修改
     */
    public function testCurlForUserNick ()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_UserinfoNick']['url']}";
        $param = $this->config['api_UserinfoNick']['param'];
        $param['nick'] = $this->_GetChangeNick();
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 头像修改
     */
    public function testCurlForUserPic ()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_UserinfoPic']['url']}";
        $param = $this->config['api_UserinfoPic']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 作者推荐
     */
    public function testCurlForUserinfoRecommend ()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_UserinfoRecommend']['url']}";
        $param = $this->config['api_UserinfoRecommend']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 换一换作者推荐
     */
    public function testCurlForUserinfoChange ()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_UserinfoChange']['url']}";
        $param = $this->config['api_UserinfoChange']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 所有作者查看
     */
    public function testCurlForUserinfoAllrecommend ()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_UserinfoAllrecommend']['url']}";
        $param = $this->config['api_UserinfoAllrecommend']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 模糊匹配作者查询
     */
    public function testCurlForUserinfoLookup ()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_UserinfoLookup']['url']}";
        $param = $this->config['api_UserinfoLookup']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 作者关注
     */
    public function testCurlForUserinfoFollow ()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_UserinfoFollow']['url']}";
        $param = $this->config['api_UserinfoFollow']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 获取关注信息
     */
    public function testCurlForUserinfoGetfollow ()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_UserinfoGetfollow']['url']}";
        $param = $this->config['api_UserinfoGetfollow']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(200, $info['errno']);
    }

    /**
     * 退出登录接口测试
     */
    public function testCurlForLogout ()
    {
        $url = "{$this->config['api_host_url']}{$this->config['api_logout']['url']}";
        $param = $this->config['api_logout']['param'];
        $curl = new Curltool();
        $curl->http_post($url, $param);
        $info = json_decode($curl->tmp_info, TRUE);
//        $this->echo_html($url, $param, $info);
        $this->assertEquals(4, count($info));
    }

    /*获取redis中的session数据*/
    private function _GetRedisForSessionArr ()
    {
        $redis = new Redis();
        $redis->connect(
            $this->config['redis']['host'],
            $this->config['redis']['port']
        );
        $session = $redis->get("PHPREDIS_SESSION:" . session_id());
        return unserialize(ltrim($session, "web|"));
    }

    /*获取昵称与上次不重复*/
    private function _GetChangeNick ()
    {
        $tmp_nick = 'eson' . rand(0, 1);
        $nick = $this->_GetRedisForSessionArr()['user_info']['nick'];
        if ($tmp_nick != $nick) {
            return $tmp_nick;
        } else {
            return $this->_GetChangeNick();
        }
    }

    /**
     * 对称加密方式
     * @param $session
     * @return string
     */
    private function _AES ($session)
    {
        unset($session['user_info']['message_bool']);
        unset($session['user_info']['nick']);
        unset($session['user_info']['mobile']);
        unset($session['user_info']['email']);
        unset($session['user_info']['pic']);
        $data = $session['user_info'];
        // 所有请求参数按照字母先后顺序排
        ksort($data);
        //把所有参数名和参数值串在一起
        $str = "";
        foreach ($data as $k => $v) {
            $str .= urldecode($k . $v);
        }
        unset($k, $v);
        $str .= $this->config['cookieValidationKey'];
        return strtoupper(sha1($str));
    }
}
