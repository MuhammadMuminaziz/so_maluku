<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_Undangan extends CI_Controller
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
		$this->load->model('surat_undangan_model');

		$status = $this->input->get('status', TRUE);

		$current_user = $this->auth_model->current_user();

		$data['current_user'] = $current_user;

		$data['list_surat_undangan'] = [];

		$data['list_surat_undangan'] = $this->surat_undangan_model->find_by_status($status);
		$data['status'] = $status;

		$this->template->load('templates/admin_template', 'surat_undangan/surat_undangan_index', $data);
	}

	public function new()
	{
		$this->load->model('opd_model');
		$this->load->model('jabatan_model');
		$data['list_opd'] = $this->opd_model->get();
		$data['list_asisten'] = $this->jabatan_model->get_list_asisten();

		if ($this->input->method() === 'post') {
			$this->load->model('surat_undangan_model');
			$this->load->model('surat_undangan__opd_model');
			// TODO: Lakukan validasi sebelum menyimpan ke model

			$current_user = $this->auth_model->current_user();

			$surat = [
				'nomor_surat' => $this->input->post('nomor_surat'),
				'tanggal_surat' => $this->input->post('tanggal_surat'),
				'lampiran' => $this->input->post('lampiran'),
				'perihal' => $this->input->post('perihal'),
				'isi_pendahuluan' => $this->input->post('isi_pendahuluan'),
				'isi_penutup' => $this->input->post('isi_penutup'),
				'hari_tanggal' => $this->input->post('hari_tanggal'),
				'waktu_kegiatan' => $this->input->post('waktu_kegiatan'),
				'lokasi_kegiatan' => $this->input->post('lokasi_kegiatan'),
				'list_tembusan' => $this->input->post('list_tembusan'),
				'status' => UNDANGAN_DRAFT,
				'asisten_koor' => $this->input->post('asisten_koor'),
				'id_user' => $current_user->id
			];

			$id = $this->surat_undangan_model->insert($surat);
			$this->surat_undangan__opd_model->update($id, $this->input->post('opdTujuan'));

			if ($id) {
				redirect('surat_undangan/ubah/' . $id);
			}
		}

		$this->template->load('templates/admin_template', 'surat_undangan/surat_undangan_new', $data);
	}

	public function detail($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('surat_undangan_model');
		$this->load->model('auth_model');

		$data['surat_undangan'] = $this->surat_undangan_model->find($id);
		$data['current_user'] = $this->auth_model->current_user();;
		$this->template->load('templates/admin_template', 'surat_undangan/surat_undangan_detail', $data);
	}

	public function ubah($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('surat_undangan_model');
		$this->load->model('surat_undangan__opd_model');
		$this->load->model('opd_model');
		$this->load->model('jabatan_model');
		$data['list_opd'] = $this->opd_model->get();
		$data['list_asisten'] = $this->jabatan_model->get_list_asisten();

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
				'isi_pendahuluan' => $this->input->post('isi_pendahuluan'),
				'isi_penutup' => $this->input->post('isi_penutup'),
				'hari_tanggal' => $this->input->post('hari_tanggal'),
				'waktu_kegiatan' => $this->input->post('waktu_kegiatan'),
				'lokasi_kegiatan' => $this->input->post('lokasi_kegiatan'),
				'list_tembusan' => $this->input->post('list_tembusan'),
				'status' => $status,
				'id_user' => $current_user->id
			];

			$saved = $this->surat_undangan_model->update($surat);
			$this->surat_undangan__opd_model->update($id, $this->input->post('opdTujuan'));

			if ($saved) {
				$this->session->set_flashdata('message_success', 'Data berhasil disimpan.');
			}
		}

		$data['surat_undangan'] = $this->surat_undangan_model->find($id);

		if ($status === UNDANGAN_DRAFT) {
			$this->template->load('templates/admin_template', 'surat_undangan/surat_undangan_ubah', $data);
		} else {
			redirect('surat_undangan');
		}
	}

	public function hapus($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('surat_undangan_model');
		$this->surat_undangan_model->delete($id);

		$this->session->set_flashdata('message_success', 'Data berhasil dihapus.');
		redirect('surat_undangan');
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

	public function approve_sekda()
	{
		$id = $this->input->post('id');

		if (!$id) {
			show_404();
		}

		$this->load->model('surat_undangan_model');
		$this->load->model('auth_model');

		$current_user = $this->auth_model->current_user();
		$surat_undangan = $this->surat_undangan_model->find($id);

		$surat_undangan = [
			'id' => $id,
			'status' => UNDANGAN_WAITING_NUMBER_BIRO,
			'approved_by' => $current_user->id,
		];

		$saved = $this->surat_undangan_model->update($surat_undangan);

		if ($saved) {
			$this->session->set_flashdata('message_success', 'Surat berhasil diteruskan.');
		}

		redirect('surat_undangan');
	}

	public function number_biro()
	{
		$id = $this->input->post('id');
		$nomor_surat_biro = $this->input->post('nomor_surat_biro');

		if (!$id) {
			show_404();
		}

		$this->load->model('surat_undangan_model');
		$this->load->model('opd_model');
		$this->load->model('auth_model');
		$this->load->model('user_model');
		$this->load->model('jabatan_model');

		$current_user = $this->auth_model->current_user();
		$approver = $this->user_model->find($current_user->id);
		$surat_undangan = $this->surat_undangan_model->find($id);
		$asisten = $this->user_model->find($surat_undangan->asisten_koor);

		$this->load->library('pdf');
		$html = $this->load->view('template-surat/surat-undangan', [], true);

		$list_opd = $this->opd_model->find_list(array_column($surat_undangan->list_id_opd, 'id_opd'));
		$list_nama_opd = implode('<br/>', array_column($list_opd, 'nama_opd'));
		$html = str_replace("{{nama_opd}}", $list_nama_opd, $html);
		$html = str_replace("{{nomor_surat}}", $nomor_surat_biro, $html);
		$html = str_replace("{{tanggal_surat}}", $this->tgl_indo($surat_undangan->tanggal_surat), $html);
		$html = str_replace("{{lampiran}}", $surat_undangan->lampiran, $html);
		$html = str_replace("{{perihal}}", $surat_undangan->perihal, $html);
		$html = str_replace("{{isi_pendahuluan}}", $surat_undangan->isi_pendahuluan, $html);
		$html = str_replace("{{hari_tanggal}}", $surat_undangan->hari_tanggal, $html);
		$html = str_replace("{{waktu_kegiatan}}", $surat_undangan->waktu_kegiatan, $html);
		$html = str_replace("{{lokasi_kegiatan}}", $surat_undangan->lokasi_kegiatan, $html);
		$html = str_replace("{{isi_penutup}}", $surat_undangan->isi_penutup, $html);
		$html = str_replace("{{jabatan_asisten}}", $asisten->nama_jabatan, $html);
		$html = str_replace("{{nama_sekda}}", $approver->nama, $html);
		$html = str_replace("{{pangkat_gol}}", $approver->pangkat, $html);
		$html = str_replace("{{nip_sekda}}", $approver->nip, $html);
		$html = str_replace("{{list_tembusan}}", $surat_undangan->list_tembusan, $html);

		$this->load->library('ciqrcode');
		$params['data'] = $approver->nip;
		$params['level'] = 'H';
		$params['size'] = 2;
		$nip_qrcode = $this->ciqrcode->generate($params);
		$html = str_replace("{{nip_qrcode}}", $nip_qrcode, $html);

		$params['data'] = $asisten->nip;
		$params['level'] = 'H';
		$params['size'] = 2;
		$nip_qrcode_asisten = $this->ciqrcode->generate($params);
		$html = str_replace("{{nip_qrcode_asisten}}", $nip_qrcode_asisten, $html);

		$output = $this->pdf->createPDF($html);
		$filename = uniqid('surat_undangan');
		file_put_contents('generated/surat_undangan/' . $filename, $output);

		$surat_undangan = [
			'id' => $id,
			'status' => UNDANGAN_APPROVED,
			'nomor_surat_biro' => $nomor_surat_biro,
			'doc' => $filename
		];

		$saved = $this->surat_undangan_model->update($surat_undangan);

		if ($saved) {
			$this->session->set_flashdata('message_success', 'Surat berhasil disimpan.');
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
