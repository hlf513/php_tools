<?php

/**
 * 响应约定
 *
 * @return array
 */
function response()
{
	return [
		'err_no'  => 0,
		'err_msg' => '',
		'results' => [],
	];
}

/**
 * 系统错误,终止请求
 *
 * @param string $msg
 */
function generalError($msg)
{
	header('Content-Type:application/json; charset=UTF-8');
	$ret = response();
	$ret['err_no'] = GENERAL_ERROR;
	$ret['err_msg'] = $msg;
	echo json_encode($ret);
	die;
}


/**
 * @param mixed $data
 */
function success($data)
{
	header('Content-Type:application/json; charset=UTF-8');
	$response = response();
	$response['results'] = $data;
	echo json_encode($response);
}


/**
 * @param int    $errNo
 * @param string $errMsg
 */
function error($errMsg, $errNo)
{
	header('Content-Type:application/json; charset=UTF-8');
	$response = response();
	$response['err_no'] = $errNo;
	$response['err_msg'] = $errMsg;
	echo json_encode($response);
}