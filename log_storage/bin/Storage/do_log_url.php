<?php
/**
 * Created by PhpStorm.
 * User: eson
 * Date: 2018/11/16
 * Time: 上午1:22
 */

if (!empty($_GET['url'])) {
    echo file_get_contents($_GET['url']);
}