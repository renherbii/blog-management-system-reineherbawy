<?php

$yii='C:/xampp74/frameworks/yii-1.1.31.34bac5/framework/yii.php';
$config = dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

// sanity check
if (!file_exists($yii)) {
    die('yii.php not found at: '.$yii);
}

require_once($yii);
Yii::createWebApplication($config)->run();

