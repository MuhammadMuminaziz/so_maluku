<?php

class Auth_model extends CI_Model
{
	private $_table = "user";
	const SESSION_KEY = 'user_id';

	public function rules()
	{
		return [
			[
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required'
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|max_length[255]'
			]
		];
	}

	public function login($username, $password)
	{
		$this->db->where('username', $username);
		$query = $this->db->get($this->_table);
		$user = $query->row();

		// cek apakah user sudah terdaftar?
		if (!$user) {
			return FALSE;
		}

		// cek apakah passwordnya benar?
		if (!password_verify($password, $user->password)) {
			return FALSE;
		}

		// bikin session
		$this->session->set_userdata([self::SESSION_KEY => $user->id]);
		$this->_update_last_login($user->id);

		return $this->session->has_userdata(self::SESSION_KEY);
	}

	public function current_user()
	{
		if (!$this->session->has_userdata(self::SESSION_KEY)) {
			return null;
		}

		$user_id = $this->session->userdata(self::SESSION_KEY);
		$this->db->select('user.id, username, created_at, last_login, user.nama, user.id_opd, id_jabatan, nama_jabatan, level_jabatan.id level_jabatan');
		$this->db->where(['user.id' => $user_id]);
		$this->db->join('jabatan', 'jabatan.id = user.id_jabatan');
		$this->db->join('level_jabatan', 'level_jabatan.id = jabatan.id_level_jabatan');
		$query = $this->db->get($this->_table);
		$res = $query->row();
		return $res;
	}

	public function current_user_password()
	{
		if (!$this->session->has_userdata(self::SESSION_KEY)) {
			return null;
		}

		$user_id = $this->session->userdata(self::SESSION_KEY);
		$this->db->select('password');
		$this->db->where(['id' => $user_id]);
		$query = $this->db->get($this->_table);
		$res = $query->row();
		return $res->password;
	}

	public function logout()
	{
		$this->session->unset_userdata(self::SESSION_KEY);
		return !$this->session->has_userdata(self::SESSION_KEY);
	}

	private function _update_last_login($id)
	{
		$data = [
			'last_login' => date("Y-m-d H:i:s"),
		];

		return $this->db->update($this->_table, $data, ['id' => $id]);
	}

	public function get_kadis_by_opd($id)
	{
		if (!$id) {
			return;
		}

		$this->db->select('user.id, username, created_at, last_login, user.nama, user.id_opd, id_jabatan, nama_jabatan, level_jabatan.id level_jabatan');
		$this->db->where(['user.id_opd' => $id]);
		$this->db->join('jabatan', 'jabatan.id = user.id_jabatan');
		$this->db->join('level_jabatan', 'level_jabatan.id = jabatan.id_level_jabatan');
		$this->db->where(['nama' => 'Kadis']);
		$query = $this->db->get($this->_table);
		$res = $query->row();
		return $res;
	}
}
