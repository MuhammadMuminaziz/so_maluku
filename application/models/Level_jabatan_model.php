<?php

class Level_Jabatan_model extends CI_Model
{

	private $_table = 'level_jabatan';

	public function get()
	{
		$CI = &get_instance();
		$CI->load->model('auth_model');

		$current_user = $this->auth_model->current_user();

		if ($current_user->level_jabatan == LEVEL_ADMIN_OPD) {
			$this->db->where_in('id', LEVEL_OPD);
		}

		$query = $this->db->get($this->_table);

		return $query->result();
	}

	public function find($id)
	{
		if (!$id) {
			return;
		}

		$query = $this->db->get_where($this->_table, array('id' => $id));
		return $query->row();
	}

	public function insert($article)
	{
		$this->db->insert($this->_table, $article);
		return $this->db->insert_id();
	}

	public function update($article)
	{
		if (!isset($article['id'])) {
			return;
		}

		return $this->db->update($this->_table, $article, ['id' => $article['id']]);
	}

	public function delete($id)
	{
		if (!$id) {
			return;
		}

		return $this->db->delete($this->_table, ['id' => $id]);
	}
}
