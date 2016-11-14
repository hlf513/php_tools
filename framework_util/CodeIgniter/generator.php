<?php
/**
 * generator.php
 *
 * @copyright longfei.he
 * @author    longfei.he <hlf513@gmail.com>
 */

if ($argc < 4) {
	echo <<<USAGE
php generator.php [database] [database_group] [save_path] [table]
USAGE;
	die;
}
$database = $argv[1];
$table = $argv[4];
$database_group = $argv[2];
$save_path = $argv[3];

//todo config start
$host = '10.2.1.43';
$dbname = $database;
$username = 'wenba';
$password = 'gaIrj2in5Ju2sh';
//$table = $table;
//todo config end

$dsn = sprintf('mysql:host=%s;dbname=%s', $host, $dbname);
try {
	$pdo = new PDO($dsn, $username, $password);
} catch (Exception $e) {
	echo 'Connection failed: ' . $e->getMessage();
	die;
}

$rows = $pdo->query(sprintf('select Column_name,column_default,column_key from INFORMATION_SCHEMA.COLUMNS where table_schema = "%s" and table_name="%s"', $dbname, $table))->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $row) {
	if ($row['column_default'] == null) {
		$row['column_default'] = '';
	}

	if ($row['column_default'] == 'CURRENT_TIMESTAMP') {
		$row['column_default'] = '1970-01-01';
	}

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
$model_name = strtolower($table);

$template = <<<TEMPLATE
<?php
/**
 * Model_$model_name.php
 *
 * @copyright longfei.he
 * @author    longfei.he <hlf513@gmail.com>
 */

defined('BASEPATH') OR exit('No direct script access allowed');


class Model_$model_name extends MY_Model{
	/**
	 * 数据库配置
	 *
	 * @var string
	 */
	protected \$database_group = '$database_group';
	/**
	 * 表名
	 *
	 * @var string
	 */
	protected \$table = '$table';
	/**
	 * 主键
	 *
	 * @var string
	 */
	protected \$primary_key = '$primary_key';
	/**
	 * 数据表字段
	 *
	 * @var array
	 */
	protected \$fields = $fields;	
}
TEMPLATE;

//$dir =(realpath($save_path));
if ( ! is_dir($save_path)) {
	mkdir($save_path, 0777, true);
}

$ret = file_put_contents(realpath($save_path) . '/Model_' . $model_name . '.php', $template);
if ($ret !== false) {
	echo realpath($save_path) . PHP_EOL;
}




