<?php

class Opd_model extends CI_Model
{

	private $_table = 'opd';

	public function get()
	{
		// 'SELECT  FROM `opd` LEFT JOIN jabatan on jabatan.id_opd = opd.id GROUP BY opd.id, opd.nama_opd'

		$this->db->select('opd.id, nama_opd, COUNT(jabatan.id) count_jabatan');
		$this->db->join('jabatan', 'jabatan.id_opd = opd.id', 'left');
		$this->db->join('level_jabatan', 'jabatan.id_level_jabatan = level_jabatan.id', 'left');
		// $this->db->where('level_jabatan.id', 8); // filter by kadis
		$this->db->group_by('opd.id, opd.nama_opd');
		$query = $this->db->get($this->_table);
		return $query->result();
	}
	
	public function list_opd()
	{
		$this->db->select('opd.id, nama_opd, COUNT(jabatan.id) count_jabatan');
		$this->db->join('jabatan', 'jabatan.id_opd = opd.id', 'left');
		$this->db->join('level_jabatan', 'jabatan.id_level_jabatan = level_jabatan.id', 'left');
		$this->db->where('level_jabatan.id', 8);
		$this->db->group_by('opd.id, opd.nama_opd');
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

	public function find_list($list_id_opd)
	{
		$this->db->where_in('id', $list_id_opd);
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function find_by_jabatan($id)
	{
		if (!$id) {
			return;
		}

		$this->load->model('jabatan_model');

		$jabatan = $this->jabatan_model->find($id);

		if (!$jabatan) {
			return;
		}

		return $this->find($jabatan->id_opd);
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
