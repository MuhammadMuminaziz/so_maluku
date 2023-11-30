<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	const SESSION_KEY = 'user_id';

	public function index()
	{
		// show_404();
		// $this->session->set_flashdata('message_login_error', 'Login Gagal, pastikan username dan password benar.');
		// $this->load->view('login');
		if ($this->session->has_userdata(self::SESSION_KEY)) {
			redirect('dashboard');
		}

		$this->login();
	}

	public function login()
	{
		$this->load->model('auth_model');
		$this->load->library('form_validation');

		$rules = $this->auth_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == FALSE) {
			return $this->load->view('login');
		}

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if ($this->auth_model->login($username, $password)) {
			redirect('dashboard');
		} else {
			$this->session->set_flashdata('message_login_error', 'Login Gagal, pastikan username dan password benar.');
		}

		$this->load->view('login');
	}

	public function logout()
	{
		$this->load->model('auth_model');
		$this->auth_model->logout();
		redirect(site_url());
	}
}
