<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_Biasa_Masuk extends CI_Controller
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
		$this->load->model('surat_biasa_model');

		$status = $this->input->get('status', TRUE);

		$current_user = $this->auth_model->current_user();

		$data['current_user'] = $current_user;

		$data['list_surat_biasa'] = [];

		$data['list_surat_biasa'] = $this->surat_biasa_model->get_by_current_user();
		$data['status'] = $status;

		$this->template->load('templates/admin_template', 'surat_biasa_masuk/surat_biasa_masuk_index', $data);
	}

	public function detail($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('surat_biasa_model');
		$this->load->model('auth_model');

		$data['surat_biasa'] = $this->surat_biasa_model->find($id);
		$data['current_user'] = $this->auth_model->current_user();;
		$this->template->load('templates/admin_template', 'surat_biasa_masuk/surat_biasa_masuk_detail', $data);
	}

	public function approve_biro()
	{
		$id = $this->input->post('id');

		if (!$id) {
			show_404();
		}

		$this->load->model('surat_undangan_model');

		$surat_undangan = [
			'id' => $id,
			'status' => UNDANGAN_WAITING_APPROVAL_SEKDA,
		];

		$saved = $this->surat_undangan_model->update($surat_undangan);

		if ($saved) {
			$this->session->set_flashdata('message_success', 'Surat berhasil diteruskan.');
		}

		redirect('surat_undangan');
	}

	private function tgl_indo($tanggal)
	{
		$bulan = array(
			1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$pecahkan = explode('-', $tanggal);

		return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
	}
}
