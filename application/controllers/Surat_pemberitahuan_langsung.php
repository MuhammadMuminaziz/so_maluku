<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_Pemberitahuan_Langsung extends CI_Controller
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
		$this->load->model('surat_pemberitahuan_langsung_model');

		$status = $this->input->get('status', TRUE);

		$current_user = $this->auth_model->current_user();

		$data['current_user'] = $current_user;

		$data['list_surat_pemberitahuan'] = [];

		$data['list_surat_pemberitahuan'] = $this->surat_pemberitahuan_langsung_model->find_by_status($status);
		$data['status'] = $status;

		$this->template->load('templates/admin_template', 'surat_pemberitahuan_langsung/surat_pemberitahuan_langsung_index', $data);
	}

	public function new()
	{
		$this->load->model('opd_model');
		$data['list_opd'] = $this->opd_model->get();

		if ($this->input->method() === 'post') {
			$this->load->model('surat_pemberitahuan_langsung_model');
			$this->load->model('surat_pemberitahuan_langsung__opd_model');
			// TODO: Lakukan validasi sebelum menyimpan ke model

			$current_user = $this->auth_model->current_user();

			$surat = [
				'nomor_surat' => $this->input->post('nomor_surat'),
				'tanggal_surat' => $this->input->post('tanggal_surat'),
				'lampiran' => $this->input->post('lampiran'),
				'perihal' => $this->input->post('perihal'),
				'isi_surat' => $this->input->post('isi_surat'),
				'list_tembusan' => $this->input->post('list_tembusan'),
				'status' => PEMBERITAHUAN_LANGSUNG_DRAFT,
				'id_user' => $current_user->id
			];

			$id = $this->surat_pemberitahuan_langsung_model->insert($surat);
			$this->surat_pemberitahuan_langsung__opd_model->update($id, $this->input->post('opdTujuan'));

			if ($id) {
				redirect('surat_pemberitahuan_langsung/ubah/' . $id);
			}
		}

		$this->template->load('templates/admin_template', 'surat_pemberitahuan_langsung/surat_pemberitahuan_langsung_new', $data);
	}

	public function detail($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('surat_pemberitahuan_langsung_model');
		$this->load->model('auth_model');

		$data['surat_pemberitahuan_langsung'] = $this->surat_pemberitahuan_langsung_model->find($id);
		$data['current_user'] = $this->auth_model->current_user();
		$this->template->load('templates/admin_template', 'surat_pemberitahuan_langsung/surat_pemberitahuan_langsung_detail', $data);
	}

	public function ubah($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('surat_pemberitahuan_langsung_model');
		$this->load->model('surat_pemberitahuan_langsung__opd_model');
		$this->load->model('opd_model');
		$this->load->model('auth_model');
		$data['list_opd'] = $this->opd_model->get();
		$data['current_user'] = $this->auth_model->current_user();

		$status = PEMBERITAHUAN_LANGSUNG_DRAFT;

		if ($this->input->method() === 'post') {
			// TODO: Lakukan validasi sebelum menyimpan ke model

			$current_user = $this->auth_model->current_user();

			if ($this->input->post('draft') === null) {
				if ($current_user->level_jabatan == LEVEL_KADIS) {
					$this->approve_kadis($id);
					return;
				} else {
					$status =  PEMBERITAHUAN_LANGSUNG_WAITING_APPROVAL_KADIS;
				}
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

			$saved = $this->surat_pemberitahuan_langsung_model->update($surat);
			$this->surat_pemberitahuan_langsung__opd_model->update($id, $this->input->post('opdTujuan'));

			if ($saved) {
				$this->session->set_flashdata('message_success', 'Data berhasil disimpan.');
			}
		}

		$data['surat_pemberitahuan_langsung'] = $this->surat_pemberitahuan_langsung_model->find($id);

		if ($status === PEMBERITAHUAN_LANGSUNG_DRAFT) {
			$this->template->load('templates/admin_template', 'surat_pemberitahuan_langsung/surat_pemberitahuan_langsung_ubah', $data);
		} else {
			redirect('surat_pemberitahuan_langsung');
		}
	}

	public function hapus($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('surat_pemberitahuan_langsung_model');
		$this->surat_pemberitahuan_langsung_model->delete($id);

		$this->session->set_flashdata('message_success', 'Data berhasil dihapus.');
		redirect('surat_pemberitahuan_langsung');
	}

	public function approve_kadis($id_surat)
	{
		$id = $this->input->post('id');

		if (!$id && !isset($id_surat)) {
			show_404();
		} else if (!$id && isset($id_surat)) {
			$id = $id_surat;
		}

		$this->load->model('surat_pemberitahuan_langsung_model');
		$this->load->model('opd_model');
		$this->load->model('auth_model');
		$this->load->model('user_model');

		$current_user = $this->auth_model->current_user();
		$approver = $this->user_model->find($current_user->id);
		$surat_pemberitahuan_langsung = $this->surat_pemberitahuan_langsung_model->find($id);

		$this->load->library('pdf');
		$html = $this->load->view('template-surat/surat-pemberitahuan-langsung', [], true);

		$list_opd = $this->opd_model->find_list(array_column($surat_pemberitahuan_langsung->list_id_opd, 'id_opd'));
		$list_nama_opd = implode('<br/>', array_column($list_opd, 'nama_opd'));
		$html = str_replace("{{nama_opd}}", $list_nama_opd, $html);
		$html = str_replace("{{nomor_surat}}", $surat_pemberitahuan_langsung->nomor_surat, $html);
		$html = str_replace("{{tanggal_surat}}", $this->tgl_indo($surat_pemberitahuan_langsung->tanggal_surat), $html);
		$html = str_replace("{{lampiran}}", $surat_pemberitahuan_langsung->lampiran, $html);
		$html = str_replace("{{perihal}}", $surat_pemberitahuan_langsung->perihal, $html);
		$html = str_replace("{{isi_surat}}", $surat_pemberitahuan_langsung->isi_surat, $html);
		$html = str_replace("{{nama_sekda}}", $approver->nama, $html);
		$html = str_replace("{{pangkat_gol}}", $approver->pangkat, $html);
		$html = str_replace("{{nip_sekda}}", $approver->nip, $html);
		$html = str_replace("{{list_tembusan}}", $surat_pemberitahuan_langsung->list_tembusan, $html);

		$this->load->library('ciqrcode');
		$params['data'] = $approver->nip;
		$params['level'] = 'H';
		$params['size'] = 2;
		$nip_qrcode = $this->ciqrcode->generate($params);
		$html = str_replace("{{nip_qrcode}}", $nip_qrcode, $html);

		$output = $this->pdf->createPDF($html);
		$filename = uniqid('surat_pemberitahuan_langsung');
		file_put_contents('generated/surat_pemberitahuan_langsung/' . $filename, $output);

		$surat_pemberitahuan_langsung = [
			'id' => $id,
			'status' => PEMBERITAHUAN_LANGSUNG_APPROVED,
			'approved_by' => $current_user->id,
			'doc' => $filename
		];

		$saved = $this->surat_pemberitahuan_langsung_model->update($surat_pemberitahuan_langsung);

		if ($saved) {
			$this->session->set_flashdata('message_success', 'Surat berhasil diteruskan.');
		}

		redirect('surat_pemberitahuan_langsung');
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
