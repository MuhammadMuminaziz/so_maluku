<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan extends CI_Controller
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
		$this->load->model('jabatan_model');

		// $status = $this->input->get('status', TRUE);

		$current_user = $this->auth_model->current_user();

		$data['current_user'] = $current_user;

		$data['list_jabatan'] = $this->jabatan_model->get();

		$this->template->load('templates/admin_template', 'jabatan/jabatan_index', $data);
	}

	public function new()
	{
		$this->load->model('level_jabatan_model');
		$this->load->model('opd_model');
		$data['list_level_jabatan'] = $this->level_jabatan_model->get();
		$data['list_opd'] = $this->opd_model->get();
		$current_user = $this->auth_model->current_user();

		$data['current_user'] = $current_user;

		if ($this->input->method() === 'post') {
			$this->load->model('jabatan_model');
			// TODO: Lakukan validasi sebelum menyimpan ke model

			$jabatan = [
				'nama_jabatan' => $this->input->post('nama_jabatan'),
				'id_level_jabatan' => $this->input->post('id_level_jabatan'),
				'id_opd' => $this->input->post('id_opd')
			];

			$id = $this->jabatan_model->insert($jabatan);

			if ($id) {
				$this->session->set_flashdata('message_success', 'Data berhasil disimpan.');
				redirect('jabatan/ubah/' . $id);
			}
		}

		$this->template->load('templates/admin_template', 'jabatan/jabatan_new', $data);
	}

	public function detail($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('jabatan_model');
		$this->load->model('auth_model');

		$data['permohonan'] = $this->jabatan_model->find($id);
		$data['current_user'] = $this->auth_model->current_user();;
		$this->template->load('templates/admin_template', 'dinas/dinas_detail', $data);
	}

	public function ubah($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('jabatan_model');
		$this->load->model('level_jabatan_model');
		$this->load->model('opd_model');
		$data['list_level_jabatan'] = $this->level_jabatan_model->get();
		$data['list_opd'] = $this->opd_model->get();
		$current_user = $this->auth_model->current_user();

		$data['current_user'] = $current_user;

		if ($this->input->method() === 'post') {
			// TODO: Lakukan validasi sebelum menyimpan ke model

			$jabatan = [
				'id' => $id,
				'nama_jabatan' => $this->input->post('nama_jabatan'),
				'id_level_jabatan' => $this->input->post('id_level_jabatan'),
				'id_opd' => $this->input->post('id_opd')
			];

			$saved = $this->jabatan_model->update($jabatan);

			if ($saved) {
				$this->session->set_flashdata('message_success', 'Data berhasil disimpan.');
			}
		}

		$data['jabatan'] = $this->jabatan_model->find($id);

		$this->template->load('templates/admin_template', 'jabatan/jabatan_ubah', $data);
	}

	public function hapus($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('jabatan_model');
		$this->jabatan_model->delete($id);

		$this->session->set_flashdata('message_success', 'Data berhasil dihapus.');
		redirect('jabatan');
	}
}
