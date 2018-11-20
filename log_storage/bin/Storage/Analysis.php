<?php
/**
 * Created by PhpStorm.
 * User: eson
 * Date: 2018/11/20
 * Time: 上午10:14
 */

namespace Storage;


class Analysis
{
    public function index ()
    {
        $json = array();
        $items = $this->_config();
        foreach ($items as $item) {
            $json[] = $this->_analysis($item['api'], $item['path']);
        }
        return $json;
    }

    private function _analysis ($api, $log_path)
    {
        ob_start();
        $_REQUEST['logpath'] = $log_path;
        require __DIR__ . "/../../../log_analysis/common.php";
        /*mynote_log*/
        require __DIR__ . "/../../../log_analysis/{$api}";
        $json = ob_get_contents();
        ob_end_clean();
        return $json;
    }

    private function _config ()
    {
        $path_my = __DIR__ . "/../../../log_analysis/runner.my.php";
        if (is_file($path_my)) {
            require_once $path_my;
        }
        return $items;
    }
}