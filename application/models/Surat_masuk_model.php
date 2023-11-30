<?php

class Surat_Masuk_model extends CI_Model
{

	private $_table = 'surat_masuk';

	public function get()
	{
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function get_by_current_user()
	{
		$CI = &get_instance();
		$CI->load->model('auth_model');
		$CI->load->model('user_model');

		$current_user = $this->auth_model->current_user();

		$is_biro_umum = $current_user->level_jabatan == LEVEL_KABIRO && $current_user->id_jabatan == JABATAN_BIRO_UMUM;
		if ($is_biro_umum) {
			$this->db->where('surat_masuk.is_provinsi', TRUE);
		} else {
			$id_penerima = $current_user->id;
			$is_level_tu = $current_user->level_jabatan == LEVEL_TU;
			if ($is_level_tu) {
				$id_penerima = $this->user_model->find_kadis_opd($current_user->id_opd)->id;
			}
			$this->db->where('surat_masuk.id_penerima', $id_penerima);

			if (!$is_level_tu) {
				$this->db->where('surat_masuk.status', MASUK_FINAL);
			}
		}

		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function get_by_current_user_1()
	{
		$CI = &get_instance();
		$CI->load->model('auth_model');
		$CI->load->model('user_model');
		$CI->load->model('surat_masuk_penerima_model');

		$current_user = $this->auth_model->current_user();

		$is_biro_umum = $current_user->level_jabatan == LEVEL_KABIRO && $current_user->id_jabatan == JABATAN_BIRO_UMUM;
		if ($is_biro_umum) {
			$this->db->where('surat_masuk.is_provinsi', TRUE);
		} else {
			$id_penerima = $current_user->id;
			$is_level_tu = $current_user->level_jabatan == LEVEL_TU;
			if ($is_level_tu) {
				$id_penerima = $this->user_model->find_kadis_opd($current_user->id_opd)->id;
			}

			$penerima = $this->surat_masuk_penerima_model->get_by_penerima($id_penerima);
			if ($penerima != null) {
				$this->db->where_in('surat_masuk.id', $penerima);
			} else {
				$this->db->where('surat_masuk.id_penerima', $id_penerima);
			}

			if (!$is_level_tu) {
				$this->db->where('surat_masuk.status', MASUK_FINAL);
			}
		}

		$this->db->where('surat_masuk.id_surat_keluar !=', null);
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function get_by_current_user_2()
	{
		$CI = &get_instance();
		$CI->load->model('auth_model');
		$CI->load->model('user_model');
		$CI->load->model('surat_masuk_penerima_model');

		$current_user = $this->auth_model->current_user();

		$is_biro_umum = $current_user->level_jabatan == LEVEL_KABIRO && $current_user->id_jabatan == JABATAN_BIRO_UMUM;
		if ($is_biro_umum) {
			$this->db->where('surat_masuk.is_provinsi', TRUE);
		} else {
			$id_penerima = $current_user->id;
			$is_level_tu = $current_user->level_jabatan == LEVEL_TU;
			if ($is_level_tu) {
				$id_penerima = $this->user_model->find_kadis_opd($current_user->id_opd)->id;
			}

			$penerima = $this->surat_masuk_penerima_model->get_by_penerima($id_penerima);
			if ($penerima != null) {
				$this->db->where_in('surat_masuk.id', $penerima);
			} else {
				$this->db->where('surat_masuk.id_penerima', $id_penerima);
			}

			if (!$is_level_tu) {
				$this->db->where('surat_masuk.status', MASUK_FINAL);
			}
		}
		$this->db->where('surat_masuk.id_surat_keluar', null);
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function find($id)
	{
		if (!$id) {
			return;
		}

		$surat_masuk = $this->db->get_where($this->_table, array('id' => $id))->row();

		$CI = &get_instance();
		$CI->load->model('disposisi_surat_masuk_model');
		$disposisi = $this->disposisi_surat_masuk_model->find_by_surat_masuk_current_user($id);
		$surat_masuk->disposisi = $disposisi;

		$CI->load->model('surat_biasa_model');
		$surat_biasa = $this->surat_biasa_model->find($surat_masuk->id_surat_keluar);
		$surat_masuk->surat_biasa = $surat_biasa;
		return $surat_masuk;
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
