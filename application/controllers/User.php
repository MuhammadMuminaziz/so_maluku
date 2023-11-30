<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		if (!$this->auth_model->current_user()) {
			redirect('auth/login');
		}
	}

	public function index()
	{
		$this->load->model('user_model');

		$current_user = $this->auth_model->current_user();

		$data['current_user'] = $current_user;

		$data['list_user'] = $this->user_model->get();

		$this->template->load('templates/admin_template', 'user/user_index', $data);
	}

	public function for_opt()
	{
		$this->load->model('user_model');

		$current_user = $this->auth_model->current_user();

		$data['current_user'] = $current_user;

		$data['list_user'] = $this->user_model->get_for_opt($current_user->id_opd);

		$this->template->load('templates/admin_template', 'user/for_opt_index', $data);
	}

	public function opt()
	{
		$this->load->model('user_model');

		$current_user = $this->auth_model->current_user();

		$data['current_user'] = $current_user;

		$data['list_user'] = $this->user_model->get_opt();

		$this->template->load('templates/admin_template', 'user/opt_index', $data);
	}

	public function new()
	{
		$this->load->model('opd_model');
		$this->load->model('jabatan_model');
		$this->load->model('pangkat_gol_model');
		$data['list_opd'] = $this->opd_model->get();
		$data['list_jabatan'] = $this->jabatan_model->get();
		$data['list_pangkat_gol'] = $this->pangkat_gol_model->get();

		if ($this->input->method() === 'post') {
			$this->load->model('user_model');
			// TODO: Lakukan validasi sebelum menyimpan ke model

			$user = [
				'username' => $this->input->post('username'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'nama' => $this->input->post('nama'),
				'nip' => $this->input->post('nip'),
				'email' => $this->input->post('email'),
				'no_telp' => $this->input->post('no_telp'),
				'id_opd' => $this->input->post('id_opd'),
				'id_jabatan' => $this->input->post('id_jabatan'),
				'id_pangkat_gol' => $this->input->post('id_pangkat_gol')
			];

			$id = $this->user_model->insert($user);

			if ($id) {
				redirect('user/ubah/' . $id);
			}
		}

		$this->template->load('templates/admin_template', 'user/user_new', $data);
	}

	public function new_opt()
	{
		$this->load->model('opd_model');
		$this->load->model('jabatan_model');
		$this->load->model('pangkat_gol_model');
		$data['list_opd'] = $this->opd_model->get();
		$data['list_jabatan'] = $this->jabatan_model->get_by_level(array(LEVEL_ADMIN_OPD));
		$data['list_pangkat_gol'] = $this->pangkat_gol_model->get();

		if ($this->input->method() === 'post') {
			$this->load->model('user_model');
			// TODO: Lakukan validasi sebelum menyimpan ke model

			$user = [
				'username' => $this->input->post('username'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'nama' => $this->input->post('nama'),
				'nip' => $this->input->post('nip'),
				'email' => $this->input->post('email'),
				'no_telp' => $this->input->post('no_telp'),
				'id_opd' => $this->input->post('id_opd'),
				'id_jabatan' => $this->input->post('id_jabatan'),
				'id_pangkat_gol' => $this->input->post('id_pangkat_gol')
			];

			$id = $this->user_model->insert($user);

			if ($id) {
				redirect('user/ubah_opt/' . $id);
			}
		}

		$this->template->load('templates/admin_template', 'user/opt_new', $data);
	}

	public function new_for_opt()
	{
		$this->load->model('auth_model');
		$this->load->model('opd_model');
		$this->load->model('jabatan_model');
		$this->load->model('pangkat_gol_model');

		$current_user = $this->auth_model->current_user();
		$data['list_opd'] = array($this->opd_model->find($current_user->id_opd));
		$data['list_jabatan'] = $this->jabatan_model->get_by_level_opd(array(LEVEL_KADIS, LEVEL_SEKDIS, LEVEL_KABAG_KABID, LEVEL_TU, LEVEL_KASUBAG_KASIE), $current_user->id_opd);
		$data['list_pangkat_gol'] = $this->pangkat_gol_model->get();
		$data['current_user'] = $current_user;

		if ($this->input->method() === 'post') {
			$this->load->model('user_model');
			$user_name = $this->input->post('username');

			if ($this->user_model->is_user_exist($user_name))
			{
				$this->session->set_flashdata('message_error', 'Username sudah terpakai. Silahkan gunakan username yang lain.');
				$this->template->load('templates/admin_template', 'user/for_opt_new', $data);
				return;
			}

			$user = [
				'username' => $user_name,
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'nama' => $this->input->post('nama'),
				'nip' => $this->input->post('nip'),
				'email' => $this->input->post('email'),
				'no_telp' => $this->input->post('no_telp'),
				'id_opd' => $this->input->post('id_opd'),
				'id_jabatan' => $this->input->post('id_jabatan'),
				'id_pangkat_gol' => $this->input->post('id_pangkat_gol')
			];

			$id = $this->user_model->insert($user);

			if ($id) {
				redirect('user/ubah_for_opt/' . $id);
			}
		}

		$this->template->load('templates/admin_template', 'user/for_opt_new', $data);
	}

	public function detail($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('permohonan_model');
		$this->load->model('auth_model');

		$data['permohonan'] = $this->permohonan_model->find($id);
		$data['current_user'] = $this->auth_model->current_user();;
		$this->template->load('templates/admin_template', 'user/user_detail', $data);
	}

	public function ubah($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('user_model');
		$this->load->model('opd_model');
		$this->load->model('jabatan_model');
		$this->load->model('pangkat_gol_model');
		$data['list_opd'] = $this->opd_model->get();
		$data['list_jabatan'] = $this->jabatan_model->get();
		$data['list_pangkat_gol'] = $this->pangkat_gol_model->get();

		if ($this->input->method() === 'post') {
			// TODO: Lakukan validasi sebelum menyimpan ke model

			if ($this->input->post('draft') === null) {
				$status = PERMOHONAN_WAITING_APPROVAL_BIRO;
			}

			$user = [
				'id' => $id,
				'username' => $this->input->post('username'),
				'nama' => $this->input->post('nama'),
				'nip' => $this->input->post('nip'),
				'email' => $this->input->post('email'),
				'no_telp' => $this->input->post('no_telp'),
				'id_opd' => $this->input->post('id_opd'),
				'id_jabatan' => $this->input->post('id_jabatan'),
				'id_pangkat_gol' => $this->input->post('id_pangkat_gol')
			];

			$password = $this->input->post('password');

			if (isset($password)) {
				$user['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			}

			$saved = $this->user_model->update($user);

			if ($saved) {
				$this->session->set_flashdata('message_success', 'Data berhasil disimpan.');
			}
		}

		$data['user'] = $this->user_model->find($id);

		$this->template->load('templates/admin_template', 'user/user_ubah', $data);
	}

	public function ubah_opt($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('user_model');
		$this->load->model('opd_model');
		$this->load->model('jabatan_model');
		$this->load->model('pangkat_gol_model');
		$data['list_opd'] = $this->opd_model->get();
		$data['list_jabatan'] = $this->jabatan_model->get_by_level(array(LEVEL_ADMIN_OPD));
		$data['list_pangkat_gol'] = $this->pangkat_gol_model->get();

		if ($this->input->method() === 'post') {
			// TODO: Lakukan validasi sebelum menyimpan ke model

			if ($this->input->post('draft') === null) {
				$status = PERMOHONAN_WAITING_APPROVAL_BIRO;
			}

			$user = [
				'id' => $id,
				'username' => $this->input->post('username'),
				'nama' => $this->input->post('nama'),
				'nip' => $this->input->post('nip'),
				'email' => $this->input->post('email'),
				'no_telp' => $this->input->post('no_telp'),
				'id_opd' => $this->input->post('id_opd'),
				'id_jabatan' => $this->input->post('id_jabatan'),
				'id_pangkat_gol' => $this->input->post('id_pangkat_gol')
			];

			$password = $this->input->post('password');

			if (isset($password)) {
				$user['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			}

			$saved = $this->user_model->update($user);

			if ($saved) {
				$this->session->set_flashdata('message_success', 'Data berhasil disimpan.');
			}
		}

		$data['user'] = $this->user_model->find($id);

		$this->template->load('templates/admin_template', 'user/opt_ubah', $data);
	}

	public function ubah_for_opt($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('auth_model');
		$this->load->model('user_model');
		$this->load->model('opd_model');
		$this->load->model('jabatan_model');
		$this->load->model('pangkat_gol_model');

		$current_user = $this->auth_model->current_user();
		$data['list_opd'] = array($this->opd_model->find($current_user->id_opd));
		$data['list_jabatan'] = $this->jabatan_model->get_by_level_opd(array(LEVEL_KADIS, LEVEL_SEKDIS, LEVEL_KABAG_KABID, LEVEL_TU, LEVEL_KASUBAG_KASIE), $current_user->id_opd);
		$data['list_pangkat_gol'] = $this->pangkat_gol_model->get();

		if ($this->input->method() === 'post') {
			// TODO: Lakukan validasi sebelum menyimpan ke model

			if ($this->input->post('draft') === null) {
				$status = PERMOHONAN_WAITING_APPROVAL_BIRO;
			}

			$user = [
				'id' => $id,
				'username' => $this->input->post('username'),
				'nama' => $this->input->post('nama'),
				'nip' => $this->input->post('nip'),
				'email' => $this->input->post('email'),
				'no_telp' => $this->input->post('no_telp'),
				'id_opd' => $this->input->post('id_opd'),
				'id_jabatan' => $this->input->post('id_jabatan'),
				'id_pangkat_gol' => $this->input->post('id_pangkat_gol')
			];

			$password = $this->input->post('password');

			if (isset($password)) {
				$user['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			}

			$saved = $this->user_model->update($user);

			if ($saved) {
				$this->session->set_flashdata('message_success', 'Data berhasil disimpan.');
			}
		}

		$data['user'] = $this->user_model->find($id);

		$this->template->load('templates/admin_template', 'user/for_opt_ubah', $data);
	}

	public function ubah_profil()
	{
		$this->load->model('auth_model');
		$this->load->model('user_model');
		$this->load->model('opd_model');

		$current_user = $this->auth_model->current_user();

		if ($this->input->method() === 'post') {
			$user = [
				'id' => $current_user->id,
				'nama' => $this->input->post('nama'),
			];

			$saved = $this->user_model->update($user);

			if ($saved) {
				$this->session->set_flashdata('message_success', 'Data berhasil disimpan.');
			}
		}

		$data['user'] = $this->auth_model->current_user();

		$this->template->load('templates/admin_template', 'user/user_ubah_profil', $data);
	}

	public function ubah_password()
	{
		$this->load->model('auth_model');
		$this->load->model('user_model');
		$this->load->model('opd_model');

		$current_user = $this->auth_model->current_user();

		if ($this->input->method() === 'post') {
			$user = [
				'id' => $current_user->id,
			];

			$current_password = $this->auth_model->current_user_password();
			$old_password = $this->input->post('old_password');
			$password = $this->input->post('password');
			$password2 = $this->input->post('password2');

			if (!password_verify($old_password, $current_password)) {
				$this->session->set_flashdata('message_success', 'Password lama salah.');
			} else if ($password !== $password2) {
				$this->session->set_flashdata('message_success', 'Password tidak sama.');
			} else {
				$user['password'] = password_hash($password, PASSWORD_DEFAULT);

				$saved = $this->user_model->update($user);

				if ($saved) {
					$this->session->set_flashdata('message_success', 'Data berhasil disimpan.');
				}
			}
		}

		$data['user'] = $this->auth_model->current_user();

		$this->template->load('templates/admin_template', 'user/user_ubah_password', $data);
	}

	public function hapus($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('user_model');
		$this->user_model->delete($id);

		$this->session->set_flashdata('message_success', 'Data berhasil dihapus.');
		redirect('user');
	}

	public function hapus_opt($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('user_model');
		$this->user_model->delete($id);

		$this->session->set_flashdata('message_success', 'Data berhasil dihapus.');
		redirect('dinas');
	}

	public function hapus_for_opt($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('user_model');
		$this->user_model->delete($id);

		$this->session->set_flashdata('message_success', 'Data berhasil dihapus.');
		redirect('user/for_opt');
	}

	public function provinsi()
	{
		$this->load->model('user_model');

		$current_user = $this->auth_model->current_user();

		$data['current_user'] = $current_user;

		$data['list_user'] = $this->user_model->get_provinsi();

		$this->template->load('templates/admin_template', 'user/provinsi_index', $data);
	}

	public function new_provinsi()
	{
		$this->load->model('opd_model');
		$this->load->model('jabatan_model');
		$this->load->model('pangkat_gol_model');
		$data['list_opd'] = $this->opd_model->get();
		$data['list_jabatan'] = $this->jabatan_model->get_by_level(LEVEL_PROVINSI);
		$data['list_pangkat_gol'] = $this->pangkat_gol_model->get();

		if ($this->input->method() === 'post') {
			$this->load->model('user_model');
			// TODO: Lakukan validasi sebelum menyimpan ke model

			$user = [
				'username' => $this->input->post('username'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'nama' => $this->input->post('nama'),
				'nip' => $this->input->post('nip'),
				'email' => $this->input->post('email'),
				'no_telp' => $this->input->post('no_telp'),
				'id_jabatan' => $this->input->post('id_jabatan'),
				'id_pangkat_gol' => $this->input->post('id_pangkat_gol')
			];

			$id = $this->user_model->insert($user);

			if ($id) {
				redirect('user/ubah_provinsi/' . $id);
			}
		}

		$this->template->load('templates/admin_template', 'user/provinsi_new', $data);
	}

	public function ubah_provinsi($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('user_model');
		$this->load->model('opd_model');
		$this->load->model('jabatan_model');
		$this->load->model('pangkat_gol_model');
		$data['list_opd'] = $this->opd_model->get();
		$data['list_jabatan'] = $this->jabatan_model->get_by_level(LEVEL_PROVINSI);
		$data['list_pangkat_gol'] = $this->pangkat_gol_model->get();

		if ($this->input->method() === 'post') {
			// TODO: Lakukan validasi sebelum menyimpan ke model

			if ($this->input->post('draft') === null) {
				$status = PERMOHONAN_WAITING_APPROVAL_BIRO;
			}

			$user = [
				'id' => $id,
				'username' => $this->input->post('username'),
				'nama' => $this->input->post('nama'),
				'nip' => $this->input->post('nip'),
				'email' => $this->input->post('email'),
				'no_telp' => $this->input->post('no_telp'),
				'id_jabatan' => $this->input->post('id_jabatan'),
				'id_pangkat_gol' => $this->input->post('id_pangkat_gol')
			];

			$password = $this->input->post('password');

			if (isset($password)) {
				$user['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			}

			$saved = $this->user_model->update($user);

			if ($saved) {
				$this->session->set_flashdata('message_success', 'Data berhasil disimpan.');
			}
		}

		$data['user'] = $this->user_model->find($id);

		$this->template->load('templates/admin_template', 'user/provinsi_ubah', $data);
	}

	public function hapus_provinsi($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('user_model');
		$this->user_model->delete($id);

		$this->session->set_flashdata('message_success', 'Data berhasil dihapus.');
		redirect('user/provinsi');
	}
}
