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

		// Diary is not provided on login so the entity name is being hard coded
		$data['entity_name'] = 'Entity ID: ' . $_COOKIE["entity_uid"];
		$data['diary_name'] = $_COOKIE["diary_name"];

		// Set page view items
		$data['topbar'] = 'booking/topbar';
		$data['main_content'] = 'booking/index';

		$this->load->view('includes/template' , $data);
	}

	public function view($booking_uid)
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
        $cancelled = false;

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

		$ajax_data = file_get_contents("php://input");
        $json_data = json_decode($ajax_data);

        $booking_uid = $json_data->booking_uid;
		
		// Get booking record
		$result = $this->api_get_edit_booking($booking_uid);
		
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

		// Seperate date and time
		$get_start_time = $result[0]->start_time;
		$bits = explode("T", $get_start_time);
		$data['start_date'] = $bits[0];
		$data['start_time'] = $bits[1];
		
		// Set start time default
		$time_class = array('btn', 'btn', 'btn', 'btn', 'btn', 'btn', 'btn', 'btn', 'btn', 'btn');
		$time_types = array('08:00:00', '09:00:00', '10:00:00', '11:00:00', '12:00:00', '13:00:00', '14:00:00', '15:00:00', '16:00:00', '17:00:00');
		$set_time = array_search($bits[1], $time_types);
		$time_class[$set_time] = 'btn_on';
		$data['time_class'] = $time_class;

		// Set duration default
		$get_duration = $result[0]->duration;
		$duration_class = array('btn', 'btn', 'btn', 'btn');
		$duration_types = array('15', '30', '45', '60');
		$set_duration = array_search($get_duration, $duration_types);
		$duration_class[$set_duration] = 'btn_on';
		$data['duration_class'] = $duration_class;

		//Set booking type default
		$get_type = $result[0]->booking_type_uid;
		$type_class = array('btn_disabled', 'btn_disabled', 'btn_disabled', 'btn_disabled');
		$type_class[$get_type] = 'btn_disabled_on';
		$data['type_class'] = $type_class;

		// Set patient_uid@@debtor_uid
		$data['patient_id'] = $result[0]->patient_uid . '@@' . $result[0]->debtor_uid;

		// Set debtor name
		$data['debtor_name'] = $result[0]->debtor_name . ' ' . $result[0]->debtor_surname;

		$data['reason'] = $result[0]->reason;
		$data['uid'] = $result[0]->uid;
		$data['set_time'] = $bits[1];
		$data['set_duration'] = $result[0]->duration;
		
		$this->load->view('booking/edit' , $data);
	}

	public function update_booking()
	{
		$ajax_data = file_get_contents("php://input");
        $json_data = json_decode($ajax_data);

		$booking_uid = $json_data->booking_uid;
        $start_time = $json_data->start_time;
        $duration = $json_data->duration;
        $patient_uid = $json_data->patient_uid;
        $reason = $json_data->reason;
        $cancelled = false;

		$result = update_booking($booking_uid, $start_time, $duration, $patient_uid, $reason);

		echo $result;
	}

	public function delete_booking()
	{
		$ajax_data = file_get_contents("php://input");
        $json_data = json_decode($ajax_data);

        $booking_uid = $json_data->booking_uid;

		$result = delete_booking($booking_uid);

		echo $result;
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
		$today = date("Y-m-d");
		$response = get_bookings($today);

		$json = json_decode($response);
		$records = $json->data;
	
		return $records;
	}

	private function api_get_edit_booking($booking_uid)
	{
		$response = "";
		$response = get_edit_booking($booking_uid);

		$json = json_decode($response);
		$record = $json->data;

		return $record;
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
