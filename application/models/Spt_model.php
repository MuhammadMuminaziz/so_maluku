<?php

class Spt_model extends CI_Model
{

	private $_table = 'spt';

	public function get()
	{
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

	public function find_by_permohonan($id)
	{
		if (!$id) {
			return;
		}

		$query = $this->db->get_where($this->_table, array('id_permohonan' => $id));
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
