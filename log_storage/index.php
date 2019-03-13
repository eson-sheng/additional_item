<?php
/**
 * Created by PhpStorm.
 * User: eson
 * Date: 2018/11/15
 * Time: 下午7:33
 */
require_once __DIR__ . "/bin/autoload.php";

/*配置文件加载*/
$config = require __DIR__ . '/../config.php';

$ct_log_path = __DIR__ . '/logs/log.txt';
$config = require __DIR__ . '/../common.php';

use Storage\Storage;

$index = new Storage($g_config);
$index->index();
