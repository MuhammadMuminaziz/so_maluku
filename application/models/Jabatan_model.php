<?php

class Jabatan_model extends CI_Model
{

	private $_table = 'jabatan';

	public function get()
	{
		$CI = &get_instance();
		$CI->load->model('auth_model');

		$current_user = $this->auth_model->current_user();

		if ($current_user->level_jabatan == LEVEL_ADMIN_OPD) {
			$this->db->where('jabatan.id_opd', $current_user->id_opd);
		}

		$this->db->select('jabatan.id, jabatan.nama_jabatan, level_jabatan.id id_level_jabatan, level_jabatan.nama nama_level_jabatan, COUNT(user.id) count_user');
		$this->db->join('level_jabatan', 'jabatan.id_level_jabatan = level_jabatan.id', 'left');
		$this->db->join('user', 'user.id_jabatan = jabatan.id', 'left');
		$this->db->group_by('jabatan.id');

		// $this->db->select('jabatan.id, jabatan.nama_jabatan, level_jabatan.id id_level_jabatan, level_jabatan.nama nama_level_jabatan');
		// $this->db->join('level_jabatan', 'jabatan.id_level_jabatan = level_jabatan.id', 'left');

		$query = $this->db->get($this->_table);

		return $query->result();
	}

	public function get_by_level($level)
	{
		$this->db->select('jabatan.id, jabatan.nama_jabatan, level_jabatan.id id_level_jabatan, level_jabatan.nama nama_level_jabatan, COUNT(user.id) count_user');
		$this->db->join('level_jabatan', 'jabatan.id_level_jabatan = level_jabatan.id', 'left');
		$this->db->join('user', 'user.id_jabatan = jabatan.id', 'left');
		$this->db->where_in('level_jabatan.id', $level);
		$this->db->group_by('jabatan.id');

		$query = $this->db->get($this->_table);

		return $query->result();
	}

	public function get_by_level_opd($level, $id_opd)
	{
		$this->db->select('jabatan.id, jabatan.nama_jabatan, level_jabatan.id id_level_jabatan, level_jabatan.nama nama_level_jabatan, COUNT(user.id) count_user');
		$this->db->join('level_jabatan', 'jabatan.id_level_jabatan = level_jabatan.id', 'left');
		$this->db->join('user', 'user.id_jabatan = jabatan.id', 'left');
		$this->db->where('jabatan.id_opd', $id_opd);
		$this->db->where_in('level_jabatan.id', $level);
		$this->db->group_by('jabatan.id');

		$query = $this->db->get($this->_table);

		return $query->result();
	}

	public function get_list_asisten()
	{
		$this->db->select('jabatan.id, jabatan.nama_jabatan, level_jabatan.id id_level_jabatan, level_jabatan.nama nama_level_jabatan, user.id id_user, user.nama nama_user');
		$this->db->join('level_jabatan', 'jabatan.id_level_jabatan = level_jabatan.id', 'left');
		$this->db->join('user', 'user.id_jabatan = jabatan.id', 'left');
		$this->db->where('level_jabatan.id', LEVEL_ASISTEN);
		// $this->db->group_by('jabatan.id');

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
