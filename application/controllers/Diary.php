<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diary extends CI_Controller {

	public function list_()
	{
		$data = array();

		// Fetch diaries: API/Curl
		$response = "";
		$response = get_diaries();

		$json = json_decode($response);
		$records = $json->data;
		
		// Set view data
		$data['records'] = $records;

		// Entity is not provided on login so the entity name is being hard coded
		$data['entity_name'] = 'Entity ID: 1';

		$data['topbar'] = 'diary/topbar';
		$data['main_content'] = 'diary/index';

		// Load view
		$this->load->view('includes/template' , $data);
	}
}
