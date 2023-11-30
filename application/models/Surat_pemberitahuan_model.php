<?php

class Surat_Pemberitahuan_model extends CI_Model
{

	private $_table = 'surat_pemberitahuan';

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

		$list_surat_pemberitahuan__opd = $this->db->get_where('surat_pemberitahuan__opd', array('id_opd' => $id_opd))->result();

		$list_id_surat_pemberitahuan = array_column($list_surat_pemberitahuan__opd, 'id_surat_pemberitahuan');

		if (count($list_id_surat_pemberitahuan) === 0) {
			return [];
		}

		$this->db->where('surat_pemberitahuan.status', PEMBERITAHUAN_APPROVED);
		$this->db->where_in('id', $list_id_surat_pemberitahuan);
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

		$where = array();
		$or_where = array();
		$or_status = null;

		if ($level_jabatan == LEVEL_KABIRO && $id_jabatan == JABATAN_BIRO_UMUM) {
			$status = 'WAITING_APPROVAL_BIRO';
			$or_status = 'WAITING_NUMBER_BIRO';
		} else if ($level_jabatan == LEVEL_SEKDA || $level_jabatan == LEVEL_SEKRE_SEKDA) {
			$status = 'WAITING_APPROVAL_SEKDA';
		} else if ($level_jabatan == LEVEL_KABIRO && $id_jabatan == JABATAN_BIRO_ADMIN) {
			$status = 'APPROVED';
		} else if ($level_jabatan == LEVEL_KADIS) {
			$where['surat_pemberitahuan.id_user'] = $current_user->id;
		}

		if ($status) {
			$where['surat_pemberitahuan.status'] = $status;
		}
		if ($or_status) {
			$or_where['surat_pemberitahuan.status'] = $or_status;
		}

		$this->db->select('surat_pemberitahuan.id, nomor_surat, lampiran, perihal, tanggal_surat, surat_pemberitahuan.isi_surat, list_tembusan, surat_pemberitahuan.status, approved_by, surat_pemberitahuan.id_user id_pemohon, surat_pemberitahuan.doc, opd_from.nama_opd nama_opd_from, GROUP_CONCAT(opd_to.nama_opd SEPARATOR ", ") as nama_opd_to');
		$this->db->join('user', 'user.id = surat_pemberitahuan.id_user', 'left');
		$this->db->join('opd opd_from', 'opd_from.id = user.id_opd', 'left');
		$this->db->join('surat_pemberitahuan__opd', 'surat_pemberitahuan__opd.id_surat_pemberitahuan = surat_pemberitahuan.id', 'left');
		$this->db->join('opd opd_to', 'opd_to.id = surat_pemberitahuan__opd.id_opd', 'left');
		$this->db->where($where);
		$this->db->or_where($or_where);

		$this->db->group_by('surat_pemberitahuan.id');
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function find($id)
	{
		if (!$id) {
			return;
		}

		$surat_pemberitahuan = $this->db->get_where($this->_table, array('id' => $id))->row();

		$this->db->select('id_opd');
		$surat_pemberitahuan->list_id_opd = $this->db->get_where('surat_pemberitahuan__opd', array('id_surat_pemberitahuan' => $id))->result();
		return $surat_pemberitahuan;
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
		$CI->load->model('surat_pemberitahuan__opd_model');

		$this->surat_pemberitahuan__opd_model->delete($id);

		return $this->db->delete($this->_table, ['id' => $id]);
	}
}
