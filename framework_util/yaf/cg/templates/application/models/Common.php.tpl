<?php

/**
 * Common.php
 *
 * @author longfei.he
 */
class CommonModel
{
	/** @var \Medoo */
	protected $db;

	/** @var  \Monolog\Logger */
	protected $log;

	public function __construct()
	{
		$this->db = \Yaf\Registry::get('db');
		$this->log = \Yaf\Registry::get('log');
	}

	/**
	 * 手动连接数据库
	 */
	protected function connectDB()
	{
		$dbConfig = \Yaf\Registry::get('config')->toArray()['db'];
		$this->db = new \Medoo($dbConfig);
	}

}