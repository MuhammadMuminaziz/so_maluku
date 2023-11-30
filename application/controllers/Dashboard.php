<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('surat_masuk_model');
		$this->load->model('permohonan_model');
		$this->load->model('surat_biasa_model');
		$current_user = $this->auth_model->current_user();
		if (!$current_user) {
			redirect('auth/login');
		}
	}

	public function index()
	{
		$status = $this->input->get('status', TRUE);
		$current_user = $this->auth_model->current_user();
		$data = [
			'surat_opd' => count($this->surat_masuk_model->get_by_current_user_1()),
			'surat_luar_opd' => count($this->surat_masuk_model->get_by_current_user_2()),
			'surat_permohonan' => count($this->permohonan_model->find_by_status($status)),
			'surat_biasa' => count($this->surat_biasa_model->find_by_status($status)),
			'user' => $current_user
		];
		$this->template->load('templates/admin_template', 'dashboard', $data);
	}

	public function permohonan()
	{
		$this->template->load('templates/admin_template', 'permohonan');
	}
}
