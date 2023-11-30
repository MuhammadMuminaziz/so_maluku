<?php

class Surat_Pemberitahuan__OPD_model extends CI_Model
{

	private $_table = 'surat_pemberitahuan__opd';

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

	public function insert($article)
	{
		$this->db->insert($this->_table, $article);
		return $this->db->insert_id();
	}

	public function update($id_surat_undangan, $list_id_opd)
	{
		$this->delete($id_surat_undangan);

		foreach ($list_id_opd as $id_opd) {
			$this->insert([
				'id_surat_pemberitahuan' => $id_surat_undangan,
				'id_opd' => $id_opd
			]);
		}
	}

	public function delete($id)
	{
		if (!$id) {
			return;
		}

		return $this->db->delete($this->_table, ['id_surat_pemberitahuan' => $id]);
	}
}
