<?php
/**
 * 自定义Model类
 *
 * 封装了常用的数据库操作
 *
 * @copyright longfei.he
 * @author    longfei.he <hlf513@gmail.com>
 */
defined('SYSPATH') or die('No direct script access.');


class Model_Common extends Model_Database
{
	/**
	 * 分页limit
	 *
	 * @var int
	 */
	public $page_limit = 30;
	/**
	 * todo 数据库名（读）
	 *
	 * @var string
	 */
	protected $database = 'default';
	/**
	 * todo 数据库名（写）
	 *
	 * @var string
	 */
	protected $database_write = 'default';
	/**
	 * todo 表名
	 *
	 * @var string
	 */
	protected $table = 'table';
	/**
	 * todo 主键
	 *
	 * @var string
	 */
	protected $primary_key = 'id';
	/**
	 * todo 数据表字段
	 *
	 * @var array
	 */
	protected $fields = array();

	/**
	 * 新增数据
	 *
	 * @param array $params
	 *
	 * @return int 插入的后ID
	 * @throws \Exception
	 */
	public function save($params)
	{
		if (empty($params)) {
			throw new Exception('参数不能为空');
		}
		// 过滤无效字符
		$params = array_merge($this->fields, array_intersect_key($params, $this->fields));
		if ( ! empty($params[$this->primary_key])) {
			unset($params[$this->primary_key]);
		};
		$insert_fields = array_keys($params);
		$insert_values = array_values($params);
		list($inserted_id, $affected_rows) = DB::insert($this->table, $insert_fields)
			->values($insert_values)
			->execute($this->database_write);
		if ($inserted_id <= 0 || $affected_rows <= 0) {
			throw new Exception('保存数据失败');
		}

		return $inserted_id;
	}

	/**
	 * 根据ID获取一条数据
	 *
	 * @param int    $id
	 * @param string $fields
	 *
	 * @return array
	 * @throws \Exception
	 */
	public function fetch_one($id, $fields = '*')
	{
		if (empty($id) || ! is_int($id)) {
			throw new Exception('参数id不能为空');
		}

		$row = DB::select($fields)->from($this->table)
			->where($this->primary_key, '=', $id)
			->execute($this->database)->current();

		if (empty($row)) {
			throw new Exception('数据不存在');
		}

		return $row;
	}

	/**
	 * 根据where获取一批数据
	 *
	 * @param array  $where
	 * @param string $fields
	 *
	 * @return array
	 * @throws \Exception
	 */
	public function fetch_by_where($where, $fields = '*')
	{
		if (empty($where) || ! is_array($where)) {
			throw new Exception('参数不能为空');
		}
		$fetch_db = DB::select($fields)->from($this->table);

		foreach ($where as $row) {
			if (empty($row[0]) || empty($row[1]) || ! isset($row[2])) {
				throw new Exception('参数where格式错误');
			}
			$fetch_db->where($row[0], $row[1], $row[2]);
		}
		$row = $fetch_db->execute($this->database)->as_array($this->primary_key);

		return $row;
	}

	/**
	 * 根据ids[]获取批量数据
	 *
	 * @param array  $ids
	 * @param string $fields
	 *
	 * @return array
	 * @throws \Exception
	 */
	public function fetch_by_ids(array $ids, $fields = '*')
	{
		if (empty($ids) || ! is_array($ids)) {
			throw new Exception('参数不能为空');
		}

		$rows = DB::select($fields)->from($this->table)
			->where($this->primary_key, 'in', $ids)
			->execute($this->database)->as_array($this->primary_key);

		if (count($rows) == 0) {
			throw new Exception('数据不存在');
		}

		return $rows;
	}

	/**
	 * 根据ID删除一条数据
	 *
	 * @param int $id
	 *
	 * @return bool
	 * @throws \Exception
	 */
	public function delete_one($id)
	{
		if (empty($id) || ! is_int($id)) {
			throw new Exception('参数id不能为空');
		}

		$affected_rows = DB::delete($this->table)->where($this->primary_key, '=', $id)->limit(1)->execute($this->database_write);

		if ($affected_rows != 1) {
			throw new Exception('删除无效');
		}

		return true;
	}

