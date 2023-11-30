<?php

class Pangkat_Gol_model extends CI_Model
{

	private $_table = 'pangkat_gol';

	public function get()
	{
		// $query = $this->db->get($this->_table);

		// $this->db->select('jabatan.id, jabatan.nama_jabatan, level_jabatan.id id_level_jabatan, level_jabatan.nama nama_level_jabatan, COUNT(user.id) count_user');
		// $this->db->join('level_jabatan', 'jabatan.id_level_jabatan = level_jabatan.id', 'left');
		// $this->db->join('user', 'user.id_jabatan = jabatan.id', 'left');
		// $this->db->group_by('jabatan.id');

		// $this->db->select('jabatan.id, jabatan.nama_jabatan, level_jabatan.id id_level_jabatan, level_jabatan.nama nama_level_jabatan');
		// $this->db->join('level_jabatan', 'jabatan.id_level_jabatan = level_jabatan.id', 'left');

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

	// public function find_by_permohonan($id)
	// {
	// 	if (!$id) {
	// 		return;
	// 	}

	// 	$query = $this->db->get_where($this->_table, array('id_permohonan' => $id));
	// 	return $query->row();
	// }

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
