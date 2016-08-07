#!/usr/bin/env php
<?php

if ($argc == 1) {
	echo <<<EOF
	
Usage: php $argv[0] (options)

options:
	-d 扫描目录路径
	-f 扫描文件路径
	-e 排除文件路径
	-o 输出目录路径
	-t 文档标题
EOF;
	exit;
}

/**
 * ===============================
 * kohana配置
 * ===============================
 */
// todo 定义kohana目录路径
$application = './application';
$modules = './modules';
$system = './system';
$index = '../www';

error_reporting(E_ALL | E_STRICT);

define('EXT', '.php');
define('DOCROOT', realpath($index) . DIRECTORY_SEPARATOR);
define('APPPATH', realpath($application) . DIRECTORY_SEPARATOR);
define('MODPATH', realpath($modules) . DIRECTORY_SEPARATOR);
define('SYSPATH', realpath($system) . DIRECTORY_SEPARATOR);
if ( ! is_dir(APPPATH)
	|| ! is_dir(MODPATH)
	|| ! is_dir(SYSPATH)
	|| ! is_dir(DOCROOT)
) {
	echo '请修改kohana的目录地址!' . PHP_EOL;
	exit;
}
unset($application, $modules, $system);

require APPPATH . 'bootstrap' . EXT;

/**
 * ================================
 *  加载php-apidoc
 * ================================
 */
$composer = './vendor';
if ( ! is_dir($composer)) {
	die('请配置正确的composer路径!' . PHP_EOL);
}
include $composer . "/autoload.php";

use Crada\Apidoc\Builder;
use Crada\Apidoc\Exception;

$options = getopt("d:f:e:o:t:");
$params = parse_options($options);
$classes = $params['classes'];
$output_dir = $params['output'];
$output_file = $params['title'] . '.html';
$title = $params['title'];


try {
	$builder = new Builder($classes, $output_dir, $title, $output_file);
	$builder->generate();
} catch (Exception $e) {
	echo 'There was an error generating the documentation: ', $e->getMessage();
}

/**
 * 解析命令行参数
 *
 * @param $options
 *
 * @return array
 */
function parse_options($options)
{
	$ret = array(
		'classes' => [],
		'output'  => './output',
		'title'   => 'apidoc'
	);

	$classes = [];
	// 解析d
	if ( ! empty($options['d'])) {
		if (is_array($options['d'])) {
			foreach ($options['d'] as $dir_path) {
				$dir_path = str_replace('/application/','',strstr($dir_path,'/application/'));
				$dir = array_flip(glob(APPPATH . $dir_path . '/*'));
				$classes = array_merge($classes, $dir);
			}
		} else {
			$dir_path = str_replace('/application/','',strstr($options['d'],'/application/'));
			$dir = array_flip(glob(APPPATH . $dir_path . '/*'));
			$classes = array_merge($classes, $dir);
		}
	}
	// 解析f
	if ( ! empty($options['f'])) {
		if (is_array($options['f'])) {
			foreach ($options['f'] as $file_path) {
				$classes[APPPATH . $file_path] = '';
			}
		} else {
			$classes[APPPATH . $options['f']] = '';
		}
	}
	// 解析e
	if ( ! empty($options['e'])) {
		if (is_array($options['e'])) {
			foreach ($options['e'] as $ex_file) {
				unset($classes[APPPATH . $ex_file]);
			}
		} else {
			unset($classes[APPPATH . $options['e']]);
		}
	}
	foreach ($classes as $class => $val) {
		$ret['classes'][] = str_replace(DIRECTORY_SEPARATOR, '_', rtrim(ltrim(strstr($class, '/classes/'), '/classes/'), '.php'));
	}

	//解析 o
	if ( ! empty($options['o'])) {
		$ret['output'] = $options['o'];
	}
	//解析 t
	if ( ! empty($options['t'])) {
		$ret['title'] = $options['t'];
	}

	return $ret;
}
