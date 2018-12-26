<?php
/**
 * Created by PhpStorm.
 * User: eson
 * Date: 2018-12-25
 * Time: 09:52
 */

class Curltool
{
    public $http_code = NULL; // http 请求返回码
    public $tmp_info = NULL; // 请求的零时数据

    public function __construct ()
    {
    }

    /**
     * @param $url
     * @param array $header
     * @return bool
     */
    public function http_get ($url, $header = array('Expect:'))
    {
        $bool = TRUE;
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        // 'Content-Type: application/json', //定义json头信息
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检测
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // 从证书中检查SSL加密算法是否存在
        if (ini_get('open_basedir') == '' && ini_get('safe_mode' == 'Off')) {
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);// 自动设置Referer
        }
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        curl_setopt($curl, CURLOPT_TIMEOUT, 300); // 设置超时限制防止死循
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_COOKIE, "PHPSESSID=" . session_id() . "; path=/");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回

        $tmpInfo = curl_exec($curl); // 执行操作
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);//获取请求http请求码

        $this->http_code = $http_code;
        $this->tmp_info = $tmpInfo;

        if (curl_errno($curl)) {
            $bool = FALSE;
        }

        if ($http_code != 200) {
            $bool = FALSE;
        }

        curl_close($curl); // 关闭CURL会话资源释放

        return $bool;
    }

    /**
     * @param $url
     * @param array $param
     * @param array $header
     * @return bool
     */
    public function http_post ($url, $param = array(), $header = array('Expect:'))
    {
        $bool = TRUE;
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        // 'Content-Type: application/json', //定义json头信息
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检测
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // 从证书中检查SSL加密算法是否存在
        if (ini_get('open_basedir') == '' && ini_get('safe_mode' == 'Off')) {
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);// 自动设置Referer
        }
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, $param); // Post提交的数据包
        curl_setopt($curl, CURLOPT_TIMEOUT, 300); // 设置超时限制防止死循
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_COOKIE, "PHPSESSID=" . session_id() . "; path=/");// 解决前后端服务器在同一个server里session冲突问题
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回

        $tmpInfo = curl_exec($curl); // 执行操作
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);//获取请求http请求码

        $this->http_code = $http_code;
        $this->tmp_info = $tmpInfo;

        if (curl_errno($curl)) {
            $bool = FALSE;
        }

        if ($http_code != 200) {
            $bool = FALSE;
        }

        curl_close($curl); // 关闭CURL会话资源释放

        return $bool;
    }

    /**
     * @param $url
     * @param $data
     * @return mixed
     */
    public function patchurl ($url, $data)
    {
        $data = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
        curl_setopt($ch, CURLOPT_COOKIE, "PHPSESSID=" . session_id() . "; path=/");//
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);//20170611修改接口，用/id的方式传递，直接写在url中了
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output);
        return $output;
    }
}