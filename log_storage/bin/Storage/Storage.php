<?php
/**
 * Created by PhpStorm.
 * User: eson
 * Date: 2018/11/15
 * Time: 下午7:38
 */

namespace Storage;

use PDO;

/**
 * Class Storage
 * @package Analysis
 */
class Storage
{
    /*配置属性*/
    public $config = array();
    /*数据库*/
    private $_db = null;
    /*功能参数*/
    private $key_time_out_value = 0.2;
    private $key_request_id_value = null;
    private $log_datetime_start = null;
    private $log_datetime_end = null;
    private $reqnum = null;
    private $username = null;
    private $mobile = null;
    private $mod = null;
    private $r_url = null;
    private $log_message_top = null;
    private $log_message_bottom = null;
    private $message = null;
    private $log_message = null;
    private $default_time = null;
    private $default_time_show = null;
    /*当前开始页数*/
    private $start = null;
    /*每页显示条数*/
    private $per_num = 20;
    /*不加入th的字段*/
    private $field_arr = array();
    /*单独显示的一行*/
    private $online_arr = array();
    /*查询$request_max_id*/
    private $request_max_id = null;

    /**
     * Storage constructor.
     * @param $config
     */
    public function __construct ($config)
    {
        /*初始化数据库*/
        $dsn = "mysql:host={$config['host']};dbname={$config['logana_dbname']};";
        $this->config = $config;
        $this->_db = new PDO($dsn, $config['username'], $config['pwd']);
        $this->_db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
        $this->_db->exec('SET NAMES utf8');
        /*初始化参数*/
        $this->_init();
    }

    /**
     * @return bool
     */
    private function _init ()
    {
        $this->default_time = intval(time()) - 1800;
        $this->default_time_show = date("Y-m-d H:i:s", intval($this->default_time));
        $this->log_datetime_start = " AND r.req_time > \"{$this->default_time_show}\" ";

        /*不加入th的字段*/
        $this->field_arr = [
            '记录内容',
            'r主键ID',
            'GET参数',
            '请求编号',
            '用户账号',
            'api请求URL',
            '代码方法名',
            '用户昵称',
            '用户ID',
            '请求消耗时间',
            '请求时间',
        ];

        /*单独显示的一行*/
        $this->online_arr = [
            'r主键ID',
            '请求id',
            '请求编号',
            '用户账号',
            '用户昵称',
            '用户ID',
            'api请求URL',
            '请求消耗时间',
            '请求时间',
        ];

        if (empty($_GET)) {
            return TRUE;
        }

        /*请求耗时超标值刻度 200毫秒(ms)=0.2秒(s)*/
        if ($_GET['key_time_out_value']) {
            $this->key_time_out_value = $_GET['key_time_out_value'];
        }

        if ($_GET['key_request_id_value']) {
            $this->key_request_id_value = " AND r.id > {$_GET['key_request_id_value']}";
        }

        /*请求范围时间*/
        $log_datetime_start = strtotime($_GET['log_datetime_start']);
        $log_datetime_start = date("Y-m-d H:i:s", $log_datetime_start);
        if ($_GET['log_datetime_start']) {
            $this->log_datetime_start = " AND r.req_time > \"{$log_datetime_start}\" ";
        } else {
            $this->log_datetime_start = " AND r.req_time > \"{$log_datetime_start}\" ";
        }
        if ($_GET['log_datetime_end']) {
            $log_datetime_end = strtotime($_GET['log_datetime_end']);
            $log_datetime_end = date("Y-m-d H:i:s", $log_datetime_end);
            $this->log_datetime_end = " AND r.req_time < \"{$log_datetime_end}\" ";
        }

        if ($_GET['reqnum']) {
            $this->reqnum = " AND r.reqnum = \"{$_GET['reqnum']}\" ";
        }

        if ($_GET['username']) {
            $this->username = " AND u.username = \"{$_GET['username']}\" ";
        }

        if ($_GET['mobile']) {
            $this->mobile = " AND u.mobile = \"{$_GET['mobile']}\" ";
        }

        if ($_GET['mod'] == 'LIKE') {
            $this->mod = "模糊匹配";
            $this->r_url = $_GET['r_url'] ? ' AND r.uri LIKE "%' . $_GET['r_url'] . '%" ' : '';
        } else {
            $this->mod = "字段全文检索";
            $this->r_url = $_GET['r_url'] ? ' AND r.uri = "' . $_GET['r_url'] . '" ' : '';
        }

        if (!empty($_GET['log_message_top'])) {
            $this->log_message_top = $_GET['log_message_top'];
        }

        if (!empty($_GET['log_message_bottom'])) {
            $this->log_message_bottom = $_GET['log_message_bottom'];
        }

        if ($this->log_message_bottom) {
            $this->message = $this->log_message_bottom;
        } else {
            $this->message = $this->log_message_top;
        }

        if ($this->message) {
            $this->log_message = " AND log.message LIKE '%{$this->message}%' ";
        }

        return TRUE;
    }

