<?php
require_once __DIR__ . "/Curl.php";

use PHPUnit\Framework\TestCase;

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
        $this->assertEquals(4, count($info));
    }
}
