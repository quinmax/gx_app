<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diary extends CI_Controller {

	public function list_()
	{
		/**
		 * Dev: $response = '{"status":"OK","data":[{"uid":1,"entity_uid":1,"treating_doctor_uid":1,"service_center_uid":9684,"booking_type_uid":1,"name":"GP_1","uuid":"43259e56-fa40-47f0-b0b7-ee0d6e434dd8","disabled":false}]}';
		 */
		$data = array();
		
		$response = "";
		$response = get_diaries('session_id="\"109cca73-4090-40f6-ac1f-45d9104fc512\"_applicant_001"');

		$json = json_decode($response);
		$records = $json->data;
		
		$data['records'] = $records;

		// Entity is not provided on login so the entity name is being hard coded
		$data['entity_name'] = 'Entity ID: 1';

		$data['topbar'] = 'diary/topbar';
		$data['main_content'] = 'diary/index';

		$this->load->view('includes/template' , $data);
	}
}