    /**
     * 入口方法
     */
    public function index ()
    {
        /*查询所有页面的总条数*/
        $page_for_sql = $this->_get_all_pages_for_sql();

        /*获取分页的html*/
        $page_html = $this->_get_page_html($page_for_sql);

        /*查询页面需要的数据*/
        $data_for_sql = $this->_get_data_for_sql();

        /*查询$request_max_id*/
        $this->request_max_id = $this->_get_request_max_id();

        /*获取页面数据*/
        $data = $this->_get_data($data_for_sql);

        /*获取显示功能提示的html*/
        ob_start();
        require_once __DIR__ . "/view/ful.php";
        $ful_html = ob_get_contents();
        ob_end_clean();

        /*获取panel-heading的html*/
        ob_start();
        require_once __DIR__ . "/view/heading.php";
        require_once __DIR__ . "/view/body.php";
        require_once __DIR__ . "/view/footer.php";
        $panel_html = ob_get_contents();
        ob_end_clean();

        /*获取页面html*/
        ob_start();
        require_once __DIR__ . "/view/main.php";
        $html = ob_get_contents();
        ob_end_clean();

        /*消除资源*/
        unset($page_html, $data, $panel_html,$ful_html);

        echo $html;
    }

    /**
     * @return string
     */
    private function _get_all_pages_for_sql ()
    {
        return "
            SELECT
                COUNT(*)
            FROM
                mynote_request AS r
            LEFT JOIN mynote_log AS log ON
                r.reqnum = log.reqnum 
            LEFT JOIN mynote_login AS login ON
                login.sessionid = r.sessionid
            LEFT JOIN user AS u ON
                u.id = login.uid 
            WHERE
                r.reqnum IS NOT NULL
                {$this->log_datetime_start}
                {$this->log_datetime_end}
                {$this->reqnum}
                {$this->username}
                {$this->mobile}
                {$this->r_url}
                {$this->log_message}
                {$this->key_request_id_value}
        ";
    }

    /**
     * @return string
     */
    private function _get_data_for_sql ()
    {
        return "
        SELECT
            r.id AS `r主键ID`,
            log.id AS `log主键ID`,
            r.reqnum AS `请求编号`,
            u.username AS `用户账号`,
            u.nick AS `用户昵称`,
            login.uid AS `用户ID`,
            -- u.pic AS `用户头像`,
            r.uri AS `api请求URL`,
            -- login.sessionid AS `sessionid`,
            r.time AS `请求消耗时间`,
            r.req_time AS `请求时间`,
            log.datetime AS `记录时间`,
            -- login.datetime AS `登录时间`,
            log.level AS `日志级别`,
            log.logger AS `日志模块`,
            -- login.status AS `状态`,
            -- login.reqid AS `请求id`,
            -- login.id AS `login主键ID`,
            log.class AS `代码方法名`,
            log.filename AS `文件名行号`,
            r.params AS `GET参数`,
            log.message AS `记录内容`
        FROM
            mynote_request AS r
        LEFT JOIN mynote_log AS log ON
            r.reqnum = log.reqnum 
        LEFT JOIN mynote_login AS login ON
            login.sessionid = r.sessionid
        LEFT JOIN user AS u ON
            u.id = login.uid 
        WHERE
            r.reqnum IS NOT NULL
            {$this->log_datetime_start}
            {$this->log_datetime_end}
            {$this->reqnum}
            {$this->username}
            {$this->mobile}
            {$this->r_url}
            {$this->log_message}
            {$this->key_request_id_value}
        ORDER BY
            r.req_time DESC, 
            log.id DESC
        LIMIT
            {$this->start},{$this->per_num}
        ";
    }

    /**
     * @param $sql
     * @return string
     */
    private function _get_page_html ($sql)
    {
        $query = $this->_db->prepare($sql);
        $query->execute();
        $pagetotal = $query->fetchAll();
        /*计算总页数*/
        $totalpage = ceil($pagetotal[0]["COUNT(*)"] / $this->per_num);
        /*如果请求的页面大于总页数则跳到第一页*/
        $pageNo = isset($_GET['pageNo']) && ($_GET["pageNo"] <= $totalpage) ? $_GET['pageNo'] : 1;
        /*计算每页查询开始的条数*/
        $this->start = ($pageNo - 1) * $this->per_num;
        /*分页数据*/
        unset($_GET['pageNo']);

        if (!empty($_GET)) {
            $page_get = http_build_query($_GET);
        } else {
            $page_get = http_build_query([
                'key_request_id_value' => '',
                'log_message_top' => '',
                'key_time_out_value' => '',
                'log_datetime_start' => '',
                'log_datetime_end' => '',
                'reqnum' => '',
                'username' => '',
                'mobile' => '',
                'mod' => 'LIKE',
                'r_url' => '',
                'log_message_bottom' => '',
            ]);
        }

        $page = new page(
            $pagetotal[0]['COUNT(*)'],
            $this->per_num,
            $pageNo,
            "?pageNo={page}&{$page_get}"
        );
        return $page->myde_write();
    }

    /**
     * @param $sql
     * @return array
     */
    private function _get_data ($sql)
    {
        $query = $this->_db->prepare($sql);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    /**
     * @return mixed
     */
    private function _get_request_max_id ()
    {
        $sql = $this->_get_request_max_id_for_sql();
        $query = $this->_db->prepare($sql);
        $query->execute();
        $request_max_id_arr = $query->fetch();
        $request_max_id = $request_max_id_arr['MAX(id)'];
        return $request_max_id;
    }

    /**
     * @return string
     */
    private function _get_request_max_id_for_sql ()
    {
        return "SELECT MAX(id) FROM mynote_request;";
    }
}