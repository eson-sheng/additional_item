<?php
require_once __DIR__ . "/Curl.php";

use PHPUnit\Framework\TestCase;

/**
 * @method markTestSkipped()
 * @method assertEquals($int, $errno)
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
        session_start();
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
        echo "<br>url: {$url}";
        echo "<br>param: " . http_build_query($param);
        echo "<br>return:";
        echo "<pre>";
        print_r($info);
        echo "</pre><hr>";
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
}
