<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$data = array();

		$data['main_content'] = 'login/index';

		$this->load->view('includes/template' , $data);
	}

	public function do_login()
	{
		$ajax_data = file_get_contents("php://input");
        $json_data = json_decode($ajax_data);

		$cred_1 = $json_data->cred_1;
		$cred_2 = $json_data->cred_2;

		$san_cred_1 = filter_var($cred_1, FILTER_SANITIZE_STRING);
		$san_cred_2 = filter_var($cred_2, FILTER_SANITIZE_STRING);

		$response = login($san_cred_1, $san_cred_2);

		echo $response;
	}
}
