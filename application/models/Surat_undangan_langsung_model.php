<?php

class Surat_Undangan_Langsung_model extends CI_Model
{

	private $_table = 'surat_undangan_langsung';

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

		$list_surat_undangan__opd = $this->db->get_where('surat_undangan__opd', array('id_opd' => $id_opd))->result();

		$list_id_surat_undangan = array_column($list_surat_undangan__opd, 'id_surat_undangan');

		if (count($list_id_surat_undangan) === 0) {
			return [];
		}

		$this->db->where('surat_undangan_langsung.status', UNDANGAN_APPROVED);
		$this->db->where_in('id', $list_id_surat_undangan);
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

		if ($level_jabatan == LEVEL_KABIRO && $id_jabatan == JABATAN_BIRO_UMUM) {
			$status = 'WAITING_APPROVAL_BIRO';
		} else if ($level_jabatan == LEVEL_SEKDA || $level_jabatan == LEVEL_SEKRE_SEKDA) {
			$status = 'WAITING_APPROVAL_SEKDA';
		} else if ($level_jabatan == LEVEL_KABIRO && $id_jabatan == JABATAN_BIRO_ADMIN) {
			$status = 'APPROVED';
		} else if ($level_jabatan == LEVEL_KADIS) {
			$where['surat_undangan_langsung.id_user'] = $current_user->id;
		}

		if ($status) {
			$where['surat_undangan_langsung.status'] = $status;
		}

		$this->db->select('surat_undangan_langsung.id, nomor_surat, lampiran, perihal, tanggal_surat, lokasi_kegiatan, surat_undangan_langsung.isi_pendahuluan, surat_undangan_langsung.isi_penutup, list_tembusan, surat_undangan_langsung.status, approved_by, surat_undangan_langsung.id_user id_pemohon, surat_undangan_langsung.doc, opd_from.nama_opd nama_opd_from, GROUP_CONCAT(opd_to.nama_opd SEPARATOR ", ") as nama_opd_to');
		$this->db->join('user', 'user.id = surat_undangan_langsung.id_user', 'left');
		$this->db->join('opd opd_from', 'opd_from.id = user.id_opd', 'left');
		$this->db->join('surat_undangan__opd', 'surat_undangan__opd.id_surat_undangan = surat_undangan_langsung.id', 'left');
		$this->db->join('opd opd_to', 'opd_to.id = surat_undangan__opd.id_opd', 'left');
		$this->db->where($where);
		$this->db->group_by('surat_undangan_langsung.id');
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function find($id)
	{
		if (!$id) {
			return;
		}

		$surat_undangan = $this->db->get_where($this->_table, array('id' => $id))->row();

		$this->db->select('id_opd');
		$surat_undangan->list_id_opd = $this->db->get_where('surat_undangan_langsung__opd', array('id_surat_undangan' => $id))->result();
		return $surat_undangan;
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
		$CI->load->model('surat_undangan__opd_model');

		$this->surat_undangan__opd_model->delete($id);

		return $this->db->delete($this->_table, ['id' => $id]);
	}
}
