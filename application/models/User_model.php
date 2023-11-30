<?php

class User_model extends CI_Model
{

	private $_table = 'user';

	public function get()
	{
		$this->db->select('user.id, user.username, user.created_at, user.last_login, user.nama, user.nip, user.email, user.no_telp, jabatan.id id_jabatan, jabatan.nama_jabatan, level_jabatan.id id_level_jabatan, level_jabatan.nama nama_level_jabatan, pangkat_gol.pangkat, pangkat_gol.golongan, pangkat_gol.ruang, opd.nama_opd');
		$this->db->join('jabatan', 'user.id_jabatan = jabatan.id', 'left');
		$this->db->join('level_jabatan', 'jabatan.id_level_jabatan = level_jabatan.id', 'left');
		$this->db->join('pangkat_gol', 'user.id_pangkat_gol = pangkat_gol.id', 'left');
		$this->db->join('opd', 'user.id_opd = opd.id', 'left');

		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function get_for_opt($id_opd)
	{
		$this->db->select('user.id, user.username, user.created_at, user.last_login, user.nama, user.nip, user.email, user.no_telp, jabatan.id id_jabatan, jabatan.nama_jabatan, level_jabatan.id id_level_jabatan, level_jabatan.nama nama_level_jabatan, pangkat_gol.pangkat, pangkat_gol.golongan, pangkat_gol.ruang, opd.nama_opd');
		$this->db->where('opd.id', $id_opd);
		$this->db->where_in('jabatan.id_level_jabatan', array(LEVEL_KADIS, LEVEL_SEKDIS, LEVEL_KABAG_KABID, LEVEL_TU, LEVEL_KASUBAG_KASIE));
		$this->db->join('jabatan', 'user.id_jabatan = jabatan.id', 'left');
		$this->db->join('level_jabatan', 'jabatan.id_level_jabatan = level_jabatan.id', 'left');
		$this->db->join('pangkat_gol', 'user.id_pangkat_gol = pangkat_gol.id', 'left');
		$this->db->join('opd', 'user.id_opd = opd.id', 'left');

		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function get_opt()
	{
		$this->db->select('user.id, user.username, user.created_at, user.last_login, user.nama, user.nip, user.email, user.no_telp, jabatan.id id_jabatan, jabatan.nama_jabatan, level_jabatan.id id_level_jabatan, level_jabatan.nama nama_level_jabatan, pangkat_gol.pangkat, pangkat_gol.golongan, pangkat_gol.ruang, opd.nama_opd');
		$this->db->where('jabatan.id_level_jabatan', LEVEL_ADMIN_OPD);
		$this->db->join('jabatan', 'user.id_jabatan = jabatan.id', 'left');
		$this->db->join('level_jabatan', 'jabatan.id_level_jabatan = level_jabatan.id', 'left');
		$this->db->join('pangkat_gol', 'user.id_pangkat_gol = pangkat_gol.id', 'left');
		$this->db->join('opd', 'user.id_opd = opd.id', 'left');

		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function get_provinsi()
	{
		$this->db->select('user.id, user.username, user.created_at, user.last_login, user.nama, user.nip, user.email, user.no_telp, jabatan.id id_jabatan, jabatan.nama_jabatan, level_jabatan.id id_level_jabatan, level_jabatan.nama nama_level_jabatan, pangkat_gol.pangkat, pangkat_gol.golongan, pangkat_gol.ruang, opd.nama_opd');
		$this->db->where('level_jabatan.is_provinsi', TRUE);
		$this->db->join('jabatan', 'user.id_jabatan = jabatan.id', 'left');
		$this->db->join('level_jabatan', 'jabatan.id_level_jabatan = level_jabatan.id', 'left');
		$this->db->join('pangkat_gol', 'user.id_pangkat_gol = pangkat_gol.id', 'left');
		$this->db->join('opd', 'user.id_opd = opd.id', 'left');

		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function get_kabag()
	{
		$CI = &get_instance();
		$CI->load->model('auth_model');

		$current_user = $this->auth_model->current_user();

		$this->db->select('user.*, jabatan.nama_jabatan');
		$this->db->join('jabatan', 'user.id_jabatan = jabatan.id', 'left');
		$this->db->join('level_jabatan', 'jabatan.id_level_jabatan = level_jabatan.id', 'left');
		$this->db->where('level_jabatan.id', LEVEL_KABAG_KABID);
		$this->db->where('user.id_opd', $current_user->id_opd);

		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function get_asekda()
	{
		$this->db->select('user.*, jabatan.nama_jabatan');
		$this->db->join('jabatan', 'user.id_jabatan = jabatan.id', 'left');
		$this->db->join('level_jabatan', 'jabatan.id_level_jabatan = level_jabatan.id', 'left');
		$this->db->where('level_jabatan.id', LEVEL_ASISTEN);

		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function get_penerima_surat_masuk()
	{
		$CI = &get_instance();
		$CI->load->model('auth_model');

		$current_user = $this->auth_model->current_user();
		$is_biro_umum = $current_user->level_jabatan == LEVEL_KABIRO && $current_user->id_jabatan == JABATAN_BIRO_UMUM;

		if ($is_biro_umum)
			$this->db->where_in('level_jabatan.id', array(LEVEL_GUB, LEVEL_SEKDA));
		else {
			$this->db->where_in('level_jabatan.id', array(LEVEL_KADIS));
			$this->db->where('user.id_opd', $current_user->id_opd);
		}

		$this->db->select('user.*, jabatan.nama_jabatan');
		$this->db->join('jabatan', 'user.id_jabatan = jabatan.id', 'left');
		$this->db->join('level_jabatan', 'jabatan.id_level_jabatan = level_jabatan.id', 'left');

		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function get_tujuan_surat_masuk()
	{
		$CI = &get_instance();
		$CI->load->model('auth_model');

		$current_user = $this->auth_model->current_user();

		if ($current_user->level_jabatan == LEVEL_GUB) {
			$this->db->where_in('level_jabatan.id', array(LEVEL_SEKDA, LEVEL_KADIS));
		} else if ($current_user->level_jabatan == LEVEL_SEKDA) {
			$this->db->where_in('level_jabatan.id', array(LEVEL_KADIS));
		} else if ($current_user->level_jabatan == LEVEL_TU) {
			$this->db->where_in('level_jabatan.id', array(LEVEL_KADIS));
			$this->db->where('user.id_opd', $current_user->id_opd);
		} else if ($current_user->level_jabatan == LEVEL_KADIS) {
			$this->db->where_in('level_jabatan.id', array(LEVEL_KABAG_KABID));
			$this->db->where('user.id_opd', $current_user->id_opd);
		} else if ($current_user->level_jabatan == LEVEL_KABAG_KABID) {
			$this->db->where_in('level_jabatan.id', array(LEVEL_KASUBAG_KASIE));
			$this->db->where('user.id_opd', $current_user->id_opd);
		}

		$this->db->select('user.*, jabatan.nama_jabatan');
		$this->db->join('jabatan', 'user.id_jabatan = jabatan.id', 'left');
		$this->db->join('level_jabatan', 'jabatan.id_level_jabatan = level_jabatan.id', 'left');

		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function find($id)
	{
		if (!$id) {
			return;
		}

		$this->db->select('user.id, user.username, user.created_at, user.last_login, user.nama, user.nip, user.email, user.no_telp, jabatan.id id_jabatan, jabatan.nama_jabatan, level_jabatan.id id_level_jabatan, level_jabatan.nama nama_level_jabatan, pangkat_gol.id id_pangkat_gol, pangkat_gol.pangkat, pangkat_gol.golongan, pangkat_gol.ruang, opd.id id_opd, opd.nama_opd, opd.alamat_opd, opd.alamat_elektronik_opd');
		$this->db->where('user.id', $id);
		$this->db->join('jabatan', 'user.id_jabatan = jabatan.id', 'left');
		$this->db->join('level_jabatan', 'jabatan.id_level_jabatan = level_jabatan.id', 'left');
		$this->db->join('pangkat_gol', 'user.id_pangkat_gol = pangkat_gol.id', 'left');
		$this->db->join('opd', 'user.id_opd = opd.id', 'left');

		$query = $this->db->get($this->_table);

		return $query->row();
	}

	public function find_kadis_opd($id_opd)
	{
		$this->db->select('user.id, user.username, user.created_at, user.last_login, user.nama, user.nip, user.email, user.no_telp, jabatan.id id_jabatan, jabatan.nama_jabatan, level_jabatan.id id_level_jabatan, level_jabatan.nama nama_level_jabatan, pangkat_gol.id id_pangkat_gol, pangkat_gol.pangkat, pangkat_gol.golongan, pangkat_gol.ruang, opd.id id_opd, opd.nama_opd, opd.alamat_opd, opd.alamat_elektronik_opd');
		$this->db->where('level_jabatan.id', LEVEL_KADIS);
		$this->db->where('opd.id', $id_opd);
		$this->db->join('jabatan', 'user.id_jabatan = jabatan.id', 'left');
		$this->db->join('level_jabatan', 'jabatan.id_level_jabatan = level_jabatan.id', 'left');
		$this->db->join('pangkat_gol', 'user.id_pangkat_gol = pangkat_gol.id', 'left');
		$this->db->join('opd', 'user.id_opd = opd.id', 'left');

		$query = $this->db->get($this->_table);

		return $query->row();
	}

	public function find_sekda()
	{
		$this->db->select('user.id, user.username, user.created_at, user.last_login, user.nama, user.nip, user.email, user.no_telp, jabatan.id id_jabatan, jabatan.nama_jabatan, level_jabatan.id id_level_jabatan, level_jabatan.nama nama_level_jabatan, pangkat_gol.id id_pangkat_gol, pangkat_gol.pangkat, pangkat_gol.golongan, pangkat_gol.ruang, opd.id id_opd, opd.nama_opd, opd.alamat_opd, opd.alamat_elektronik_opd');
		$this->db->where('level_jabatan.id', LEVEL_SEKDA);
		$this->db->join('jabatan', 'user.id_jabatan = jabatan.id', 'left');
		$this->db->join('level_jabatan', 'jabatan.id_level_jabatan = level_jabatan.id', 'left');
		$this->db->join('pangkat_gol', 'user.id_pangkat_gol = pangkat_gol.id', 'left');
		$this->db->join('opd', 'user.id_opd = opd.id', 'left');

		$query = $this->db->get($this->_table);

		return $query->row();
	}

	public function find_gubernur()
	{
		$this->db->select('user.id, user.username, user.created_at, user.last_login, user.nama, user.nip, user.email, user.no_telp, jabatan.id id_jabatan, jabatan.nama_jabatan, level_jabatan.id id_level_jabatan, level_jabatan.nama nama_level_jabatan, pangkat_gol.id id_pangkat_gol, pangkat_gol.pangkat, pangkat_gol.golongan, pangkat_gol.ruang, opd.id id_opd, opd.nama_opd, opd.alamat_opd, opd.alamat_elektronik_opd');
		$this->db->where('level_jabatan.id', LEVEL_GUB);
		$this->db->join('jabatan', 'user.id_jabatan = jabatan.id', 'left');
		$this->db->join('level_jabatan', 'jabatan.id_level_jabatan = level_jabatan.id', 'left');
		$this->db->join('pangkat_gol', 'user.id_pangkat_gol = pangkat_gol.id', 'left');
		$this->db->join('opd', 'user.id_opd = opd.id', 'left');

		$query = $this->db->get($this->_table);

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

	public function is_user_exist($user_name)
	{
		$this->db->select('username');
		$this->db->where('username',$user_name);
		$query = $this->db->get($this->_table);
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
}
