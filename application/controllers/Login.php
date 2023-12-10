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
		// Receive data from ajax call
		$ajax_data = file_get_contents("php://input");
        $json_data = json_decode($ajax_data);

		// Retrieve data
		$cred_1 = $json_data->cred_1;
		$cred_2 = $json_data->cred_2;

		// Prevent unwanted input
		$san_cred_1 = filter_var($cred_1, FILTER_SANITIZE_STRING);
		$san_cred_2 = filter_var($cred_2, FILTER_SANITIZE_STRING);

		// Attempt login
		$response = login($san_cred_1, $san_cred_2);

		// Set the default booking filter date
		$today = date("Y-m-d");
		$this->session->set_userdata('booking_filter_date', $today);

		// Return api response
		echo $response;
	}
}
