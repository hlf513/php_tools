<?php

define('APPLICATION_PATH', dirname(dirname(__FILE__)));

// 加载helper
\Yaf\Loader::import(APPLICATION_PATH . '/application/helpers/error.php');

// 加载环境变量,常量
\Yaf\Loader::import(APPLICATION_PATH . '/application/helpers/constants.php');

$application = new Yaf_Application( APPLICATION_PATH . "/conf/application.ini");

$application->bootstrap()->run();
