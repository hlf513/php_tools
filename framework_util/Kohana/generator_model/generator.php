<?php
/**
 * 生成kohana的Model类（指定表）
 *
 * @copyright longfei.he
 * @author    longfei.he <hlf513@gmail.com>
 */

// todo config start
$application = '../kohana/application';
$modules = '../kohana/modules';
$system = '../kohana/system';
//config end

define('EXT', '.php');

define('DOCROOT', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
define('APPPATH', realpath($application) . DIRECTORY_SEPARATOR);
define('MODPATH', realpath($modules) . DIRECTORY_SEPARATOR);
define('SYSPATH', realpath($system) . DIRECTORY_SEPARATOR);

unset($application, $modules, $system);

if ( ! defined('KOHANA_START_TIME')) define('KOHANA_START_TIME', microtime(true));
if ( ! defined('KOHANA_START_MEMORY')) define('KOHANA_START_MEMORY', memory_get_usage());

require APPPATH . 'bootstrap' . EXT;

/**
 * ============================
 * 生成model逻辑开始
 * ============================
 */
Kohana::$environment = Kohana::DEVELOPMENT;
$config = include APPPATH . 'config/database.php';

// php generator.php handmark mark ../kohana/......
if ($argc != 4) {
	echo <<<USAGE
php generator.php [database(config)] [table] [save_path]
USAGE;
	exit;
}
$database = $argv[1];
$table = $argv[2];
$save_path = $argv[3];

$database_name = explode('=', $config[$database]['connection']['dsn']);
$database_name = end($database_name);

$rows = DB::select('Column_name,column_default,column_key')->from('INFORMATION_SCHEMA.COLUMNS')
	->where('table_schema', '=', $database_name)
	->where('table_name', '=', $table)
	->execute($database)->as_array();

if (empty($rows)) {
	exit('参数错误');
}
$fields = array();

foreach ($rows as $row) {
	$fields[$row['Column_name']] = $row['column_default'];
	if ($row['column_key'] == 'PRI') {
		$primary_key = $row['Column_name'];
	}
	unset($row);
}
if (empty($primary_key)) {
	exit('没找到主键');
}

unset($fields[$primary_key]);

$fields = var_export($fields, 1);

//目录+文件
$dir = strstr($save_path, 'Model/');
$realpath = APPPATH . 'classes/' . $dir;
if ( ! is_dir($realpath)) {
	mkdir($realpath, 0777, true);
}
$tables = explode('_', $table);
foreach ($tables as $item) {
	$new_table[] = ucfirst($item);
}
$table_name = implode('', $new_table);
$class_name = str_replace(DIRECTORY_SEPARATOR, '_', rtrim($dir, '/') . '/' . $table_name);

$template = <<<TP
<?php
/**
 * @copyright longfei.he
 * @author    longfei.he <hlf513@gmail.com>
 */

defined('SYSPATH') or die('No direct script access.');

class $class_name extends Model_Common
{
	protected \$table = '$table' ;
	protected \$primary_key = '$primary_key';
	protected \$fields = $fields ;
	protected \$database = '$database' ;
}
TP;


file_put_contents($realpath . '/' . $table_name . '.php', $template);
echo 'OK!' . PHP_EOL;



