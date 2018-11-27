<?php
/**
 * Created by PhpStorm.
 * User: eson
 * Date: 2018/11/26
 * Time: 下午4:36
 */

namespace Analysis;


class mynote_request extends Basic
{
    public $ret = null;
    public $tbname = "mynote_request";

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
        $tbname = $this->tbname;

        for ($i = 0; $i < $this->countLines; $i++) {
            $line = $this->lines[$i];
            if (empty($line) || $line === "\r") {#空行
                continue;
            }
            $peices = explode('||', $line);
            if (count($peices) < 2) {
                CT_log("parse error 1: " . ($i + 1) . " line: " . $line);
                continue;
            }

            $data = [];
            foreach ($peices as $peice) {
                $datum = explode(':', $peice);
                if (count($datum) < 2) {
                    CT_log("parse error 2: " . ($i + 1) . " line: " . $line);
                }
                $data[trim($datum[0])] = trim($datum[1]);
            }

            /*修改时间字段为人性化显示*/
            if (!empty($data['req_time'])) {
                $tmp_time_arr = explode(".", $data['req_time']);
                $t = date("Y-m-d H:i:s", intval($tmp_time_arr[0]));
                $data['req_time'] = trim($t . " " . $tmp_time_arr[1]);
            }

            if (empty($data['time'])) {
                $sql = "
                insert into 
                `$tbname` (`reqnum`,`uri`,`sessionid`,`params`,`req_time`) " .
                    "values (
                '{$data['rnum']}',
                '{$data["REQUEST_URI"]}',
                '{$data['PHPSESSID']}',
                '{$data['params']}',
                '{$data['req_time']}');";
            } else {
                $sql = "update `$tbname` set `time`='{$data['time']}' where `reqnum`='{$data['rnum']}';";
            }

            $M = $this->_db->prepare($sql);
            $M->execute();
        }
    }
}