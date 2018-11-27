<?php
/**
 * Created by PhpStorm.
 * User: eson
 * Date: 2018/11/26
 * Time: 上午10:21
 */

require_once __DIR__ . "/bin/autoload.php";

/*配置文件加载*/
$config = require __DIR__ . '/../config.php';

use Analysis\Analysis;

$index = new Analysis($g_config);
$index->index();