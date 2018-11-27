<?php
/**
 * Created by PhpStorm.
 * User: eson
 * Date: 2018/11/27
 * Time: 上午9:49
 */

namespace Analysis;


class xjc_nignx extends Basic
{
    public $ret = null;
    public $tbname = "xjc_nignx";

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
            'api_name' => "mynote_log",
            'path' => $this->path,
            "handled_lines" => $this->countLines,
        ];
    }

    private function _analysis ()
    {
        for ($i = 0; $i < $this->countLines; $i++) {
            $line = $this->lines[$i];
            if (empty($line) || $line === "\r") {#空行
                continue;
            }
            $peices = explode('||', $line);

            $data = [];
            foreach ($peices as $peice) {
                $datum = explode(':', $peice, 2);
                if (trim($datum[0]) === 'time') {
                    $data[trim($datum[0])] = date('Y-m-d H:i:s', strtotime($datum[1]));
                } else {
                    $data[trim($datum[0])] = trim($datum[1]);
                }
            }

            $sql = "insert into `xjc_nginx`(`ip`,`sessid`,`time`,`request_time`,`ur_time`,`request`,`status`,`bytes_sent`,`ua`,`forward`) values('{$data['IP']}','{$data['PHPSESSID']}','{$data['time']}','{$data['request_time']}','{$data['ur_time']}',{$data['request']},'{$data['status']}','{$data['bytes_sent']}',{$data['UA']},{$data['forward']});";

            $M = $this->_db->prepare($sql);
            $M->execute();
        }
    }
}