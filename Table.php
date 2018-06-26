<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!defined('TABLE_PHP')) {
define('TABLE_PHP', TRUE);

class Table_Model extends CI_Model {

	private $table = NULL;

	public function __construct($name = NULL)
	{
		$this->set_table($name);
	}

	public function set_table($name)
	{
		$this->table = $name;
		return $this;
	}

	private function _where($where = NULL, $wh_data = NULL)
	{
		if ($where != NULL)
		{
			$this->db->where($where, $wh_data);
		}
	}

	public function where($where = NULL, $wh_data = NULL)
	{
		$this->_where($where, $wh_data);
		return $this;
	}

	public function limit($value, $offset = 0)
	{
		$this->db->limit($value, $offset);
		return $this;
	}

	public function order_by($orderby, $direction = '', $escape = NULL)
	{
		$this->db->order_by($orderby, $direction, $escape);
		return $this;
	}

	public function insert($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function update($data, $where = NULL, $wh_data = NULL)
	{
		$this->_where($where, $wh_data);
		return $this->db->update($this->table, $data);
	}

	public function get($where = NULL, $wh_data = NULL)
	{
		$this->_where($where, $wh_data);
		return $this->db->get($this->table)->result();
	}	

	public function delete($where = NULL, $wh_data = NULL)
	{
		$this->_where($where, $wh_data);
		return $this->db->delete($this->table);
	}

	public function count($where = NULL, $wh_data = NULL)
	{
		$this->_where($where, $wh_data);
		return $this->db->count_all_results($this->table);
	}

	public function post_data($names, $xss_clean = NULL)
	{
		$result = Array();

		foreach ($names as $key) {
			$xss_c = $xss_clean;
			if (is_array($xss_c))
			{
				if (isset($xss_c[0]))
				{
					$xss_c = in_array($key, $xss_c) ? TRUE : NULL;
				}
				else
				{
					$xss_c = isset($xss_c[$key]) ? $xss_c[$key] : NULL;
				}
			}

			$result[$key] = $this->input->post($key, $xss_c);
		}

		return $result;
	}
}

class Table extends Table_Model {}

}