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

use Storage\Storage;

$index = new Storage($g_config);
$index->index();