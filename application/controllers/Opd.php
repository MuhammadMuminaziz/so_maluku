<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Opd extends CI_Controller
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
		$this->load->model('opd_model');

		$status = $this->input->get('status', TRUE);

		$current_user = $this->auth_model->current_user();

		$data['current_user'] = $current_user;

		$data['list_opd'] = $this->opd_model->get();
		$data['status'] = $status;

		$this->template->load('templates/admin_template', 'opd/opd_index', $data);
	}

	public function new()
	{
		if ($this->input->method() === 'post') {
			$this->load->model('opd_model');
			// TODO: Lakukan validasi sebelum menyimpan ke model

			$current_user = $this->auth_model->current_user();

			$opd = [
				'nama_opd' => $this->input->post('nama_opd')
			];

			$id = $this->opd_model->insert($opd);

			if ($id) {
				$this->session->set_flashdata('message_success', 'Data berhasil disimpan.');
				redirect('opd/ubah/' . $id);
			}
		}

		$this->template->load('templates/admin_template', 'opd/opd_new');
	}

	public function detail($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('opd_model');
		$this->load->model('auth_model');

		$data['permohonan'] = $this->opd_model->find($id);
		$data['current_user'] = $this->auth_model->current_user();;
		$this->template->load('templates/admin_template', 'dinas/dinas_detail', $data);
	}

	public function ubah($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('opd_model');

		if ($this->input->method() === 'post') {
			// TODO: Lakukan validasi sebelum menyimpan ke model

			$opd = [
				'id' => $id,
				'nama_opd' => $this->input->post('nama_opd')
			];
			// var_dump($opd);die;

			$saved = $this->opd_model->update($opd);

			if ($saved) {
				$this->session->set_flashdata('message_success', 'Data berhasil disimpan.');
			}
		}

		$data['opd'] = $this->opd_model->find($id);

		$this->template->load('templates/admin_template', 'opd/opd_ubah', $data);
	}

	public function ubah_for_opt()
	{
		$this->load->model('auth_model');
		$this->load->model('user_model');
		$this->load->model('opd_model');

		$current_user = $this->auth_model->current_user();
		$data['opd'] = $this->opd_model->find($current_user->id_opd);

		if ($this->input->method() === 'post') {
			$opd = [
				'id' => $current_user->id_opd,
				'nama_opd' => $this->input->post('nama_opd'),
				'alamat_opd' => $this->input->post('alamat_opd'),
				'alamat_elektronik_opd' => $this->input->post('alamat_elektronik_opd'),
			];

			$saved = $this->opd_model->update($opd);

			if ($saved) {
				$this->session->set_flashdata('message_success', 'Data berhasil disimpan.');
			}
		}

		$data['opd'] = $this->opd_model->find($current_user->id_opd);

		$this->template->load('templates/admin_template', 'opd/for_opt_ubah', $data);
	}

	public function hapus($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('opd_model');
		$this->opd_model->delete($id);

		$this->session->set_flashdata('message_success', 'Data berhasil dihapus.');
		redirect('opd');
	}
}
