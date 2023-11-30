<?php

class Template
{

	var $template_data = array();

	function set($name, $value)
	{
		$this->template_data[$name] = $value;
	}

	function load($template = '', $view = '', $view_data = array(), $return = FALSE)
	{
		$this->CI = &get_instance();
		$this->CI->load->model('auth_model');
		// $this->set('sidebar', $this->CI->load->view('templates/sidebar', $view_data, TRUE));
		$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));
		$this->set('current_user', $this->CI->auth_model->current_user());

		if (is_file(APPPATH . 'views/' . $view . '_scripts.php')) {
			$this->set('scripts', $this->CI->load->view($view . '_scripts', $view_data, TRUE));
		}

		return $this->CI->load->view($template, $this->template_data, $return);
	}
}