	/**
	 * 根据where批量删除数据
	 *
	 * @param array $where
	 *
	 * @return bool
	 * @throws \Exception
	 */
	public function delete_by_where($where)
	{
		if (empty($where) || ! is_array($where)) {
			throw new Exception('参数错误');
		}

		$delete_db = DB::delete($this->table);
		foreach ($where as $row) {
			if (empty($row[0]) || empty($row[1]) || ! isset($row[2])) {
				throw new Exception('参数where格式错误');
			}
			$delete_db->where($row[0], $row[1], $row[2]);
			unset($row);
		}
		$affected_rows = $delete_db->execute($this->database_write);

		return $affected_rows;
	}

	/**
	 * 根据ID更新一条数据
	 *
	 * @param int   $id
	 * @param array $updated
	 *
	 * @return bool
	 * @throws \Exception
	 */
	public function update_one($id, $updated)
	{
		if (empty($updated) || ! is_array($updated) || empty($id) || ! is_int($id)) {
			throw new Exception('参数错误');
		}

		$affected_rows = DB::update($this->table)->set($updated)
			->where($this->primary_key, '=', $id)
			->limit(1)
			->execute($this->database_write);

		if ($affected_rows != 1) {
			throw new Exception('更新无效');
		}

		return true;
	}

	/**
	 * 根据where批量更新数据
	 *
	 * @param array $where
	 * @param array $updated
	 *
	 * @return bool
	 * @throws \Exception
	 */
	public function update_by_where($where, $updated)
	{
		if (empty($updated) || ! is_array($updated) || empty($where) || ! is_array($where)) {
			throw new Exception('参数错误');
		}

		$update_db = DB::update($this->table)->set($updated);
		foreach ($where as $row) {
			if (empty($row[0]) || empty($row[1]) || ! isset($row[2])) {
				throw new Exception('参数where格式错误');
			}
			$update_db->where($row[0], $row[1], $row[2]);
			unset($row);
		}
		$affected_rows = $update_db->execute($this->database_write);

		return $affected_rows;
	}

	/**
	 * 根据where计算总数
	 *
	 * @param array $where
	 *
	 * @return int
	 * @throws \Exception
	 */
	public function count_by_where($where)
	{
		if (empty($where) || ! is_array($where)) {
			throw new Exception('参数错误');
		}
		$count_db = DB::select(DB::expr('count(*) total'))->from($this->table);
		foreach ($where as $row) {
			if (empty($row[0]) || empty($row[1]) || ! isset($row[2])) {
				throw new Exception('参数where格式错误');
			}
			$count_db->where($row[0], $row[1], $row[2]);
			unset($row);
		}
		$total = $count_db->execute($this->database)->get('total');

		return intval($total);
	}

	/**
	 * 分页
	 *
	 * @param array  $where
	 * @param string $fields
	 * @param string $group_by
	 * @param array  $order_by
	 * @param int    $offset
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	public function pagination($where, $fields = 'id', $offset = 0, $group_by = '', $order_by = array())
	{
		if ($fields == 'id') {
			$fields = $this->primary_key;
		}
		$page_db = DB::select($fields)->from($this->table);
		foreach ($where as $row) {
			if (empty($row[0]) || empty($row[1]) || ! isset($row[2])) {
				throw new Exception('参数where格式错误');
			}
			$page_db->where($row[0], $row[1], $row[2]);
			unset($row);
		}
		if ( ! empty($group_by)) {
			$page_db->group_by($group_by);
		}
		if ( ! empty($order_by)) {
			if (empty($order_by[0]) || ! in_array($order_by[1], array('desc', 'asc'))) {
				throw new Exception('参数order格式错误');
			}
			$page_db->order_by($order_by[0], $order_by[1]);
		}
		$rows = $page_db->limit($this->page_limit)->offset($offset)->execute($this->database)->as_array($this->primary_key);

		if (empty($rows)) {
			throw new Exception('没有数据');
		}

		return $rows;
	}
}
