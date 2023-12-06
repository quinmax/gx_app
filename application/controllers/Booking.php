<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller 
{

	public function list_()
	{
		/**
		 * Dev: $response = get_bookings('session_id="\"109cca73-4090-40f6-ac1f-45d9104fc512\"_applicant_001"');
		 */
		$data = array();

		// Bookings
		$data['records'] = $this->api_get_bookings();

		// Booking status [id, name]
		$data['booking_status'] = $this->api_get_booking_status(-1, -1);

		// Fetch and process booking types from api
		$data['booking_types'] = $this->api_get_booking_types();

		// Entity is not provided on login so the entity name is being hard coded
		$data['entity_name'] = 'Entity ID: 1';

		// Set page view items
		$data['topbar'] = 'booking/topbar';
		$data['main_content'] = 'booking/index';

		$this->load->view('includes/template' , $data);
	}

	public function view()
	{
		$data = array();

		$this->load->view('booking/view' , $data);
	}

	public function view_debtor_general()
	{
		$data = array();

		$this->load->view('booking/view_info/debtor_general' , $data);
	}

	public function view_debtor_patients()
	{
		$data = array();

		$this->load->view('booking/view_info/debtor_patients' , $data);
	}

	public function view_debtor_doctor_history()
	{
		$data = array();

		$this->load->view('booking/view_info/debtor_doctor_history' , $data);
	}

	public function view_debtor_patient_history()
	{
		$data = array();

		$this->load->view('booking/view_info/debtor_patient_history' , $data);
	}

	public function view_patient_general()
	{
		$data = array();

		$this->load->view('booking/view_info/patient_general' , $data);
	}

	public function add()
	{
		$data = array();

		// Fetch patient data
		$records = $this->api_get_patients();
		$arr_patient_list = array('0' => 'Please select...');

		foreach ($records as $row)
		{
			$id = $row->uid;
			$debtor_uid = $row->debtor_uid;
			$title = $row->title;
			$initials = $row->initials;
			$name = $row->name;
			$surname = $row->surname;
			$debtor_uid = $row->debtor_uid;

			$index = $id . '@@' . $debtor_uid;

			$arr_patient_list[$index] = $title . ' ' . $initials . ' ' . $name . ' ' . $surname;
		}
		
		$data['patients'] = $records;
		$data['patient_list'] = $arr_patient_list;

		// Get a list of debtors

		$this->load->view('booking/add' , $data);
	}

	public function save_booking()
	{
		$ajax_data = file_get_contents("php://input");
        $json_data = json_decode($ajax_data);

        $entity_uid = $json_data->entity_uid;
        $diary_uid = $json_data->diary_uid;
        $booking_type_uid = $json_data->booking_type_uid;
        $booking_status_uid = $json_data->booking_status_uid;
        $start = $json_data->start_time;
        $duration = $json_data->duration;
        $patient_uid = $json_data->patient_uid;
        $reason = $json_data->reason;
        $cancelled = $json_data->cancelled;

		$result = create_booking($entity_uid, $diary_uid, $booking_type_uid, $booking_status_uid, $start, $duration, $patient_uid, $reason, $cancelled);

		echo $result;
	}

	public function view_add_patient_info()
	{
		$ajax_data = file_get_contents("php://input");
        $json_data = json_decode($ajax_data);

        $patient_uid = $json_data->patient_uid;

		$data = array();

		$data['patient_uid'] = $patient_uid;

		$this->load->view('booking/patient_info' , $data);
	}

	public function edit()
	{
		$data = array();

		$this->load->view('booking/edit' , $data);
	}

	public function get_patient_debtor()
	{
		$title = '';
		$initials = '';
		$name = '';
		$surname = '';

		$ajax_data = file_get_contents("php://input");
        $json_data = json_decode($ajax_data);

        $debtor_uid = $json_data->debtor_uid;
        // $debtor_uid = 2;

		$records = $this->api_get_debtors();

		foreach($records as $row)
		{
			$row_id = $row->uid;

			if ($row_id == $debtor_uid)
			{
				$title = $row->title;
				$initials = $row->initials;
				$name = $row->name;
				$surname = $row->surname;
			}
		}
		
		echo $title . ' ' . $initials . ' ' . $name . ' ' . $surname;
	}

	private function api_get_bookings()
	{
		$response = "";
		$response = get_bookings('session_id="\"109cca73-4090-40f6-ac1f-45d9104fc512\"_applicant_001"');

		$json = json_decode($response);
		$records = $json->data;
	
		return $records;
	}

	private function api_get_booking_status($entity_uid, $diary_uid)
	{
		$response = "";
		$response = get_booking_status('session_id="\"109cca73-4090-40f6-ac1f-45d9104fc512\"_applicant_001"', $entity_uid , $diary_uid);

		$json = json_decode($response);
		$records = $json->data;
		
		$data = array();

		foreach ($records as $row)
		{
			$id = $row->uid;
			$name = $row->name;

			$data[$id] = $name;
		}

		return $data;
	}

	private function api_get_booking_types()
	{
		$response = "";
		$response = get_booking_types();

		$json = json_decode($response);
		$records = $json->data;

		$data = array();
		
		foreach ($records as $row)
		{
			$id = $row->uid;
			$name = $row->name;

			$data[$id] = $name;
		}

		return $data;
	}

	private function api_get_patients()
	{
		$response = "";
		$response = get_patients();

		$json = json_decode($response);
		$records = $json->data;

		return $records;
	}

	private function api_get_debtors()
	{
		$response = "";
		$response = get_debtors();

		$json = json_decode($response);
		$records = $json->data;

		return $records;
	}

}
