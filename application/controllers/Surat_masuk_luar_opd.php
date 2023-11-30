<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_masuk_luar_opd extends CI_Controller
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
		$this->load->model('surat_masuk_model');

		$status = $this->input->get('status', TRUE);

		$current_user = $this->auth_model->current_user();

		$data['current_user'] = $current_user;

		$data['list_surat_masuk'] = [];

		$data['list_surat_masuk'] = $this->surat_masuk_model->get_by_current_user_2();
		$data['status'] = $status;

		$this->template->load('templates/admin_template', 'surat_masuk/surat_masuk_luar_opd', $data);
	}

	public function new()
	{
		$this->load->model('user_model');
		$this->load->model('surat_masuk_penerima_model');
		$current_user = $this->auth_model->current_user();
		$list_penerima = $this->user_model->get_penerima_surat_masuk();
		$is_internal_opd = count($list_penerima) == 1 && $list_penerima[0]->id_opd == $current_user->id_opd;

		$data = null;
		$data['list_penerima'] = $list_penerima;
		$data['is_internal_opd'] = $is_internal_opd;
		$data['id_user_penerima'] = $is_internal_opd ? $list_penerima[0]->id : 0;
		$data['kembali'] = 'surat_masuk_luar_opd';

		if ($this->input->method() === 'post') {
			$this->load->model('surat_masuk_model');

			$current_user = $this->auth_model->current_user();
			$is_biro_umum = $current_user->level_jabatan == LEVEL_KABIRO && $current_user->id_jabatan == JABATAN_BIRO_UMUM;

			$surat = [
				'nomor_surat' => $this->input->post('nomor_surat'),
				'tanggal_surat' => $this->input->post('tanggal_surat'),
				'perihal' => $this->input->post('perihal'),
				'pengirim' => $this->input->post('pengirim'),
				'ringkasan' => $this->input->post('ringkasan'),
				'is_provinsi' => $is_biro_umum,
				'id_penerima' => $this->input->post('id_penerima'),
				'status' => MASUK_DRAFT,
			];

			$id = $this->surat_masuk_model->insert($surat);

			// insert tujuan surat masuk
			$article = [
				'surat_masuk_id'	=> $id,
				'penerima_id'		=> $this->input->post('id_penerima')
			];
			$this->surat_masuk_penerima_model->insert($article);

			if ($id) {
				$filename = uniqid('surat_masuk_' . ($is_biro_umum ? 'biro' : 'opd'));

				$config['upload_path'] = './uploaded/';
				$config['allowed_types'] = 'pdf';
				$config['file_name'] = $filename;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('file_surat')) {
					$data['errors'] = $this->upload->display_errors();
				} else {
					$surat_updated = ['id' => $id, 'doc' => $filename];
					$this->surat_masuk_model->update($surat_updated);
					$this->session->set_flashdata('message_success', 'Data berhasil disimpan.');

					redirect('surat_masuk_luar_opd/ubah/' . $id);
				}
			}
		}

		$this->template->load('templates/admin_template', 'surat_masuk/surat_masuk_new', $data);
	}

	public function detail($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('surat_masuk_model');
		$this->load->model('auth_model');
		$this->load->model('user_model');
		$this->load->model('surat_masuk_penerima_model');

		$data['surat_masuk'] = $this->surat_masuk_model->find($id);
		$data['current_user'] = $this->auth_model->current_user();;
		$data['list_tujuan'] = $this->user_model->get_tujuan_surat_masuk();
		$data['list_surat_id'] = $this->surat_masuk_penerima_model->get_by_surat($id);
		$data['kembali'] = 'surat_masuk_luar_opd';

		$this->template->load('templates/admin_template', 'surat_masuk/surat_masuk_detail', $data);
	}

	public function ubah($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('surat_masuk_model');
		$this->load->model('opd_model');
		$this->load->model('user_model');
		$this->load->model('auth_model');
		$this->load->model('surat_masuk_penerima_model');

		$current_user = $this->auth_model->current_user();
		$list_penerima = $this->user_model->get_penerima_surat_masuk();
		$is_internal_opd = count($list_penerima) == 1 && $list_penerima[0]->id_opd == $current_user->id_opd;

		$data['list_penerima'] = $list_penerima;
		$data['is_internal_opd'] = $is_internal_opd;
		$data['id_user_penerima'] = $is_internal_opd ? $list_penerima[0]->id : 0;
		$data['kembali'] = 'surat_masuk_luar_opd';

		if ($this->input->method() === 'post') {
			// TODO: Lakukan validasi sebelum menyimpan ke model


			$status = $this->input->post('draft') === null ? MASUK_FINAL : MASUK_DRAFT;


			$surat = [
				'id' => $id,
				'nomor_surat' => $this->input->post('nomor_surat'),
				'tanggal_surat' => $this->input->post('tanggal_surat'),
				'perihal' => $this->input->post('perihal'),
				'pengirim' => $this->input->post('pengirim'),
				'ringkasan' => $this->input->post('ringkasan'),
				'id_penerima' => $this->input->post('id_penerima'),
				'status' => $status,
			];

			$saved = $this->surat_masuk_model->update($surat);

			$article = [
				'surat_masuk_id'	=> $id,
				'penerima_id'		=> $this->input->post('id_penerima')
			];
			$this->surat_masuk_penerima_model->update_by_surat($article);

			if ($saved) {
				if (isset($_FILES['file_surat']) && is_uploaded_file($_FILES['file_surat']['tmp_name'])) {
					$surat_masuk = $this->surat_masuk_model->find($id);


					$config['upload_path'] = './uploaded/';
					$config['allowed_types'] = 'pdf';
					$config['file_name'] = $surat_masuk->doc;

					$this->load->library('upload', $config);

					if (!$this->upload->do_upload('file_surat')) {
						$data['errors'] = $this->upload->display_errors();
					}
				}

				$this->session->set_flashdata('message_success', 'Data berhasil disimpan.');
				redirect('surat_masuk/');
			}
		}

		$data['surat_masuk'] = $this->surat_masuk_model->find($id);

		$this->template->load('templates/admin_template', 'surat_masuk/surat_masuk_ubah', $data);
	}

	public function disposisi()
	{
		$id_surat_masuk = $this->input->post('id_surat_masuk');

		if (!$id_surat_masuk) {
			show_404();
		}

		$this->load->model('disposisi_surat_masuk_model');
		$this->load->model('surat_masuk_model');
		$this->load->model('user_model');
		$this->load->model('surat_masuk_penerima_model');

		$current_user = $this->auth_model->current_user();
		$id_tujuan = $this->input->post('id_tujuan');

		$disposisi_surat_masuk = [
			'id_surat_masuk' => $id_surat_masuk,
			'id_asal' => $current_user->id,
			'id_tujuan' => $id_tujuan[0],
			'catatan' => $this->input->post('catatan'),
		];

		$this->disposisi_surat_masuk_model->insert($disposisi_surat_masuk);

		// hapus id surat
		$this->surat_masuk_penerima_model->delete_by_surat($id_surat_masuk);

		// insert tujuan surat masuk
		for ($i = 0; $i < count($id_tujuan); $i++) {
			$article = [
				'surat_masuk_id'	=> $id_surat_masuk,
				'penerima_id'		=> $id_tujuan[$i]
			];
			$this->surat_masuk_penerima_model->insert($article);
		}

		$surat_masuk_updated = [
			'id' => $id_surat_masuk,
			'id_penerima' => $id_tujuan[0],
		];
		$saved = $this->surat_masuk_model->update($surat_masuk_updated);

		if ($saved) {
			$this->session->set_flashdata('message_success', 'Surat berhasil diteruskan.');
		}

		redirect('surat_masuk_luar_opd');
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
