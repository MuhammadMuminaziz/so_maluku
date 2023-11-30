<?php

class Disposisi_Surat_Masuk_model extends CI_Model
{

	private $_table = 'disposisi_surat_masuk';

	public function get()
	{
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function get_by_current_user()
	{
		$CI = &get_instance();
		$CI->load->model('auth_model');

		$current_user = $this->auth_model->current_user();

		$is_biro_umum = $current_user->level_jabatan == LEVEL_KABIRO && $current_user->id_jabatan == JABATAN_BIRO_UMUM;
		if ($is_biro_umum) {
			$this->db->where('surat_masuk.is_provinsi', TRUE);
		} else {
			$this->db->where('surat_masuk.id_penerima', $current_user->id);
		}

		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function find($id)
	{
		if (!$id) {
			return;
		}

		$surat_masuk = $this->db->get_where($this->_table, array('id' => $id))->row();

		$this->db->select('id_opd');
		$surat_masuk->list_id_opd = $this->db->get_where('surat_biasa__opd', array('id_surat_biasa' => $id))->result();
		return $surat_masuk;
	}

	public function find_by_surat_masuk($id)
	{
		if (!$id) {
			return;
		}

		return $this->db->get_where($this->_table, array('id_surat_masuk' => $id))->result();
	}

	public function find_by_surat_masuk_current_user($id)
	{
		if (!$id) {
			return;
		}

		$CI = &get_instance();
		$CI->load->model('auth_model');

		$current_user = $this->auth_model->current_user();

		$this->db->where('id_tujuan', $current_user->id);
		$this->db->where('id_surat_masuk', $id);

		return $this->db->get($this->_table)->row();
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

		$CI = &get_instance();
		$CI->load->model('surat_biasa__opd_model');

		$this->surat_biasa__opd_model->delete($id);

		return $this->db->delete($this->_table, ['id' => $id]);
	}
}
