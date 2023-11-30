<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_Pemberitahuan extends CI_Controller
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
		$this->load->model('surat_pemberitahuan_model');

		$status = $this->input->get('status', TRUE);

		$current_user = $this->auth_model->current_user();

		$data['current_user'] = $current_user;

		$data['list_surat_pemberitahuan'] = [];

		$data['list_surat_pemberitahuan'] = $this->surat_pemberitahuan_model->find_by_status($status);
		$data['status'] = $status;

		$this->template->load('templates/admin_template', 'surat_pemberitahuan/surat_pemberitahuan_index', $data);
	}

	public function new()
	{
		$this->load->model('opd_model');
		$data['list_opd'] = $this->opd_model->get();

		if ($this->input->method() === 'post') {
			$this->load->model('surat_pemberitahuan_model');
			$this->load->model('surat_pemberitahuan__opd_model');
			// TODO: Lakukan validasi sebelum menyimpan ke model

			$current_user = $this->auth_model->current_user();

			$surat = [
				'nomor_surat' => $this->input->post('nomor_surat'),
				'tanggal_surat' => $this->input->post('tanggal_surat'),
				'lampiran' => $this->input->post('lampiran'),
				'perihal' => $this->input->post('perihal'),
				'isi_surat' => $this->input->post('isi_surat'),
				'list_tembusan' => $this->input->post('list_tembusan'),
				'status' => UNDANGAN_DRAFT,
				'id_user' => $current_user->id
			];

			$id = $this->surat_pemberitahuan_model->insert($surat);
			$this->surat_pemberitahuan__opd_model->update($id, $this->input->post('opdTujuan'));

			if ($id) {
				redirect('surat_pemberitahuan/ubah/' . $id);
			}
		}

		$this->template->load('templates/admin_template', 'surat_pemberitahuan/surat_pemberitahuan_new', $data);
	}

	public function detail($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('surat_pemberitahuan_model');
		$this->load->model('auth_model');

		$data['surat_pemberitahuan'] = $this->surat_pemberitahuan_model->find($id);
		$data['current_user'] = $this->auth_model->current_user();;
		$this->template->load('templates/admin_template', 'surat_pemberitahuan/surat_pemberitahuan_detail', $data);
	}

	public function ubah($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('surat_pemberitahuan_model');
		$this->load->model('surat_pemberitahuan__opd_model');
		$this->load->model('opd_model');
		$data['list_opd'] = $this->opd_model->get();

		$status = UNDANGAN_DRAFT;

		if ($this->input->method() === 'post') {
			// TODO: Lakukan validasi sebelum menyimpan ke model

			$current_user = $this->auth_model->current_user();

			if ($this->input->post('draft') === null) {
				$status = UNDANGAN_WAITING_APPROVAL_BIRO;
			}

			$surat = [
				'id' => $id,
				'nomor_surat' => $this->input->post('nomor_surat'),
				'tanggal_surat' => $this->input->post('tanggal_surat'),
				'lampiran' => $this->input->post('lampiran'),
				'perihal' => $this->input->post('perihal'),
				'isi_surat' => $this->input->post('isi_surat'),
				'list_tembusan' => $this->input->post('list_tembusan'),
				'status' => $status,
				'id_user' => $current_user->id
			];

			$saved = $this->surat_pemberitahuan_model->update($surat);
			$this->surat_pemberitahuan__opd_model->update($id, $this->input->post('opdTujuan'));

			if ($saved) {
				$this->session->set_flashdata('message_success', 'Data berhasil disimpan.');
			}
		}

		$data['surat_pemberitahuan'] = $this->surat_pemberitahuan_model->find($id);

		if ($status === UNDANGAN_DRAFT) {
			$this->template->load('templates/admin_template', 'surat_pemberitahuan/surat_pemberitahuan_ubah', $data);
		} else {
			redirect('surat_pemberitahuan');
		}
	}

	public function hapus($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('surat_pemberitahuan_model');
		$this->surat_pemberitahuan_model->delete($id);

		$this->session->set_flashdata('message_success', 'Data berhasil dihapus.');
		redirect('surat_pemberitahuan');
	}

	public function approve_biro()
	{
		$id = $this->input->post('id');

		if (!$id) {
			show_404();
		}

		$this->load->model('surat_pemberitahuan_model');

		$surat_pemberitahuan = [
			'id' => $id,
			'status' => UNDANGAN_WAITING_APPROVAL_SEKDA,
		];

		$saved = $this->surat_pemberitahuan_model->update($surat_pemberitahuan);

		if ($saved) {
			$this->session->set_flashdata('message_success', 'Surat berhasil diteruskan.');
		}

		redirect('surat_pemberitahuan');
	}

	public function approve_sekda()
	{
		$id = $this->input->post('id');

		if (!$id) {
			show_404();
		}

		$this->load->model('surat_pemberitahuan_model');
		$this->load->model('opd_model');
		$this->load->model('auth_model');
		$this->load->model('user_model');

		$current_user = $this->auth_model->current_user();
		$surat_pemberitahuan = $this->surat_pemberitahuan_model->find($id);

		$surat_pemberitahuan = [
			'id' => $id,
			'status' => PEMBERITAHUAN_WAITING_NUMBER_BIRO,
			'approved_by' => $current_user->id,
		];

		$saved = $this->surat_pemberitahuan_model->update($surat_pemberitahuan);

		if ($saved) {
			$this->session->set_flashdata('message_success', 'Surat berhasil diteruskan.');
		}

		redirect('surat_pemberitahuan');
	}

	public function number_biro()
	{
		$id = $this->input->post('id');
		$nomor_surat_biro = $this->input->post('nomor_surat_biro');

		if (!$id) {
			show_404();
		}

		$this->load->model('surat_pemberitahuan_model');
		$this->load->model('opd_model');
		$this->load->model('auth_model');
		$this->load->model('user_model');

		$current_user = $this->auth_model->current_user();
		$approver = $this->user_model->find($current_user->id);
		$surat_pemberitahuan = $this->surat_pemberitahuan_model->find($id);

		$this->load->library('pdf');
		$html = $this->load->view('template-surat/surat-pemberitahuan', [], true);

		$list_opd = $this->opd_model->find_list(array_column($surat_pemberitahuan->list_id_opd, 'id_opd'));
		$list_nama_opd = implode('<br/>', array_column($list_opd, 'nama_opd'));
		$html = str_replace("{{nama_opd}}", $list_nama_opd, $html);
		$html = str_replace("{{nomor_surat}}", $nomor_surat_biro, $html);
		$html = str_replace("{{tanggal_surat}}", $this->tgl_indo($surat_pemberitahuan->tanggal_surat), $html);
		$html = str_replace("{{lampiran}}", $surat_pemberitahuan->lampiran, $html);
		$html = str_replace("{{perihal}}", $surat_pemberitahuan->perihal, $html);
		$html = str_replace("{{isi_surat}}", $surat_pemberitahuan->isi_surat, $html);
		$html = str_replace("{{nama_sekda}}", $approver->nama, $html);
		$html = str_replace("{{pangkat_gol}}", $approver->pangkat, $html);
		$html = str_replace("{{nip_sekda}}", $approver->nip, $html);
		$html = str_replace("{{list_tembusan}}", $surat_pemberitahuan->list_tembusan, $html);

		$this->load->library('ciqrcode');
		$params['data'] = $approver->nip;
		$params['level'] = 'H';
		$params['size'] = 2;
		$nip_qrcode = $this->ciqrcode->generate($params);
		$html = str_replace("{{nip_qrcode}}", $nip_qrcode, $html);

		$output = $this->pdf->createPDF($html);
		$filename = uniqid('surat_pemberitahuan');
		file_put_contents('generated/surat_pemberitahuan/' . $filename, $output);

		$surat_pemberitahuan = [
			'id' => $id,
			'status' => PEMBERITAHUAN_APPROVED,
			'nomor_surat_biro' => $nomor_surat_biro,
			'doc' => $filename
		];

		$saved = $this->surat_pemberitahuan_model->update($surat_pemberitahuan);

		if ($saved) {
			$this->session->set_flashdata('message_success', 'Surat berhasil diteruskan.');
		}

		redirect('surat_pemberitahuan');
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
