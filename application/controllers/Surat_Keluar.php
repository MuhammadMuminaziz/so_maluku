<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_Keluar extends CI_Controller
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
		$this->load->model('permohonan_model');

		$status = $this->input->get('status', TRUE);

		$current_user = $this->auth_model->current_user();

		$data['current_user'] = $current_user;

		$data['list_permohonan'] = [];

		$data['list_permohonan'] = $this->permohonan_model->find_by_status($status);
		$data['status'] = $status;

		$this->template->load('templates/admin_template', 'surat_keluar/surat_keluar_index', $data);
	}

	public function new()
	{
		if ($this->input->method() === 'post') {
			$this->load->model('permohonan_model');
			// TODO: Lakukan validasi sebelum menyimpan ke model

			$current_user = $this->auth_model->current_user();

			$permohonan = [
				// 'id' => $id,
				'nomor' => $this->input->post('nomor'),
				'lampiran' => $this->input->post('lampiran'),
				'hal' => $this->input->post('hal'),
				'tanggal' => $this->input->post('tanggal'),
				'tempat' => $this->input->post('tempat'),
				'isi' => $this->input->post('isi'),
				'manfaat' => $this->input->post('manfaat'),
				'id_user' => $current_user->id
			];

			$id = $this->permohonan_model->insert($permohonan);

			if ($id) {
				$this->ubah($id);
				return;
			}
		}

		$this->template->load('templates/admin_template', 'surat_keluar/surat_keluar_new');
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
		$this->template->load('templates/admin_template', 'surat_keluar/surat_keluar_detail', $data);
	}

	public function ubah($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('permohonan_model');

		$status = PERMOHONAN_DRAFT;

		if ($this->input->method() === 'post') {
			// TODO: Lakukan validasi sebelum menyimpan ke model

			$current_user = $this->auth_model->current_user();

			if ($this->input->post('draft') === null) {
				$status = PERMOHONAN_WAITING_APPROVAL_BIRO;
			}

			$permohonan = [
				'id' => $id,
				'nomor' => $this->input->post('nomor'),
				'lampiran' => $this->input->post('lampiran'),
				'hal' => $this->input->post('hal'),
				'tanggal' => $this->input->post('tanggal'),
				'tempat' => $this->input->post('tempat'),
				'isi' => $this->input->post('isi'),
				'manfaat' => $this->input->post('manfaat'),
				'status' => $status,
				'id_user' => $current_user->id
			];

			$saved = $this->permohonan_model->update($permohonan);

			if ($saved) {
				$this->session->set_flashdata('message_success', 'Data berhasil disimpan.');
			}
		}

		$data['permohonan'] = $this->permohonan_model->find($id);

		if ($status === PERMOHONAN_DRAFT) {
			$this->template->load('templates/admin_template', 'surat_keluar/surat_keluar_ubah', $data);
		} else {
			redirect('surat_keluar');
		}
	}

	public function hapus($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('permohonan_model');
		$this->permohonan_model->delete($id);

		$this->session->set_flashdata('message_success', 'Data berhasil dihapus.');
		redirect('surat_keluar');
	}

	public function approve_biro()
	{
		$id = $this->input->post('id');

		if (!$id) {
			show_404();
		}

		$this->load->model('permohonan_model');

		$permohonan = [
			'id' => $id,
			'status' => PERMOHONAN_WAITING_APPROVAL_SEKDA,
		];

		$saved = $this->permohonan_model->update($permohonan);

		if ($saved) {
			$this->session->set_flashdata('message_success', 'Surat berhasil diteruskan.');
		}

		redirect('surat_keluar');
	}

	public function approve_sekda()
	{
		$id = $this->input->post('id');

		if (!$id) {
			show_404();
		}

		$this->load->model('permohonan_model');


		$status = PERMOHONAN_APPROVED;
		if (!$this->input->post('approve')) {
			$status = PERMOHONAN_REJECTED;
		}

		$permohonan = [
			'id' => $id,
			'status' => $status,
		];

		if ($status == PERMOHONAN_APPROVED) {
			$current_user = $this->auth_model->current_user();
			$permohonan['approved_by'] = $current_user->id;
		}

		$saved = $this->permohonan_model->update($permohonan);

		if ($saved) {
			$message = $status == PERMOHONAN_REJECTED ? 'Surat berhasil ditolak.' : 'Surat berhasil diteruskan.';
			$this->session->set_flashdata('message_success', $message);
		}

		redirect('surat_keluar');
	}

	public function spt($id = null)
	{
		$this->load->model('permohonan_model');
		$this->load->model('auth_model');
		$this->load->model('spt_model');

		$data['spt'] = $this->spt_model->find_by_permohonan($id);
		if (isset($data['spt']) && $data['spt']->status == SPT_FINAL) {
			$this->load->view('spt/spt_download', $data);
			return;
		}

		$status = SPT_DRAFT;

		if ($this->input->method() === 'post') {
			// // TODO: Lakukan validasi sebelum menyimpan ke model
			$current_user = $this->auth_model->current_user();

			if ($this->input->post('draft') === null) {
				$status = SPT_FINAL;
			}

			$spt = [
				'nomor_spt' => $this->input->post('nomor_spt'),
				'isi' => $this->input->post('isi'),
				'tembusan' => $this->input->post('tembusan'),
				'status' => $status,
				'id_user' => $current_user->id
			];

			if ($data['spt']) {
				$spt['id'] = $data['spt']->id;
				$saved = $this->spt_model->update($spt);
			} else {
				$saved = $this->spt_model->insert($spt);
			}

			if ($saved) {
				$this->session->set_flashdata('message_success', 'Data berhasil disimpan.');
			}
		}

		$data['permohonan'] = $this->permohonan_model->find($id);
		$data['spt'] = $this->spt_model->find_by_permohonan($id);

		if ($status === SPT_DRAFT) {
			$this->template->load('templates/admin_template', 'spt/index', $data);
		} else {
			redirect('permohonan');
		}
	}

	public function sppd_new($id = null)
	{
		$this->load->model('permohonan_model');
		$this->load->model('sppd_model');
		$this->load->model('auth_model');

		$data['spt'] = $this->spt_model->find_by_permohonan($id);
		if ($data['spt']) {
			redirect('permohonan/spt_ubah/' . $id);
		}

		if ($this->input->method() === 'post') {
			$this->load->model('spt_model');
			// TODO: Lakukan validasi sebelum menyimpan ke model

			$current_user = $this->auth_model->current_user();

			$spt = [
				'nomor_spt' => $this->input->post('nomor_spt'),
				'isi' => $this->input->post('isi'),
				'tembusan' => $this->input->post('tembusan'),
				'id_permohonan' => $id
			];

			$id = $this->spt_model->insert($spt);

			if ($id) {
				$this->spt_ubah($id);
				return;
			}
		}

		$data['permohonan'] = $this->permohonan_model->find($id);

		$this->template->load('templates/admin_template', 'spt/spt_new', $data);
	}

	public function sppd_ubah($id = null)
	{
		$this->load->model('permohonan_model');
		$this->load->model('auth_model');
		$this->load->model('spt_model');

		$status = SPT_DRAFT;

		if ($this->input->method() === 'post') {
			// // TODO: Lakukan validasi sebelum menyimpan ke model
			$data['spt'] = $this->spt_model->find_by_permohonan($id);

			$current_user = $this->auth_model->current_user();

			if ($this->input->post('draft') === null) {
				$status = SPT_FINAL;
			}

			$spt = [
				'id' => $data['spt']->id,
				'nomor_spt' => $this->input->post('nomor_spt'),
				'isi' => $this->input->post('isi'),
				'tembusan' => $this->input->post('tembusan'),
				'status' => $status,
				'id_user' => $current_user->id
			];

			$saved = $this->spt_model->update($spt);

			if ($saved) {
				$this->session->set_flashdata('message_success', 'Data berhasil disimpan.');
			}
		}

		$data['permohonan'] = $this->permohonan_model->find($id);
		$data['spt'] = $this->spt_model->find_by_permohonan($id);

		if ($status === SPT_DRAFT) {
			$this->template->load('templates/admin_template', 'spt/spt_ubah', $data);
		} else {
			redirect('permohonan');
		}
	}
}
