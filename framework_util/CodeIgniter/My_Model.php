<?php
/**
 * My_Model.php
 *
 * @copyright longfei.he
 * @author    longfei.he <hlf513@gmail.com>
 */

defined('BASEPATH') OR exit('No direct script access allowed');


class MY_Model extends CI_Model
{
	/**
	 * 数据库配置
	 *
	 * @var string
	 */
	protected $database_group = 'default';
	/**
	 * 保存数据库连接
	 *
	 * @var array
	 */
	protected static $connections = array();
	/**
	 * 分页limit
	 *
	 * @var int
	 */
	public $page_limit = 30;
	/**
	 * 表名
	 *
	 * @var string
	 */
	protected $table = '';
	/**
	 * 主键
	 *
	 * @var string
	 */
	protected $primary_key = '';
	/**
	 * 数据表字段
	 *
	 * @var array
	 */
	protected $fields = array();


	/**
	 * 建立数据库连接
	 *
	 * 为了多数据库
	 *
	 * @param $name
	 *
	 * @return mixed
	 */
	public function __get($name)
	{
		$CI = &get_instance();
		// 默认不能开启自加载
		if ($name == 'db') {
			if ( ! isset($CI->mdb[$this->database_group])) {
				$CI->mdb[$this->database_group] = $this->load->database($this->database_group, true);
			}

			return $CI->mdb[$this->database_group];
		}

		if (isset($CI->$name)) {
			return $CI->$name;
		}

		return null;
	}

	/**
	 * 获取表名
	 *
	 * @return string
	 */
	public function get_table()
	{
		return $this->table;
	}

	/**
	 * 设置表名
	 *
	 * @param $table_name
	 */
	public function set_table($table_name)
	{
		$this->table = $table_name;
	}

	/**
	 * 新增数据
	 *
	 * @param array $params
	 * @param bool  $escape
	 * @param bool  $ignore
	 *
	 * @return int 插入的后ID
	 * @throws \Exception
	 */
	public function save($params, $escape = null, $ignore = false)
	{
		$prefix_log = 'Model::' . __FUNCTION__;

		if (empty($params)) {
			throw new Exception($prefix_log . '参数不能为空');
		}
		// 过滤无效字符
		$params = array_merge($this->fields, array_intersect_key($params, $this->fields));
		if ( ! empty($params[$this->primary_key])) {
			unset($params[$this->primary_key]);
		};
		if (isset($this->fields['created_at'])) {
			$params['created_at'] = date('Y-m-d H:i:s');
		}

		$this->db->insert($this->table, $params, $escape, $ignore);
		$inserted_id = $this->db->insert_id();
		if ($inserted_id <= 0) {
			throw new Exception($prefix_log . '保存数据失败');
		}

		return $inserted_id;
	}

