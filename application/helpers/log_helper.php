<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('decorate_create')) {
	function decorate_create($item)
	{
		$CI = &get_instance();
		$CI->load->model('auth_model');

		$current_user = $CI->auth_model->current_user();
		$current_date = date('Y-m-d');

		$item['created_by'] = $current_user->id;
		$item['created_date'] = $current_date;
		$item['updated_by'] = $current_user->id;
		$item['updated_date'] = $current_date;

		return $item;
	}
}

if (!function_exists('decorate_update')) {
	function decorate_update($item)
	{
		$CI = &get_instance();
		$CI->load->model('auth_model');

		$current_user = $CI->auth_model->current_user();
		$current_date = date('Y-m-d');

		$item['updated_by'] = $current_user->id;
		$item['updated_date'] = $current_date;

		return $item;
	}
}
