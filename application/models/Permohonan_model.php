<?php

class Permohonan_model extends CI_Model
{

	private $_table = 'permohonan';

	public function get()
	{
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function get_published($limit = null, $offset = null)
	{
		if (!$limit && $offset) {
			$query = $this->db
				->get_where($this->_table, ['draft' => 'FALSE']);
		} else {
			$query =  $this->db
				->get_where($this->_table, ['draft' => 'FALSE'], $limit, $offset);
		}
		return $query->result();
	}

	public function find_by_status($status)
	{
		$CI = &get_instance();
		$CI->load->model('auth_model');

		$current_user = $this->auth_model->current_user();

		$level_jabatan = $current_user->level_jabatan;

		$where = array();
		$where_in_status = array();

		if ($level_jabatan == LEVEL_KABAG_KABID) {
			$where['permohonan.status'] = PERMOHONAN_WAITING_APPROVAL_KABAG;
		} else if ($level_jabatan == LEVEL_SEKDIS) {
			$where['permohonan.status'] = PERMOHONAN_WAITING_APPROVAL_SEKDIS;
		} else if ($level_jabatan == LEVEL_KADIS) {
			$where_in_status = array(PERMOHONAN_WAITING_APPROVAL_KADIS, );
		} else if ($level_jabatan == LEVEL_SEKDA) {
			$where['permohonan.status'] = PERMOHONAN_WAITING_APPROVAL_SEKDA;
		} else if ($level_jabatan == LEVEL_KABIRO) {
			$where_in_status = array(PERMOHONAN_WAITING_NUMBER_BIRO, PERMOHONAN_APPROVED);
		} else if ($level_jabatan == LEVEL_TU) {
			// $where['permohonan.status'] = PERMOHONAN_WAITING_NUMBER_TU;
			$where['opd.id'] = $current_user->id_opd;
		} else if ($level_jabatan == LEVEL_ADMIN_OPD) {
			$where['opd.id'] = $current_user->id_opd;
		} else {
			$where['permohonan.id_user'] = $current_user->id;
		}

		if (in_array($level_jabatan, LEVEL_OPD)) {
			$where['opd.id'] = $current_user->id_opd;
		}

		$this->db->select('permohonan.id, nomor_surat, lampiran, hal, tanggal, tempat, permohonan.isi, manfaat, permohonan.status, spt.status spt_status, approved_by, permohonan.id_user id_pemohon, dari, ke, tanggal_berangkat, tanggal_pulang, opd.nama_opd');
		$this->db->join('spt', 'spt.id_permohonan = permohonan.id', 'left');
		$this->db->join('user', 'user.id = permohonan.id_user', 'left');
		$this->db->join('opd', 'opd.id = user.id_opd', 'left');
		$this->db->where($where);
		if (!empty($where_in_status)) {
			$this->db->where_in('permohonan.status', $where_in_status);
		}
		$this->db->order_by('permohonan.status', 'ASC');

		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function find($id)
	{
		if (!$id) {
			return;
		}

		$this->db->select('permohonan.*, opd.nama_opd');
		$this->db->join('user', 'user.id = permohonan.id_user', 'left');
		$this->db->join('opd', 'opd.id = user.id_opd', 'left');
		$query = $this->db->get_where($this->_table, array('permohonan.id' => $id));
		return $query->row();
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

		return $this->db->delete($this->_table, ['id' => $id]);
	}
}
