<?php 

class Lampiran_model extends CI_Model{

    private $_table = 'lampiran';

	public function find_by_surat_biasa($id)
	{
		if (!$id) {
			return;
		}
		
		$query = $this->db->get_where($this->_table, array('surat_biasa_id' => $id));
		return $query->row();
	}

	public function find_by_surat_permohonan($id)
	{
		if (!$id) {
			return;
		}
		
		$query = $this->db->get_where($this->_table, array('surat_permohonan_id' => $id));
		return $query->row();
	}

    public function insert($article)
	{
		$CI = &get_instance();
		$CI->load->helper('log_helper');
		// $article = decorate_create($article);

		$this->db->insert($this->_table, $article);
		return $this->db->insert_id();
	}
}