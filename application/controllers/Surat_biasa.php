<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_Biasa extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('surat_biasa_model');
		if (!$this->auth_model->current_user()) {
			redirect('auth/login');
		}
	}

	public function index()
	{
		$status = $this->input->get('status', TRUE);

		$current_user = $this->auth_model->current_user();

		$data['current_user'] = $current_user;

		$data['list_surat_biasa'] = [];

		$data['list_surat_biasa'] = $this->surat_biasa_model->find_by_status($status);
		$data['status'] = $status;

		$this->template->load('templates/admin_template', 'surat_biasa/surat_biasa_index', $data);
	}

	public function detail($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('surat_biasa_model');
		$this->load->model('auth_model');

		$data['surat_biasa'] = $this->surat_biasa_model->find($id);
		$data['current_user'] = $this->auth_model->current_user();
		$data['level_surat'] = '';
		if ($data['surat_biasa']->status == 'WAITING_APPROVAL_SEKDA') {
			$data['level_surat'] = '3';
		}
		if ($data['surat_biasa']->status == 'WAITING_APPROVAL_ASISTEN') {
			$data['level_surat'] = '5';
		}
		if ($data['surat_biasa']->status == 'WAITING_APPROVAL_KADIS') {
			$data['level_surat'] = '8';
		}
		if ($data['surat_biasa']->status == 'WAITING_APPROVAL_KABAG') {
			$data['level_surat'] = '9';
		}
		if ($data['surat_biasa']->status == 'WAITING_APPROVAL_SEKDIS') {
			$data['level_surat'] = '13';
		}

		$this->template->load('templates/admin_template', 'surat_biasa/surat_biasa_detail', $data);
	}

	public function new()
	{
		$this->load->model('opd_model');
		$this->load->model('user_model');
		$this->load->model('lampiran_model');

		$data['list_opd'] = $this->opd_model->list_opd();
		$data['list_kabag'] = $this->user_model->get_kabag();
		$data['list_asekda'] = $this->user_model->get_asekda();

		if ($this->input->method() === 'post') {
			$this->load->model('surat_biasa_model');
			$this->load->model('surat_biasa__opd_model');
			// TODO: Lakukan validasi sebelum menyimpan ke model

			$current_user = $this->auth_model->current_user();
			$is_langsung = $this->input->post('is_langsung');



			$surat = [
				'nama_surat' => $this->input->post('nama_surat'),
				'nomor_surat' => $this->input->post('nomor_surat'),
				'tanggal_surat' => $this->input->post('tanggal_surat'),
				'lampiran' => $this->input->post('lampiran'),
				'perihal' => $this->input->post('perihal'),
				'isi_surat' => $this->input->post('isi_surat'),
				'list_tembusan' => $this->input->post('list_tembusan'),
				'status' => BIASA_DRAFT,
				'id_user' => $current_user->id,
				'id_kabag' => $this->input->post('id_kabag'),
				'is_langsung' => $is_langsung
			];

			$filename = uniqid('lampiran_surat_biasa_');

			$config['upload_path'] = './lampiran/';
			$config['allowed_types'] = 'pdf';
			$config['file_name'] = $filename;

			$this->load->library('upload', $config);


			if (!$this->upload->do_upload('file_lampiran')) {
				$err['errors'] = $this->upload->display_errors();
			} else {
				$surat['doc_lampiran'] = $filename;
			}

			if (!$is_langsung) {
				$surat['id_asisten'] = $this->input->post('id_asisten');
			}

			$id = $this->surat_biasa_model->insert($surat);

			$list_opdTujuan = $this->input->post('opdTujuan');
			$is_send_to_all = count($list_opdTujuan) == 1 && $list_opdTujuan[0] == "all";
			if (!$is_send_to_all) {
				$this->surat_biasa__opd_model->update($id, $list_opdTujuan);
			}

			if ($id) {
				redirect('surat_biasa/ubah/' . $id);
			}
		}

		$this->template->load('templates/admin_template', 'surat_biasa/surat_biasa_new', $data);
	}

	public function ubah($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('surat_biasa_model');
		$this->load->model('surat_biasa__opd_model');
		$this->load->model('opd_model');
		$this->load->model('user_model');
		$this->load->model('auth_model');
		$data['list_opd'] = $this->opd_model->get();
		$data['list_kabag'] = $this->user_model->get_kabag();
		$data['list_asekda'] = $this->user_model->get_asekda();
		$data['current_user'] = $this->auth_model->current_user();

		if ($this->input->method() === 'post') {
			// TODO: Lakukan validasi sebelum menyimpan ke model

			$current_user = $this->auth_model->current_user();
			$is_langsung = $this->input->post('is_langsung');

			$surat = [
				'id' => $id,
				'nama_surat' => $this->input->post('nama_surat'),
				'nomor_surat' => $this->input->post('nomor_surat'),
				'tanggal_surat' => $this->input->post('tanggal_surat'),
				'lampiran' => $this->input->post('lampiran'),
				'perihal' => $this->input->post('perihal'),
				'isi_surat' => $this->input->post('isi_surat'),
				'list_tembusan' => $this->input->post('list_tembusan'),
				'id_asisten' => $this->input->post('id_asisten'),
				'id_kabag' => $this->input->post('id_kabag'),
				'is_langsung' => $is_langsung
			];

			$filename = uniqid('lampiran_surat_biasa_');
			$surat_biasa = $this->surat_biasa_model->find_by_id($id);

			$config['upload_path'] = './lampiran/';
			$config['allowed_types'] = 'pdf';
			$config['file_name'] = $filename;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('file_lampiran')) {
				$err['errors'] = $this->upload->display_errors();
				$surat['doc_lampiran'] = $surat_biasa->doc_lampiran;
			} else {
				$surat['doc_lampiran'] = $filename;
				unlink('./lampiran/' . $surat_biasa->doc_lampiran);
			}

			if ($is_langsung) {
				$surat['id_asisten'] = NULL;
			}

			$isSent = false;
			if ($this->input->post('draft') === null && $current_user->level_jabatan == LEVEL_KASUBAG_KASIE) {
				$surat['status'] = BIASA_WAITING_APPROVAL_KABAG;
				$surat['revisi'] = NULL;
				$isSent = true;
			}

			$saved = $this->surat_biasa_model->update($surat);
			$list_opdTujuan = $this->input->post('opdTujuan');
			$is_send_to_all = count($list_opdTujuan) == 1 && $list_opdTujuan[0] == "all";
			if ($is_send_to_all) {
				$this->surat_biasa__opd_model->delete($id);
			} else {
				$this->surat_biasa__opd_model->update($id, $list_opdTujuan);
			}

			if ($saved) {
				$this->session->set_flashdata('message_success', 'Data berhasil disimpan.');
			}

			if ($isSent) {
				redirect('surat_biasa/');
			}
		}

		$data['surat_biasa'] = $this->surat_biasa_model->find($id);

		$this->template->load('templates/admin_template', 'surat_biasa/surat_biasa_ubah', $data);
	}

	public function hapus($id = null)
	{
		if (!$id) {
			show_404();
		}

		$this->load->model('surat_biasa_model');
		$this->surat_biasa_model->delete($id);

		$this->session->set_flashdata('message_success', 'Data berhasil dihapus.');
		redirect('surat_biasa');
	}

	public function reject_surat()
	{
		$id = $this->input->post('id');
		$revisi = $this->input->post('revisi');

		if (!$id) {
			show_404();
		}

		$this->load->model('surat_biasa_model');
		$this->load->model('auth_model');

		$current_user = $this->auth_model->current_user();

		$status = BIASA_WAITING_APPROVAL_KABAG;
		if ($current_user->level_jabatan == LEVEL_KABAG_KABID) {
			$status = BIASA_DRAFT;
		}

		$surat_biasa = [
			'id' => $id,
			'status' => $status,
			'revisi' => $revisi,
		];

		$saved = $this->surat_biasa_model->update($surat_biasa);

		if ($saved) {
			$this->session->set_flashdata('message_success', 'Surat berhasil dikembalikan.');
		}

		redirect('surat_biasa');
	}

	public function approve_surat()
	{
		$id = $this->input->post('id');

		if (!$id) {
			show_404();
		}

		$this->load->model('surat_biasa_model');
		$this->load->model('auth_model');

		$current_user = $this->auth_model->current_user();

		$surat_biasa = $this->surat_biasa_model->find($id);
		$surat_biasa_update = [
			'id' => $id,
		];

		switch ($current_user->level_jabatan) {
			case LEVEL_KABAG_KABID:
				$surat_biasa_update['status'] = BIASA_WAITING_APPROVAL_SEKDIS;
				break;
			case LEVEL_SEKDIS:
				$surat_biasa_update['status'] = BIASA_WAITING_APPROVAL_KADIS;
				break;
			case LEVEL_KADIS:
				$surat_biasa_update['id_kadis'] = $current_user->id;
				if ($surat_biasa->is_langsung) {
					$surat_biasa_update['status'] = BIASA_WAITING_NUMBER_TU;
					$surat_biasa_update['approved_by'] =  $current_user->id;
				} else {
					$surat_biasa_update['status'] = BIASA_WAITING_APPROVAL_ASISTEN;
				}
				break;
			case LEVEL_ASISTEN:
				$surat_biasa_update['status'] = BIASA_WAITING_APPROVAL_SEKDA;
				break;
			case LEVEL_SEKDA:
				$surat_biasa_update['status'] = BIASA_WAITING_NUMBER_BIRO;
				$surat_biasa_update['approved_by'] =  $current_user->id;
				break;
		}

		$saved = $this->surat_biasa_model->update($surat_biasa_update);

		if ($saved) {
			$this->session->set_flashdata('message_success', 'Surat berhasil diteruskan.');
		}

		redirect('surat_biasa');
	}

	public function number_surat()
	{
		$id = $this->input->post('id');

		if (!$id) {
			show_404();
		}

		$this->load->model('surat_biasa_model');
		$this->load->model('opd_model');
		$this->load->model('auth_model');
		$this->load->model('user_model');
		$this->load->model('surat_masuk_penerima_model');

		$current_user = $this->auth_model->current_user();
		$surat_biasa = $this->surat_biasa_model->find($id);
		$is_langsung = $surat_biasa->is_langsung;
		$origin_user = $this->user_model->find($surat_biasa->id_user);
		// 		var_dump($origin_user);die;
		$origin_opd = $this->opd_model->find($origin_user->id_opd);
		$approver = $this->user_model->find($surat_biasa->approved_by);
		$kabag = $this->user_model->find($surat_biasa->id_kabag);
		$kadis = $this->user_model->find($surat_biasa->id_kadis);
		$asisten = $this->user_model->find($surat_biasa->id_asisten);

		$is_send_to_all = count($surat_biasa->list_id_opd) == 0;
		$data['is_send_to_all'] = $is_send_to_all;

		$list_nama_opd = '';
		$list_all_opd = '';
		if ($is_send_to_all) {
			// set lampiran of All OPD
			$list_nama_opd = 'Pimpinan OPD di Lingkup Provinsi Maluku (terlampir)';
			$list_opd = $this->opd_model->list_opd();
			$list_all_opd = '-' . implode('<br/>- ', array_column($list_opd, 'nama_opd'));
		} else {
			$list_opd = $this->opd_model->find_list(array_column($surat_biasa->list_id_opd, 'id_opd'));
			$list_nama_opd = 'Kepala' . implode('<br/>', array_column($list_opd, 'nama_opd'));
		}

		// var_dump($list_opd);die;

		// generate main PDF
		$this->load->library('pdf');

		$nomor_surat = '';
		$html = '';
		if ($is_langsung) {
			$nomor_surat = $this->input->post('nomor_surat');
			$html = $this->load->view('template-surat/surat-biasa-opd', $data, true);
		} else {
			$nomor_surat = $this->input->post('nomor_surat_biro');
			$html = $this->load->view('template-surat/surat-biasa', $data, true);
		}

		$html = str_replace("{{nama_opd}}", $list_nama_opd, $html);
		$html = str_replace("{{nama_surat}}", $surat_biasa->nama_surat, $html);
		$html = str_replace("{{nomor_surat}}", $nomor_surat, $html);
		$html = str_replace("{{tanggal_surat}}", $this->tgl_indo($surat_biasa->tanggal_surat), $html);
		$html = str_replace("{{lampiran}}", $surat_biasa->lampiran, $html);
		$html = str_replace("{{perihal}}", $surat_biasa->perihal, $html);
		$html = str_replace("{{isi_surat}}", $surat_biasa->isi_surat, $html);
		$html = str_replace("{{nama_opd_approver}}", $approver->nama_opd, $html);
		$html = str_replace("{{alamat_opd_approver}}", $approver->alamat_opd, $html);
		$html = str_replace("{{alamat_elektronik_opd_approver}}", $approver->alamat_elektronik_opd, $html);
		$html = str_replace("{{nama_jabatan}}", $approver->nama_jabatan, $html);
		$html = str_replace("{{nama_sekda}}", $approver->nama, $html);
		$html = str_replace("{{pangkat_sekda}}", $approver->pangkat, $html);
		$html = str_replace("{{nip_sekda}}", $approver->nip, $html);
		$html = str_replace("{{list_tembusan}}", $surat_biasa->list_tembusan, $html);
		$html = str_replace("{{list_all_opd}}", $list_all_opd, $html);

		$this->load->library('ciqrcode');
		$params['data'] = $approver->nip;
		$params['level'] = 'H';
		$params['size'] = 2;
		$nip_qrcode = $this->ciqrcode->generate($params);
		$html = str_replace("{{nip_qrcode}}", $nip_qrcode, $html);

		$params['data'] = $kabag->nip;
		$params['level'] = 'H';
		$params['size'] = 2;
		$nip_qrcode = $this->ciqrcode->generate($params);
		$html = str_replace("{{nama_jab_kabag}}", $kabag->nama_jabatan, $html);
		$html = str_replace("{{kabag_qrcode}}", $nip_qrcode, $html);

		$params['data'] = $kadis->nip;
		$params['level'] = 'H';
		$params['size'] = 2;
		$nip_qrcode = $this->ciqrcode->generate($params);
		$html = str_replace("{{nama_jab_kadis}}", $kadis->nama_jabatan, $html);
		$html = str_replace("{{kadis_qrcode}}", $nip_qrcode, $html);

		if (!$is_langsung) {
			$params['data'] = $asisten->nip;
			$params['level'] = 'H';
			$params['size'] = 2;
			$nip_qrcode = $this->ciqrcode->generate($params);
			$html = str_replace("{{nama_jab_asisten}}", $asisten->nama_jabatan, $html);
			$html = str_replace("{{asisten_qrcode}}", $nip_qrcode, $html);
		}

		$output = $this->pdf->createPDF($html);
		$filename = uniqid('surat_biasa');
		file_put_contents('generated/surat_biasa/' . $filename, $output);

		$this->load->model('surat_masuk_model');

		foreach ($list_opd as $opd) {
			$kadis_penerima = $this->user_model->find_kadis_opd($opd->id);

			$surat_masuk = [
				'nomor_surat' => $nomor_surat,
				'tanggal_surat' => $surat_biasa->tanggal_surat,
				'perihal' => $surat_biasa->perihal,
				'pengirim' => $origin_opd->nama_opd,
				'ringkasan' => '',
				'doc' => $filename,
				'is_provinsi' => FALSE,
				'id_penerima' => $kadis_penerima->id,
				'id_surat_keluar' => $id,
				'status' => MASUK_FINAL,
				'doc_lampiran' => $surat_biasa->doc_lampiran
			];

			$id_surat_masuk = $this->surat_masuk_model->insert($surat_masuk);

			$article = [
				'surat_masuk_id'	=> $id_surat_masuk,
				'penerima_id'		=> $kadis_penerima->id
			];
			$this->surat_masuk_penerima_model->insert($article);
		}

		// udpdate DB
		$surat_biasa = [
			'id' => $id,
			'status' => BIASA_APPROVED,
			'doc' => $filename
		];

		if ($is_langsung) {
			$surat_biasa['nomor_surat'] = $nomor_surat;
		} else {
			$surat_biasa['nomor_surat_biro'] = $nomor_surat;
		}

		$saved = $this->surat_biasa_model->update($surat_biasa);

		if ($saved) {
			$this->session->set_flashdata('message_success', 'Surat berhasil diteruskan.');
		}

		redirect('surat_biasa');
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

	// public function download($file_name)
	// {
	// 	$surat_biasa = $this->surat_biasa_model->find_by_doc($file_name);
	// 	$lampiran = $this->lampiran_model->find_by_surat_biasa($surat_biasa->id);

	// 	if($lampiran){
	// 		$zip = new ZipArchive;
	// 		$fileZipName = 'surat_zip/' . $surat_biasa->doc . '.zip';
	// 		if(file_exists($fileZipName)){
	// 			unlink($fileZipName);
	// 		}
	// 		if($zip->open($fileZipName, ZipArchive::CREATE) == false){
	// 			die('gagal mendownload surat.');
	// 		}
	// 		$zip->addFile('generated/surat_biasa/' . $surat_biasa->doc, $surat_biasa->doc . '.pdf');
	// 		$zip->addFile('lampiran/' . $lampiran->dokumen . '.pdf', $lampiran->dokumen . '.pdf');
	// 		$zip->close();
	// 		force_download($fileZipName, null);
	// 	}else{
	// 		$dir = "generated/surat_biasa/";
	// 		$file_name_surat = $surat_biasa->doc;
	// 		$file_path = $dir.$file_name_surat;

	// 		$ctype = "application/octet-stream";
	// 		if(!empty($file_path) && file_exists($file_path)){ /*check keberadaan file*/
	// 			header("Pragma:public");
	// 			header("Expired:0");
	// 			header("Cache-Control:must-revalidate");
	// 			header("Content-Control:public");
	// 			header("Content-Description: File Transfer");
	// 			header("Content-Type: $ctype");
	// 			header("Content-Disposition:attachment; filename=\"".$file_name_surat.".pdf"."");
	// 			header("Content-Transfer-Encoding:binary");
	// 			header("Content-Length:".filesize($file_path));
	// 			flush();
	// 			readfile($file_path);
	// 			exit();
	// 		}else{
	// 			echo "The File does not exist.";
	// 		}
	// 	}
	// }
}
