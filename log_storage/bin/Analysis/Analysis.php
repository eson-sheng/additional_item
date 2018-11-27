<?php
/**
 * Created by PhpStorm.
 * User: eson
 * Date: 2018/11/26
 * Time: 上午10:28
 */

namespace Analysis;

class Analysis
{
    /*配置属性*/
    public $config = array();

    /**
     * Storage constructor.
     * @param $config
     */
    public function __construct ($config)
    {
        /*初始化数据库*/
        $this->config = $config;
    }

    public function index ()
    {
        /*分析模块*/
        $items = $this->config['item'];
        foreach ($items as $item) {
            $return[] = $this->_explain($item['api'], $item['path']);
        }
        print_r(json_encode($return));
    }

    private function _explain ($model_name, $model_path)
    {
        $file = "./bin/Analysis/{$model_name}.php";
        if (file_exists($file)) {
            $config = $this->config;
            $class_name = "\\Analysis\\{$model_name}";
            /*动态调用模块*/
            $class = new $class_name($config, $model_path);
            return $class->index();
        } else {
            return ['status' => false, 'error' => "缺少{$model_name}模块"];
        }
    }
}