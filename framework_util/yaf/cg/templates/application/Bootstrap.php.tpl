<?php

/**
 * @name Bootstrap
 * @author {&$AUTHOR&}
 * @desc   所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * @see    http://www.php.net/manual/en/class.yaf-bootstrap-abstract.php
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */
class Bootstrap extends Yaf_Bootstrap_Abstract
{

	public function _initConfig()
	{
		//把配置保存起来
		$arrConfig = Yaf_Application::app()->getConfig();
		Yaf_Registry::set('config', $arrConfig);
	}

	public function _initComposer()
	{
		// 加载 composer 加载器
		$composerConfig = Yaf\Registry::get('config')['composer'];
		if ($composerConfig['toggle'] == '1') {
			if (file_exists($autoloadFile = $composerConfig['directory'] . '/autoload.php')) {
				Yaf\Loader::import($autoloadFile);
			} else {
				generalError('composer配置错误');
			}
		}
	}

	public function _initSession()
	{
		// 开启session
		\Yaf\Session::getInstance()->start();
	}

	public function _initPlugin(\Yaf\Dispatcher $dispatcher)
	{
		// 注册一个插件
		$objLayoutPlugin = new LayoutPlugin();
		$dispatcher->registerPlugin($objLayoutPlugin);
	}

	public function _initHelper()
	{
		// 加载helper
	}

	public function _initDB()
	{
		$dbConfig = \Yaf\Registry::get('config')->toArray()['db'];
		empty($dbConfig) && generalError('数据库配置错误');

		if ($dbConfig['autoload'] == '1') {
			\Yaf\Registry::set('db', new \Medoo($dbConfig));
		}
	}

	public function _initRedis()
	{
		$redisConfig = \Yaf\Registry::get('config')['redis'];
		empty($redisConfig) && generalError('Redis配置错误');

		if ($redisConfig['autoload'] == '1') {
			$redis = new Redis();
			$redis->connect($redisConfig['host']);
			\Yaf\Registry::set('redis', $redis);
		}
	}

	public function _initLog()
	{
		$logConfig = \Yaf\Registry::get('config')['monolog'];
		$monolog = new \Monolog\Logger(\Yaf\Application::app()->environ());
		// detect and register all PHP errors in this log hence forth
		\Monolog\ErrorHandler::register($monolog);
		$level = sprintf('\Monolog\Logger::%s', strtoupper($logConfig['level']));
		$monolog->pushHandler(
			new \Monolog\Handler\RotatingFileHandler(
				$logConfig['filename'],
				$logConfig['maxfiles'],
				constant($level)
			)
		);

		\Yaf\Registry::set('log', $monolog);
	}

	public function _initRoute(Yaf_Dispatcher $dispatcher)
	{
		//在这里注册自己的路由协议,默认使用简单路由
	}

	public function _initView(Yaf_Dispatcher $dispatcher)
	{
		//在这里注册自己的view控制器，例如smarty,firekylin
	}
}
