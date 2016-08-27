<?php
// 定义错误码
define('GENERAL_ERROR', 4300);
define('UNKNOW_ERROR', 4301);
define('PARAMS_ERROR', 4302);
define('REQUEST_URL_ERROR', 4303);
define('API_PARAMS_ERROR', 4004);
define('API_RESPONSE_ERROR', 4005);

//定义常量

// 接收环境变量
if (empty($_SERVER['HOSTNAME']) ||
	empty($_SERVER['DATABASE']) ||
	empty($_SERVER['USERNAME']) ||
	empty($_SERVER['PASSWORD']) ||
) {
	generalError('env is null');
}

define('HOSTNAME', $_SERVER['HOSTNAME']);
define('DATABASE', $_SERVER['DATABASE']);
define('USERNAME', $_SERVER['USERNAME']);
define('PASSWORD', $_SERVER['PASSWORD']);

