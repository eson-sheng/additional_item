<?php
/**
 * Created by PhpStorm.
 * User: eson
 * Date: 2018/11/26
 * Time: 上午11:55
 */

namespace Analysis;

use PDO;

class Basic
{
    /*配置属性*/
    public $config = array();
    /*数据库*/
    public $_db = null;
    /*日志地址*/
    public $path = null;
    /*子模块名称*/
    public $api_name = null;

    public $countLines = null;
    public $lines = null;

    /**
     * Basic constructor.
     * @param $config
     * @param $path
     * @param $api_name
     */
    public function __construct ($config, $path, $api_name)
    {
        /*初始化数据库*/
        $dsn = "mysql:host={$config['host']};dbname={$config['logana_dbname']};";
        $this->config = $config;
        $this->_db = new PDO($dsn, $config['username'], $config['pwd']);
        $this->_db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
        $this->_db->exec('SET NAMES utf8');
        /*子模块名称*/
        $this->api_name = $api_name;
        /*初始化地址*/
        $this->path = $path;
        /*初始化参数*/
        return $this->init();
    }

    public function init ()
    {
        /*获取当前要分析的文件*/
        if (!file_exists("{$this->path}")) {
            $log_path = $this->path . '/' . date('Ymd') . '.log';
        } else {
            $log_path = "{$this->path}";
        }
        $this->path = $log_path;
        /*判断文件是否存在*/
        if (!is_file($this->path)) {
            return [
                'status' => false,
                'api_name' => $this->api_name,
                'error' => "日志 {$this->path} 不存在",
            ];
        }
        /*关闭当前会话中事务的自动提交*/
        $query_commit = $this->_db->prepare("set autocommit = 0;");
        $query_commit->execute();
        /*查询数据库得到文件行号*/
        $sql = "
        SELECT `last_end_index` FROM `mynote_indexfile` WHERE indexfile_path = ? ;
        ";
        $query = $this->_db->prepare($sql);
        $query->execute(array($log_path));
        $ret = $query->fetch();
        if ($ret) {
            $last_end_index = $ret['last_end_index'];
        } else {
            $last_end_index = 0;
        }
        /*获取日志内容*/
        $content = file_get_contents($log_path, false, null, $last_end_index);
        $this->lines = [];
        if ($content !== '') {
            $this->lines = explode("\n", $content);
            /*修改数据库数据，修改文件行号*/
            $last_end_index += strlen($content);
            $sql = "
            INSERT INTO mynote_indexfile
                ( last_end_index, indexfile_path )
            VALUES 
                ( '{$last_end_index}','{$log_path}' )
            ON DUPLICATE KEY UPDATE
                last_end_index = '{$last_end_index}' ,
                indexfile_path = '{$log_path}' 
            ";
            $M = $this->_db->prepare($sql);
            $M->execute();
        }
        $this->countLines = count($this->lines);
        return ['status' => true];
    }
}