	/**
	 * 批量保存数据
	 *
	 * 默认开启ignore
	 *
	 * @param       $params
	 * @param array $merge 替换掉params中的值
	 * @param int   $batch_size
	 * @param bool  $ignore
	 *
	 * @return \CI_DB_active_record|\CI_DB_result|int
	 * @throws \Exception
	 */
	public function save_batch($params, array $merge = [], $batch_size = 10000, $ignore = true)
	{
		$prefix_log = 'Model::' . __FUNCTION__;
		if (empty($params)) {
			throw new Exception($prefix_log . '参数不能为空');
		}

		$count = 0;
		for ($i = 0, $total = count($params); $i < $total; $i = $i + $batch_size) {
			$rows = array_slice($params, $i, $batch_size);
			// 拆分后批量导入
			if ( ! empty($merge)) {
				$save = array_map(function ($row) use ($merge) {
					return array_merge($this->fields, array_intersect_key($row, $this->fields), $merge);
				}, $rows);
			} else {
				$save = $rows;
			}
			$count += $this->db->insert_batch($this->table, $save, null, $batch_size, $ignore);
		}

		if ($count == 0) {
			throw new Exception($prefix_log . '没有数据入库');
		}

		return $count;
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
	public function fetch_one_by_id($id, $fields = '*')
	{
		$prefix_log = 'Model::' . __FUNCTION__;

		if (empty($id)) {
			throw new Exception($prefix_log . '参数id不能为空');
		}

		$row = $this->db->select($fields)->from($this->table)->where($this->primary_key, $id)->get()->row_array();

		if (empty($row)) {
			throw new Exception($prefix_log . '数据不存在');
		}

		return $row;
	}

	/**
	 * 根据where获取一条数据
	 *
	 * @param        $where
	 * @param string $fields
	 *
	 * @return array|mixed
	 * @throws \Exception
	 */
	public function fetch_one($where, $fields = '*')
	{
		$ret = [];
		$where[] = ['limit',1];
		$rows = $this->fetch_by_where($where, $fields);
		if ( ! empty($rows)) {
			$ret = $rows[0];
		}

		return $ret;
	}

	/**
	 * 根据where获取一批数据
	 *
	 * @param array  $where
	 * @param string $fields
	 * @param bool   $escape
	 *
	 * @return array
	 * @throws \Exception
	 */
	public function fetch_by_where($where, $fields = '*', $escape = true)
	{
		$prefix_log = 'Model::' . __FUNCTION__;

		if (empty($where) || ! is_array($where)) {
			throw new Exception($prefix_log . '参数不能为空');
		}

		$fetch_db = $this->db;
		foreach ($where as $row) {
			if (empty($row[0]) || ! isset($row[1])) {
				$this->log->error('where:',$where);
				throw new Exception($prefix_log . '参数where格式错误');
			}
			// order_by
			if ($row[0] == 'order_by') {
				if ( ! isset($row[2]) || empty($row[2])) {
					$row[2] = 'desc';
				}
				$fetch_db->order_by($row[1], $row[2]);
			} elseif ($row[0] == 'like') {
				$fetch_db->like($row[1], $row[2]);
			} elseif ($row[0] == 'limit') {
				$fetch_db->limit($row[1]);
			} else {
				$fetch_db->where($row[0], $row[1], $escape);
			}
			unset($row);
		}
		$rows = $fetch_db->select($fields, $escape)->from($this->table)->get()->result_array();

		return $rows;
	}

	/**
	 * 根据ids[]获取批量数据
	 *
	 * @param array  $ids
	 * @param string $fields
	 * @param string $order
	 *
	 * @return array
	 * @throws \Exception
	 */
	public function fetch_by_ids($ids, $fields = '*', $order = 'asc')
	{
		$prefix_log = 'Model::' . __FUNCTION__;

		if (empty($ids) || ! is_array($ids)) {
			throw new Exception($prefix_log . '参数不能为空');
		}

		$rows_db = $this->db->select($fields)->from($this->table)
			->where_in($this->primary_key, $ids);
		if ($order == 'desc') {
			$rows_db->order_by($this->primary_key, 'desc');
		}
		$rows = $rows_db->get()
			->result_array();

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
	public function delete_one_by_id($id)
	{
		$prefix_log = 'Model::' . __FUNCTION__;

		if (empty($id)) {
			throw new Exception($prefix_log . '参数id不能为空');
		}

		$bool = $this->db->limit(1)->delete($this->table, array(
			$this->primary_key => $id
		));

		if ($bool !== true) {
			throw new Exception($prefix_log . '删除无效');
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
		$prefix_log = 'Model::' . __FUNCTION__;

		if (empty($where) || ! is_array($where)) {
			throw new Exception($prefix_log . '参数错误');
		}

		$delete_db = $this->db;
		foreach ($where as $row) {
			if (empty($row[0]) || ! isset($row[1])) {
				throw new Exception($prefix_log . '参数where格式错误');
			}
			$delete_db->where($row[0], $row[1]);
			unset($row);
		}
		$bool = $this->db->delete($this->table);

		if ($bool !== true) {
			throw new Exception($prefix_log . '删除无效');
		}

		return true;
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
	public function update_one_by_id($id, $updated)
	{
		$prefix_log = 'Model::' . __FUNCTION__;

		if (empty($updated) || ! is_array($updated) || empty($id)) {
			throw new Exception($prefix_log . '参数错误');
		}

		$updated = array_intersect_key($updated, $this->fields);
		if ( ! empty($updated[$this->primary_key])) {
			unset($updated[$this->primary_key]);
		}


		if (isset($this->fields['updated_at'])) {
			unset($updated['created_at']);
			$updated['updated_at'] = date('Y-m-d H:i:s');
		}

		$bool = $this->db
			->where($this->primary_key, $id)
			->limit(1)
			->update($this->table, $updated);

		if ($bool !== true) {
			throw new Exception($prefix_log . '更新无效');
		}

		return true;
	}

	/**
	 * 根据where批量更新数据
	 *
	 * @param array $where
	 * @param array $updated
	 * @param int   $limit
	 *
	 * @return bool
	 * @throws \Exception
	 */
	public function update_by_where($where, $updated, $limit = 0)
	{
		$prefix_log = 'Model::' . __FUNCTION__;

		if (empty($updated) || ! is_array($updated) || empty($where) || ! is_array($where)) {
			throw new Exception($prefix_log . '参数错误');
		}

		$updated = array_intersect_key($updated, $this->fields);
		if ( ! empty($updated[$this->primary_key])) {
			unset($updated[$this->primary_key]);
		}

		if (isset($this->fields['updated_at'])) {
			unset($updated['created_at']);
			$updated['updated_at'] = date('Y-m-d H:i:s');
		}

		$update_db = $this->db;
		foreach ($where as $row) {
			if (empty($row[0]) || ! isset($row[1])) {
				throw new Exception($prefix_log . '参数where格式错误');
			}
			if ($row[0] == 1 && $row[0] == $row[1]) {
				// 1=1 不加`
				$update_db->where($row[0], $row[1], false);
			} else {
				$update_db->where($row[0], $row[1]);
			}
			unset($row);
		}
		if ($limit > 0) {
			$update_db->limit($limit);
		}

		$bool = $update_db->update($this->table, $updated);

		if ($bool !== true) {
			throw new Exception($prefix_log . '更新无效');
		}

		return $bool;
	}

	/**
	 * 根据where计算总数
	 *
	 * @param array $where
	 * @param array $group_by
	 *
	 * @return int
	 * @throws \Exception
	 */
	public function count_by_where($where, $group_by = array())
	{
		$prefix_log = 'Model::' . __FUNCTION__;
		if (empty($where) || ! is_array($where)) {
			throw new Exception($prefix_log . '参数错误');
		}
		$count_db = $this->db;
		foreach ($where as $row) {
			if (empty($row[0]) || ! isset($row[1])) {
				throw new Exception($prefix_log . '参数where格式错误');
			}
			if ($row[0] == $row[1] && $row[0] == 1) {
				$count_db->where($row[0], $row[1], false);
			} elseif ($row[0] == 'like') {
				$count_db->like($row[1], $row[2]);
			} elseif ($row[0] == 'in') {
				$count_db->where_in($row[1], $row[2]);
			} else {
				$count_db->where($row[0], $row[1]);
			}
			unset($row);
		}
		if ( ! empty($group_by)) {
			$count_db->group_by($group_by);
		}
		$total = $count_db->select('count(*) as total')->from($this->table)->get()->row_array()['total'];

		return intval($total);
	}

	/**
	 * 分页
	 *
	 * @param array  $where
	 * @param string $fields
	 * @param array  $order_by
	 * @param int    $offset
	 * @param array  $group_by
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	public function pagination($where, $fields = 'id', $offset = 0, $order_by = array(), $group_by = array())
	{
		$prefix_log = 'Model::' . __FUNCTION__;

		if ($fields == 'id') {
			$fields = $this->primary_key;
		}
		$page_db = $this->db;
		foreach ($where as $row) {
			if (empty($row[0]) || ! isset($row[1])) {
				throw new Exception($prefix_log . '参数where格式错误');
			}
			if ($row[0] == $row[1] && $row[0] == 1) {
				$page_db->where($row[0], $row[1], false);
			} elseif ($row[0] == 'like') {
				$page_db->like($row[1], $row[2]);
			} elseif ($row[0] == 'in') {
				$page_db->where_in($row[1], $row[2]);
			} else {
				$page_db->where($row[0], $row[1]);
			}
			unset($row);
		}
		if ( ! empty($group_by)) {
			$page_db->group_by($group_by);
		}
		if ( ! empty($order_by)) {
			if (empty($order_by[0]) || ! in_array(strtolower($order_by[1]), array('desc', 'asc'))) {
				throw new Exception($prefix_log . '参数order格式错误');
			}
			$page_db->order_by($order_by[0], $order_by[1]);
		}
		$rows = $page_db->select($fields)->from($this->table)->limit($this->page_limit)->offset($offset)->get()->result_array();

		return $rows;
	}

	/**
	 * 分页逻辑
	 *
	 * @param array $where
	 * @param array $order_by
	 * @param array $group_by
	 *
	 * @return array
	 * @throws \Exception
	 */
	public function search_page($where, $order_by = array(), $group_by = array())
	{
		try {
			$page = $this->input->get('page');
			$page <= 0 && $page = 1;
			$count = $this->count_by_where($where, $group_by);
			$page_total = ceil($count / $this->page_limit);
			$offset = ($page - 1) * $this->page_limit;
			$lists = $this->pagination($where, $this->primary_key, $offset, $order_by, $group_by);
			$lists = $this->fetch_by_ids(array_column($lists, $this->primary_key));
		} catch (Exception $e) {
			$count = 0;
			$page_total = 0;
			$lists = [];
		}

		return array(
			'count'      => $count,
			'page_total' => $page_total,
			'data'       => $lists,
		);
	}
}
