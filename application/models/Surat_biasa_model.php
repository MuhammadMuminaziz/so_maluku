<?php

class Surat_Biasa_model extends CI_Model
{

	private $_table = 'surat_biasa';

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

		$id_opd = $current_user->id_opd;

		$list_surat_biasa__opd = $this->db->get_where('surat_biasa__opd', array('id_opd' => $id_opd))->result();

		$list_id_surat_biasa = array_column($list_surat_biasa__opd, 'id_surat_biasa');

		if (count($list_id_surat_biasa) === 0) {
			return [];
		}

		$this->db->where('surat_biasa.status', BIASA_APPROVED);
		$this->db->where_in('id', $list_id_surat_biasa);
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function find_by_status($status)
	{
		$CI = &get_instance();
		$CI->load->model('auth_model');

		$current_user = $this->auth_model->current_user();

		$level_jabatan = $current_user->level_jabatan;
		$id_jabatan = $current_user->id_jabatan;
		$id_opd = $current_user->id_opd;

		$where = array();
		$where_in_status = array();

		if ($level_jabatan == LEVEL_KABAG_KABID) {
			$where['surat_biasa.id_kabag'] = $current_user->id;
			$where_in_status = array(BIASA_WAITING_APPROVAL_KABAG, BIASA_WAITING_APPROVAL_SEKDIS, BIASA_WAITING_APPROVAL_KADIS, BIASA_WAITING_APPROVAL_ASISTEN, BIASA_WAITING_APPROVAL_SEKDA, BIASA_WAITING_NUMBER_BIRO, BIASA_WAITING_NUMBER_TU, BIASA_APPROVED);
		} else if ($level_jabatan == LEVEL_SEKDIS) {
			$where_in_status = array(BIASA_WAITING_APPROVAL_SEKDIS, BIASA_WAITING_APPROVAL_KADIS, BIASA_WAITING_APPROVAL_ASISTEN, BIASA_WAITING_APPROVAL_SEKDA, BIASA_WAITING_NUMBER_BIRO, BIASA_WAITING_NUMBER_TU, BIASA_APPROVED);
		} else if ($level_jabatan == LEVEL_KADIS) {
			$where_in_status = array(BIASA_WAITING_APPROVAL_KADIS, BIASA_WAITING_APPROVAL_ASISTEN, BIASA_WAITING_APPROVAL_SEKDA, BIASA_WAITING_NUMBER_BIRO, BIASA_WAITING_NUMBER_TU, BIASA_APPROVED);
		} else if ($level_jabatan == LEVEL_ASISTEN) {  // akun provinsi
			$where['surat_biasa.id_asisten'] = $current_user->id;
			$where_in_status = array(BIASA_WAITING_APPROVAL_ASISTEN, BIASA_WAITING_APPROVAL_SEKDA, BIASA_WAITING_NUMBER_BIRO);
		} else if ($level_jabatan == LEVEL_SEKDA) {
			$where_in_status = array(BIASA_WAITING_APPROVAL_SEKDA, BIASA_WAITING_NUMBER_BIRO);
		} else if ($level_jabatan == LEVEL_KABIRO) {  // akun provinsi
			$where['surat_biasa.is_langsung'] = 0;
			$where_in_status = array(BIASA_WAITING_NUMBER_BIRO, BIASA_WAITING_NUMBER_TU, BIASA_APPROVED);
		} else if ($level_jabatan == LEVEL_TU) {
			$where_in_status = array(BIASA_WAITING_NUMBER_TU, BIASA_APPROVED);
		} else if ($level_jabatan == LEVEL_ADMIN_OPD) {
			$where['opd_from.id'] = $current_user->id_opd;
		} else {
			$where['surat_biasa.id_user'] = $current_user->id;
		}

		$this->db->select('surat_biasa.id, is_langsung, nama_surat, nomor_surat, nomor_surat_biro, lampiran, doc_lampiran, perihal, tanggal_surat, surat_biasa.isi_surat, surat_biasa.revisi, list_tembusan, surat_biasa.status, approved_by, surat_biasa.id_user id_pemohon, surat_biasa.doc, opd_from.nama_opd nama_opd_from, GROUP_CONCAT(opd_to.nama_opd SEPARATOR ", ") as nama_opd_to');
		$this->db->join('user', 'user.id = surat_biasa.id_user', 'left');
		$this->db->join('opd opd_from', 'opd_from.id = user.id_opd', 'left');
		$this->db->join('surat_biasa__opd', 'surat_biasa__opd.id_surat_biasa = surat_biasa.id', 'left');
		$this->db->join('opd opd_to', 'opd_to.id = surat_biasa__opd.id_opd', 'left');

		if ($current_user->id_opd == null) {
			$bool = false;
		} elseif ($current_user->id_opd == 0) {
			$bool = false;
		} else {
			$bool = true;
		}


		if ($bool) {
			$where['user.id_opd'] = $current_user->id_opd;
		}

		$this->db->where($where);
		if (!empty($where_in_status)) {
			$this->db->where_in('surat_biasa.status', $where_in_status);
		}
		$this->db->group_by('surat_biasa.id');
		$this->db->order_by('surat_biasa.status', 'ASC');
		$this->db->order_by('surat_biasa.created_date', 'DESC');

		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function find($id)
	{
		if (!$id) {
			return;
		}

		$surat_biasa = $this->db->get_where($this->_table, array('id' => $id))->row();

		$this->db->select('id_opd');
		$surat_biasa->list_id_opd = $this->db->get_where('surat_biasa__opd', array('id_surat_biasa' => $id))->result();
		return $surat_biasa;
	}

	public function find_by_doc($file_name)
	{
		if (!$file_name) {
			return;
		}

		$surat_biasa = $this->db->get_where($this->_table, array('doc' => $file_name))->row();
		return $surat_biasa;
	}

	public function find_by_id($id)
	{
		if (!$id) {
			return;
		}

		$surat_biasa = $this->db->get_where($this->_table, array('id' => $id))->row();
		return $surat_biasa;
	}

	public function insert($article)
	{
		$CI = &get_instance();
		$CI->load->helper('log_helper');
		$article = decorate_create($article);

		$this->db->insert($this->_table, $article);
		return $this->db->insert_id();
	}

	public function update($article)
	{
		if (!isset($article['id'])) {
			return;
		}

		$CI = &get_instance();
		$CI->load->helper('log');
		$article = decorate_update($article);

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
