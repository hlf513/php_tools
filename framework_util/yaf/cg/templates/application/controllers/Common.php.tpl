<?php

/**
 * Common.php
 *
 * @author longfei.he
 */
class CommonController extends Yaf_Controller_Abstract
{
	/** @var  \Monolog\Logger */
	protected $log;

	public static $requestApi = '';

	public function init()
	{
		Yaf_Dispatcher::getInstance()->autoRender(false);
		$this->log = \Yaf\Registry::get('log');
	}

	protected function logBefore(array $params)
	{
		$this->log->info(sprintf('[%s] request params (before)', self::$requestApi), $params);
	}

	protected function logAfter(array $params)
	{
		$this->log->info(sprintf('[%s] request params (after)', self::$requestApi), $params);
	}

}