<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Permohonan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('lampiran_model');
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

		$this->template->load('templates/admin_template', 'permohonan/permohonan_index', $data);
	}

	public function new()
	{
		if ($this->input->method() === 'post') {
			$this->load->model('permohonan_model');
			// TODO: Lakukan validasi sebelum menyimpan ke model

			$current_user = $this->auth_model->current_user();

			$permohonan = [
				'lampiran' => $this->input->post('lampiran'),
				'hal' => $this->input->post('hal'),
				'isi' => $this->input->post('isi'),
				'manfaat' => $this->input->post('manfaat'),
				'dari' => $this->input->post('dari'),
				'ke' => $this->input->post('ke'),
				'tanggal' => date('Y-m-d'),
				'tanggal_berangkat' => $this->input->post('tanggal_berangkat'),
				'tanggal_pulang' => $this->input->post('tanggal_pulang'),
				'maksud' => $this->input->post('maksud'),
				'pengikut' => $this->input->post('pengikut'),
				'keterangan' => $this->input->post('keterangan'),
				'status' => PERMOHONAN_DRAFT,
				'id_user' => $current_user->id
			];

			$id = $this->permohonan_model->insert($permohonan);

			// $filename = uniqid('lampiran_surat_permohonan_');

			// $config['upload_path'] = './lampiran/';
			// $config['allowed_types'] = 'pdf';
			// $config['file_name'] = $filename;

			// $this->load->library('upload', $config);


			// if (!$this->upload->do_upload('file_lampiran')) {
			// 	$err['errors'] = $this->upload->display_errors();
			// 	var_dump($err);
			// 	die;
			// } else {
			// 	$lampiran = ['surat_permohonan_id' => $id, 'dokumen' => $filename];
			// 	$this->lampiran_model->insert($lampiran);
			// }

			if ($id) {
				redirect('permohonan/ubah/' . $id);
			}
		}

		$this->template->load('templates/admin_template', 'permohonan/permohonan_new');
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
		$this->template->load('templates/admin_template', 'permohonan/permohonan_detail', $data);
	}

	public function ubah($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('permohonan_model');

		if ($this->input->method() === 'post') {
			// TODO: Lakukan validasi sebelum menyimpan ke model

			$current_user = $this->auth_model->current_user();

			$permohonan = [
				'id' => $id,
				'lampiran' => $this->input->post('lampiran'),
				'hal' => $this->input->post('hal'),
				'isi' => $this->input->post('isi'),
				'manfaat' => $this->input->post('manfaat'),
				'dari' => $this->input->post('dari'),
				'ke' => $this->input->post('ke'),
				'tanggal_berangkat' => $this->input->post('tanggal_berangkat'),
				'tanggal_pulang' => $this->input->post('tanggal_pulang'),
				'maksud' => $this->input->post('maksud'),
				'pengikut' => $this->input->post('pengikut'),
				'keterangan' => $this->input->post('keterangan'),
				'id_user' => $current_user->id
			];

			$isSent = false;
			if ($this->input->post('draft') === null && $current_user->level_jabatan == LEVEL_KASUBAG_KASIE) {
				$permohonan['status'] = PERMOHONAN_WAITING_APPROVAL_KABAG;
				$permohonan['revisi'] = NULL;
				$isSent = true;
			}

			$saved = $this->permohonan_model->update($permohonan);

			if ($saved) {
				$this->session->set_flashdata('message_success', 'Data berhasil disimpan.');
			}

			if ($isSent) {
				redirect('permohonan');
			}
		}

		$data['permohonan'] = $this->permohonan_model->find($id);

		$this->template->load('templates/admin_template', 'permohonan/permohonan_ubah', $data);
	}

	public function hapus($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('permohonan_model');
		$this->permohonan_model->delete($id);

		$this->session->set_flashdata('message_success', 'Data berhasil dihapus.');
		redirect('permohonan');
	}

	public function reject_surat()
	{
		$id = $this->input->post('id');
		$revisi = $this->input->post('revisi');

		if (!$id) {
			show_404();
		}

		$this->load->model('permohonan_model');
		$this->load->model('auth_model');

		$current_user = $this->auth_model->current_user();

		$status = PERMOHONAN_WAITING_APPROVAL_KABAG;
		if ($current_user->level_jabatan == LEVEL_KABAG_KABID) {
			$status = PERMOHONAN_DRAFT;
		}

		$permohonan = [
			'id' => $id,
			'status' => $status,
			'revisi' => $revisi,
		];

		$saved = $this->permohonan_model->update($permohonan);

		if ($saved) {
			$this->session->set_flashdata('message_success', 'Surat berhasil dikembalikan.');
		}

		redirect('permohonan');
	}

	public function approve_surat()
	{
		$id = $this->input->post('id');

		if (!$id) {
			show_404();
		}

		$this->load->model('permohonan_model');
		$this->load->model('auth_model');

		$current_user = $this->auth_model->current_user();

		$permohonan_update = [
			'id' => $id,
		];

		switch ($current_user->level_jabatan) {
			case LEVEL_KABAG_KABID:
				$permohonan_update['status'] = PERMOHONAN_WAITING_APPROVAL_SEKDIS;
				break;
			case LEVEL_SEKDIS:
				$permohonan_update['status'] = PERMOHONAN_WAITING_APPROVAL_KADIS;
				break;
			case LEVEL_KADIS:
				$permohonan_update['id_kadis'] = $current_user->id;
				$permohonan_update['status'] = PERMOHONAN_WAITING_NUMBER_TU;
				break;
			case LEVEL_SEKDA:
				$permohonan_update['status'] = PERMOHONAN_WAITING_NUMBER_BIRO;
				$permohonan_update['approved_by'] =  $current_user->id;
				break;
		}

		$saved = $this->permohonan_model->update($permohonan_update);

		if ($saved) {
			$this->session->set_flashdata('message_success', 'Surat berhasil diteruskan.');
		}

		redirect('permohonan');
	}

	public function number_surat()
	{
		$id = $this->input->post('id');

		if (!$id) {
			show_404();
		}

		$this->load->model('permohonan_model');
		$this->load->model('auth_model');

		$current_user = $this->auth_model->current_user();

		$permohonan_update = [
			'id' => $id,
		];

		switch ($current_user->level_jabatan) {
			case LEVEL_TU:
				$nomor_surat = $this->input->post('nomor_surat');
				$permohonan_update['status'] = PERMOHONAN_WAITING_APPROVAL_SEKDA;
				$permohonan_update['nomor_surat'] = $nomor_surat;
				break;
			// case JABATAN_BIRO_UMUM:
			// 	$nomor_surat_biro = $this->input->post('nomor_surat_biro');
			// 	$permohonan_update['status'] = PERMOHONAN_APPROVED;
			// 	$permohonan_update['nomor_surat_biro'] = $nomor_surat_biro;
			// 	break;
		}

		$saved = $this->permohonan_model->update($permohonan_update);

		if ($saved) {
			$this->session->set_flashdata('message_success', 'Surat berhasil diteruskan.');
		}

		redirect('permohonan');
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

	// private function qr($kodeqr)
	// {
	// 	if ($kodeqr) {
	// 		$filename = 'generated/nip_qr/' . $kodeqr;
	// 		if (!file_exists($filename)) {
	// 			$this->load->library('ciqrcode');
	// 			$params['data'] = $kodeqr;
	// 			$params['level'] = 'H';
	// 			$params['size'] = 10;
	// 			$params['savename'] = $_SERVER["DOCUMENT_ROOT"] . '/generated/nip_qr/' . $kodeqr . ".png";
	// 			return  $this->ciqrcode->generate($params);
	// 		}
	// 	}
	// }

	public function spt($id = null, $is_sppd = false)
	{
		$this->load->model('permohonan_model');
		$this->load->model('auth_model');
		$this->load->model('spt_model');

		$permohonan = $this->permohonan_model->find($id);
		$data['permohonan'] = $permohonan;
		$data['spt'] = $this->spt_model->find_by_permohonan($id);
		if (isset($data['spt']) && $data['spt']->status == SPT_FINAL) {
			if (boolval($is_sppd))
				redirect('generated/sppd/' . $data['spt']->doc_sppd);
			else
				redirect('generated/spt/' . $data['spt']->doc);
		}

		$status = SPT_DRAFT;

		if ($this->input->method() === 'post') {
			// // TODO: Lakukan validasi sebelum menyimpan ke model
			$current_user = $this->auth_model->current_user();

			if ($this->input->post('draft') === null) {
				$status = SPT_FINAL;
			}

			$spt = [
				'id_permohonan' => $permohonan->id,
				'nomor_spt' => $this->input->post('nomor_spt'),
				'untuk' => $this->input->post('untuk'),
				'tembusan' => $this->input->post('tembusan'),
				'status' => $status,
				'id_user' => $current_user->id
			];

			if ($status == SPT_FINAL) {
				$this->load->library('pdf');
				$this->load->model('user_model');
				$kadis = $this->user_model->find($permohonan->id_kadis);
				$sekda = $this->user_model->find_sekda();
				$gubernur = $this->user_model->find_gubernur();

				$html = $this->load->view('template-surat/spt-new', [], true);
				$html = str_replace("{{nomor_spt}}", $this->input->post('nomor_spt'), $html);
				$html = str_replace("{{nama_kadis}}", $kadis->nama, $html);
				$html = str_replace("{{nama_jabatan}}", $kadis->nama_jabatan, $html);
				$html = str_replace("{{untuk}}", $this->input->post('untuk'), $html);
				$html = str_replace("{{tanggal}}", $this->tgl_indo(date('Y-m-d')), $html);
				$html = str_replace("{{nama_gub}}", $gubernur->nama, $html);

				$this->load->library('ciqrcode');
				$params['data'] = $gubernur->nama;
				$params['level'] = 'H';
				$params['size'] = 2;
				$nip_qrcode = $this->ciqrcode->generate($params);
				$html = str_replace("{{qr_ttdgub}}", $nip_qrcode, $html);

				$output = $this->pdf->createPDF($html);
				$filename = uniqid('spt');
				file_put_contents('generated/spt/' . $filename, $output);
				$spt['doc'] = $filename;

				$permohonan_update = [
					'id' => $permohonan->id,
					'status' => PERMOHONAN_APPROVED
				];

				$saved = $this->permohonan_model->update($permohonan_update);

				$html_sppd = $this->load->view('template-surat/sppd', [], true);
				$html_sppd = str_replace("{{nomor_spt}}", $this->input->post('nomor_spt'), $html_sppd);
				$html_sppd = str_replace("{{nama_kadis}}", $kadis->nama, $html_sppd);
				$html_sppd = str_replace("{{pangkat_golongan}}", $kadis->pangkat . '/' . $kadis->golongan . $kadis->ruang, $html_sppd);
				$html_sppd = str_replace("{{nama_jabatan}}", $kadis->nama_jabatan, $html_sppd);
				$html_sppd = str_replace("{{maksud}}", $permohonan->maksud, $html_sppd);
				$html_sppd = str_replace("{{transportasi}}", $permohonan->transportasi, $html_sppd);
				$tanggal_berangkat = new DateTime($permohonan->tanggal_berangkat);
				$tanggal_pulang = new DateTime($permohonan->tanggal_pulang);
				$jumlah_hari = $tanggal_berangkat->diff($tanggal_pulang)->d;
				$html_sppd = str_replace("{{jumlah_hari}}", $jumlah_hari, $html_sppd);
				$html_sppd = str_replace("{{tanggal_berangkat}}", $permohonan->tanggal_berangkat, $html_sppd);
				$html_sppd = str_replace("{{tanggal_pulang}}", $permohonan->tanggal_pulang, $html_sppd);
				$html_sppd = str_replace("{{pengikut}}", $permohonan->pengikut, $html_sppd);
				$html_sppd = str_replace("{{nama_opd}}", $kadis->nama_opd, $html_sppd);
				$html_sppd = str_replace("{{tanggal_cetak}}", $this->tgl_indo(date('Y-m-d')), $html_sppd);
				$html_sppd = str_replace("{{nama_sekda}}", $sekda->nama, $html_sppd);
				$html_sppd = str_replace("{{pangkatgol_sekda}}", $sekda->pangkat . '/' . $sekda->golongan . $sekda->ruang, $html_sppd);
				$html_sppd = str_replace("{{nip_sekda}}", $sekda->nip, $html_sppd);
				$html_sppd = str_replace("{{keterangan}}", $permohonan->keterangan, $html_sppd);

				$this->load->library('ciqrcode');
				$params['data'] = $sekda->nip;
				$params['level'] = 'H';
				$params['size'] = 2;
				$nip_qrcode_sppd = $this->ciqrcode->generate($params);
				$html_sppd = str_replace("{{qr_ttdsekda}}", $nip_qrcode_sppd, $html_sppd);

				$output_sppd = $this->pdf->createPDF($html_sppd);
				$filename_sppd = uniqid('spt');
				file_put_contents('generated/sppd/' . $filename_sppd, $output_sppd);
				$spt['doc_sppd'] = $filename_sppd;
			}

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

		$data['spt'] = $this->spt_model->find_by_permohonan($id);

		if ($status === SPT_DRAFT) {
			$this->template->load('templates/admin_template', 'spt/index', $data);
		} else {
			redirect('permohonan');
		}
	}

	// public function sppd_new($id = null)
	// {
	// 	$this->load->model('permohonan_model');
	// 	$this->load->model('sppd_model');
	// 	$this->load->model('auth_model');

	// 	$data['spt'] = $this->spt_model->find_by_permohonan($id);
	// 	if ($data['spt']) {
	// 		redirect('permohonan/spt_ubah/' . $id);
	// 	}

	// 	if ($this->input->method() === 'post') {
	// 		$this->load->model('spt_model');
	// 		// TODO: Lakukan validasi sebelum menyimpan ke model

	// 		$current_user = $this->auth_model->current_user();

	// 		$spt = [
	// 			'nomor_spt' => $this->input->post('nomor_spt'),
	// 			'isi' => $this->input->post('isi'),
	// 			'tembusan' => $this->input->post('tembusan'),
	// 			'id_permohonan' => $id
	// 		];

	// 		$id = $this->spt_model->insert($spt);

	// 		if ($id) {
	// 			$this->spt_ubah($id);
	// 			return;
	// 		}
	// 	}

	// 	$data['permohonan'] = $this->permohonan_model->find($id);

	// 	$this->template->load('templates/admin_template', 'spt/spt_new', $data);
	// }

	// public function sppd_ubah($id = null)
	// {
	// 	$this->load->model('permohonan_model');
	// 	$this->load->model('auth_model');
	// 	$this->load->model('spt_model');

	// 	$status = SPT_DRAFT;

	// 	if ($this->input->method() === 'post') {
	// 		// // TODO: Lakukan validasi sebelum menyimpan ke model
	// 		$data['spt'] = $this->spt_model->find_by_permohonan($id);

	// 		$current_user = $this->auth_model->current_user();

	// 		if ($this->input->post('draft') === null) {
	// 			$status = SPT_FINAL;
	// 		}

	// 		$spt = [
	// 			'id' => $data['spt']->id,
	// 			'nomor_spt' => $this->input->post('nomor_spt'),
	// 			'isi' => $this->input->post('isi'),
	// 			'tembusan' => $this->input->post('tembusan'),
	// 			'status' => $status,
	// 			'id_user' => $current_user->id
	// 		];

	// 		$saved = $this->spt_model->update($spt);

	// 		if ($saved) {
	// 			$this->session->set_flashdata('message_success', 'Data berhasil disimpan.');
	// 		}
	// 	}

	// 	$data['permohonan'] = $this->permohonan_model->find($id);
	// 	$data['spt'] = $this->spt_model->find_by_permohonan($id);

	// 	if ($status === SPT_DRAFT) {
	// 		$this->template->load('templates/admin_template', 'spt/spt_ubah', $data);
	// 	} else {
	// 		redirect('permohonan');
	// 	}
	// }

	public function download($file_name)
	{
		$surat_biasa = $this->surat_biasa_model->find_by_doc($file_name);
		$lampiran = $this->lampiran_model->find_by_surat_permohonan($surat_biasa->id);

		if ($lampiran) {
			$zip = new ZipArchive;
			$fileZipName = 'surat_zip/' . $surat_biasa->doc . '.zip';
			if (file_exists($fileZipName)) {
				unlink($fileZipName);
			}
			if ($zip->open($fileZipName, ZipArchive::CREATE) == false) {
				die('gagal mendownload surat.');
			}
			$zip->addFile('generated/surat_biasa/' . $surat_biasa->doc, $surat_biasa->doc . '.pdf');
			$zip->addFile('lampiran/' . $lampiran->dokumen . '.pdf', $lampiran->dokumen . '.pdf');
			$zip->close();
			force_download($fileZipName, null);
		} else {
			$dir = "generated/surat_biasa/";
			$file_name_surat = $surat_biasa->doc;
			$file_path = $dir . $file_name_surat;

			$ctype = "application/octet-stream";
			if (!empty($file_path) && file_exists($file_path)) { /*check keberadaan file*/
				header("Pragma:public");
				header("Expired:0");
				header("Cache-Control:must-revalidate");
				header("Content-Control:public");
				header("Content-Description: File Transfer");
				header("Content-Type: $ctype");
				header("Content-Disposition:attachment; filename=\"" . $file_name_surat . ".pdf" . "");
				header("Content-Transfer-Encoding:binary");
				header("Content-Length:" . filesize($file_path));
				flush();
				readfile($file_path);
				exit();
			} else {
				echo "The File does not exist.";
			}
		}
	}
}
