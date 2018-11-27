<?php
/**
 * Created by PhpStorm.
 * User: eson
 * Date: 2018/11/26
 * Time: 下午4:28
 */

namespace Analysis;


class mynote_login extends Basic
{
    public $ret = null;
    public $tbname = "mynote_login";

    public function __construct ($config, $path)
    {
        $this->ret = parent::__construct($config, $path, $this->tbname);
    }

    public function index ()
    {
        if (!$this->ret['status']) {
            return $this->ret;
        }

        $this->_analysis();

        $query_commit = $this->_db->prepare("commit;");
        $query_commit->execute();

        return [
            'status' => true,
            'api_name' => $this->tbname,
            'path' => $this->path,
            "handled_lines" => $this->countLines,
        ];
    }

    private function _analysis ()
    {
        $line_peices = [];
        $tbname = $this->tbname;

        for ($i = 0; $i < $this->countLines; $i++) {
            $line = $this->lines[$i];
            if (empty($line) || $line === "\r") {#空行
                continue;
            }
            $peices = explode('-||-', $line);
            if (strpos($line, '-||-') !== false) { //是数据首行
                /*修改时间字段为人性化显示*/
                $tmp_time_arr = explode(".", $peices[0]);
                $t = date("Y-m-d H:i:s", intval($tmp_time_arr[0]));
                $peices[0] = trim($t . " " . $tmp_time_arr[1]);
                switch (trim($peices[1])) {
                    case 'DEBUG':
                        $peices[1] = 8;
                        break;
                    case 'INFO':
                        $peices[1] = 7;
                        break;
                    case 'NOTICE':
                        $peices[1] = 6;
                        break;
                    case 'WARNING':
                        $peices[1] = 5;
                        break;
                    case 'ERROR':
                        $peices[1] = 4;
                        break;
                    case 'CRITICAL':
                        $peices[1] = 3;
                        break;
                    case 'ALERT':
                        $peices[1] = 2;
                        break;
                    case 'EMERGENCY':
                        $peices[1] = 1;
                        break;
                }
                if ($i !== 0) {
                    $arr = explode(',', $line_peices[5]);
                    $uid = $arr[0];
                    $sessionid = $arr[1];
                    $status = $arr[2];

                    $sql = "insert into `$tbname`(`datetime`,`reqid`,`uid`,`sessionid`,`status`) " .
                        "values('{$line_peices[0]}','{$line_peices[4]}','$uid','$sessionid',$status);";

                    $M = $this->_db->prepare($sql);
                    $M->execute();
                }

                $line_peices = $peices;

            } else {//非数据首行，插入到最后一个字段
                $line_peices[5] .= $peices[0];
            }
        }
    }
}