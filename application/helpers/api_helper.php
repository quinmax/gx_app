<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function login_old($cred_1, $cred_2)
{
	/** 
	 * Commented out for dev/testing
	 * applicant_001
	 * app001
	 * 
	 * Fail: echo '{"status":"AUTH_FAILED:CREDENTIALS"}';
	 * Pass: echo '{"status":"OK","data":{"uid":"0434abc5-cf20-45c3-a904-0e470b9c5610"}}';
	 */
	
	$url = 'https://dev_interview.qagoodx.co.za/api/session';

	$san_cred_1 = filter_var($cred_1, FILTER_SANITIZE_STRING);
	$san_cred_2 = filter_var($cred_2, FILTER_SANITIZE_STRING);

	$post_array = array();

	$post_array['model'] = array('timeout' => 259200);
	$post_array['auth'][0] = array(0 => 'password', array('username' => $san_cred_1, 'password' => $san_cred_2));
	
	$data = json_encode($post_array);

	$result = post_api_call($url, $data);

	echo $result;
}

function login($cred_1, $cred_2)
{
	$san_cred_1 = filter_var($cred_1, FILTER_SANITIZE_STRING);
	$san_cred_2 = filter_var($cred_2, FILTER_SANITIZE_STRING);

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://dev_interview.qagoodx.co.za/api/session',
	  CURLOPT_SSL_VERIFYPEER => false,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>'{
		"model": {
			"timeout": 259200
		},
		"auth": [
			[
				"password",
				{
					"username": "' . $san_cred_1 . '",
					"password": "' . $san_cred_2 . '"
				}
			]
		]
	}',
	  CURLOPT_HTTPHEADER => array(
		'Content-Type: application/json',
		'Cookie: session_id="\\"8d0fa9cc-591c-481d-bf78-6608fedee7e4\\"_applicant_001"'
	  ),
	));
	
	$response = curl_exec($curl);
	
	curl_close($curl);

	echo $response;
}

function get_diaries($uid)
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://dev_interview.qagoodx.co.za/api/diary?fields=[%0A%20%20%20%20%22uid%22%2C%0A%20%20%20%20%22entity_uid%22%2C%0A%20%20%20%20%22treating_doctor_uid%22%2C%0A%20%20%20%20%22service_center_uid%22%2C%0A%20%20%20%20%22booking_type_uid%22%2C%0A%20%20%20%20%22name%22%2C%0A%20%20%20%20%22uuid%22%2C%0A%20%20%20%20%22disabled%22%0A]',
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'Cookie: session_id="\\"8d0fa9cc-591c-481d-bf78-6608fedee7e4\\"_applicant_001"'
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);

	return $response;
}

function get_bookings($today)
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://dev_interview.qagoodx.co.za/api/booking?fields=[%0A%20%20%20%20[%22AS%22%2C[%22I%22%2C%22patient_uid%22%2C%22name%22]%2C%22patient_name%22]%2C%0A%20%20%20%20[%22AS%22%2C[%22I%22%2C%22patient_uid%22%2C%22surname%22]%2C%22patient_surname%22]%2C%0A%20%20%20%20[%22AS%22%2C[%22I%22%2C%22patient_uid%22%2C%22debtor_uid%22%2C%22name%22]%2C%22debtor_name%22]%2C%0A%20%20%20%20[%22AS%22%2C[%22I%22%2C%22patient_uid%22%2C%22debtor_uid%22%2C%22surname%22]%2C%22debtor_surname%22]%2C%0A%20%20%20%20%22uid%22%2C%0A%20%20%20%20%22entity_uid%22%2C%0A%20%20%20%20%22diary_uid%22%2C%0A%20%20%20%20%22booking_type_uid%22%2C%0A%20%20%20%20%22booking_status_uid%22%2C%0A%20%20%20%20%22patient_uid%22%2C%0A%20%20%20%20%22start_time%22%2C%0A%20%20%20%20%22duration%22%2C%0A%20%20%20%20%22treating_doctor_uid%22%2C%0A%20%20%20%20%22reason%22%2C%0A%20%20%20%20%22invoice_nr%22%2C%0A%20%20%20%20%22cancelled%22%2C%0A%20%20%20%20%22uuid%22%0A]&filter=[%0A%20%20%20%20%22AND%22%2C%0A%20%20%20%20[%0A%20%20%20%20%20%20%20%20%22%3D%22%2C%0A%20%20%20%20%20%20%20%20[%22I%22%2C%22diary_uid%22]%2C%0A%20%20%20%20%20%20%20%20[%22L%22%2C1]%0A%20%20%20%20]%2C%0A%20%20%20%20[%0A%20%20%20%20%20%20%20%20%22%3D%22%2C%0A%20%20%20%20%20%20%20%20[%0A%20%20%20%20%20%20%20%20%20%20%20%20%22%3A%3A%22%2C%0A%20%20%20%20%20%20%20%20%20%20%20%20[%22I%22%2C%22start_time%22]%2C%0A%20%20%20%20%20%20%20%20%20%20%20%20[%22I%22%2C%22date%22]%0A%20%20%20%20%20%20%20%20]%2C%0A%20%20%20%20%20%20%20%20[%22L%22%2C%22' . $today . '%22]%0A%20%20%20%20]%0A]',
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array('Cookie: session_id="\\"8d0fa9cc-591c-481d-bf78-6608fedee7e4\\"_applicant_001"'),
	));

	$response = curl_exec($curl);

	curl_close($curl);

	return $response;
}

function get_edit_booking($booking_uid)
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://dev_interview.qagoodx.co.za/api/booking?fields=[%0A%20%20%20%20[%22AS%22%2C[%22I%22%2C%22patient_uid%22%2C%22name%22]%2C%22patient_name%22]%2C%0A%20%20%20%20[%22AS%22%2C[%22I%22%2C%22patient_uid%22%2C%22surname%22]%2C%22patient_surname%22]%2C%0A%20%20%20%20[%22AS%22%2C[%22I%22%2C%22patient_uid%22%2C%22debtor_uid%22%2C%22name%22]%2C%22debtor_name%22]%2C%0A%20%20%20%20[%22AS%22%2C[%22I%22%2C%22patient_uid%22%2C%22debtor_uid%22%2C%22surname%22]%2C%22debtor_surname%22]%2C%0A%20%20%20%20[%22AS%22%2C[%22I%22%2C%22patient_uid%22%2C%22debtor_uid%22]%2C%22debtor_uid%22]%2C%0A%20%20%20%20%22uid%22%2C%0A%20%20%20%20%22entity_uid%22%2C%0A%20%20%20%20%22diary_uid%22%2C%0A%20%20%20%20%22booking_type_uid%22%2C%0A%20%20%20%20%22booking_status_uid%22%2C%0A%20%20%20%20%22patient_uid%22%2C%0A%20%20%20%20%22start_time%22%2C%0A%20%20%20%20%22duration%22%2C%0A%20%20%20%20%22treating_doctor_uid%22%2C%0A%20%20%20%20%22reason%22%2C%0A%20%20%20%20%22invoice_nr%22%2C%0A%20%20%20%20%22cancelled%22%2C%0A%20%20%20%20%22uuid%22%0A]&filter=[%0A%20%20%20%20%20%20%20%20%22%3D%22%2C%0A%20%20%20%20%20%20%20%20[%22I%22%2C%22uid%22]%2C%0A%20%20%20%20%20%20%20%20[%22L%22%2C' . $booking_uid . ']%0A%20%20%20%20]',
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'Cookie: session_id="\\"8d0fa9cc-591c-481d-bf78-6608fedee7e4\\"_applicant_001"'
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);

	return $response;
}

function get_booking_status($uid, $entity_uid, $diary_uid)
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://dev_interview.qagoodx.co.za/api/booking_status?fields=[%0A%20%20%20%20%22uid%22%2C%0A%20%20%20%20%22entity_uid%22%2C%0A%20%20%20%20%22diary_uid%22%2C%0A%20%20%20%20%22name%22%2C%0A%20%20%20%20%22next_booking_status_uid%22%2C%0A%20%20%20%20%22is_arrived%22%2C%0A%20%20%20%20%22is_final%22%2C%0A%20%20%20%20%22disabled%22%0A]&filter=[%22AND%22%2C%0A%20%20%20%20[%22%3D%22%2C%0A%20%20%20%20%20%20%20%20[%22I%22%2C%22entity_uid%22]%2C%0A%20%20%20%20%20%20%20%20[%22L%22%2C1]%0A%20%20%20%20]%2C%0A%20%20%20%20[%22%3D%22%2C%0A%20%20%20%20%20%20%20%20[%22I%22%2C%22diary_uid%22]%2C%0A%20%20%20%20%20%20%20%20[%22L%22%2C1]%0A%20%20%20%20]%2C%0A%20%20%20%20[%22NOT%22%2C%0A%20%20%20%20%20%20%20%20[%22I%22%2C%22disabled%22]%0A%20%20%20%20]%0A]',
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
		'Cookie: session_id="\\"8d0fa9cc-591c-481d-bf78-6608fedee7e4\\"_applicant_001"'
		),
	));
	
	$response = curl_exec($curl);
	$error = curl_error($curl);

	curl_close($curl);
	
	return $response;
}

function get_booking_types()
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://dev_interview.qagoodx.co.za/api/booking_type?fields=[%0A%20%20%20%20%22uid%22%2C%0A%20%20%20%20%22entity_uid%22%2C%0A%20%20%20%20%22diary_uid%22%2C%0A%20%20%20%20%22name%22%2C%0A%20%20%20%20%22booking_status_uid%22%2C%0A%20%20%20%20%22disabled%22%2C%0A%20%20%20%20%22uuid%22%0A]&filter=[%22AND%22%2C%0A%20%20%20%20[%22%3D%22%2C%0A%20%20%20%20%20%20%20%20[%22I%22%2C%22entity_uid%22]%2C%0A%20%20%20%20%20%20%20%20[%22L%22%2C1]%0A%20%20%20%20]%2C%0A%20%20%20%20[%22%3D%22%2C%0A%20%20%20%20%20%20%20%20[%22I%22%2C%22diary_uid%22]%2C%0A%20%20%20%20%20%20%20%20[%22L%22%2C1]%0A%20%20%20%20]%2C%0A%20%20%20%20[%22NOT%22%2C%0A%20%20%20%20%20%20%20%20[%22I%22%2C%22disabled%22]%0A%20%20%20%20]%0A]',
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'Cookie: session_id="\\"8d0fa9cc-591c-481d-bf78-6608fedee7e4\\"_applicant_001"'
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);

	return $response;
}

function get_patients()
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://dev_interview.qagoodx.co.za/api/patient?fields=[%0A%09%22uid%22%2C%0A%09%22entity_uid%22%2C%0A%09%22debtor_uid%22%2C%0A%09%22name%22%2C%0A%09%22surname%22%2C%0A%09%22initials%22%2C%0A%09%22title%22%2C%0A%09%22id_type%22%2C%0A%09%22id_no%22%2C%0A%09%22date_of_birth%22%2C%0A%09%22mobile_no%22%2C%0A%09%22email%22%2C%0A%09%22file_no%22%2C%0A%09%22gender%22%2C%0A%09%22dependant_no%22%2C%0A%09%22dependant_type%22%2C%0A%09%22acc_identifier%22%2C%0A%09%22gap_medical_aid_option_uid%22%2C%0A%09%22gap_medical_aid_no%22%2C%0A%09%22private%22%2C%0A%09%22patient_classification_uid%22%0A]&filter=[%0A%09%22%3D%22%2C%0A%09[%22I%22%2C%20%22entity_uid%22]%2C%0A%09[%22L%22%2C%201]%0A]&limit=100',
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'Cookie: session_id="\\"8d0fa9cc-591c-481d-bf78-6608fedee7e4\\"_applicant_001"'
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);

	return $response;
}

function get_debtors()
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://dev_interview.qagoodx.co.za/api/debtor?fields=[%0A%20%20%20%20%22uid%22%2C%0A%20%20%20%20%22entity_uid%22%2C%0A%20%20%20%20%22name%22%2C%0A%20%20%20%20%22surname%22%2C%0A%20%20%20%20%22initials%22%2C%0A%20%20%20%20%22title%22%2C%0A%20%20%20%20%22id_type%22%2C%0A%20%20%20%20%22id_no%22%2C%0A%20%20%20%20%22mobile_no%22%2C%0A%20%20%20%20%22email%22%2C%0A%20%20%20%20%22file_no%22%2C%0A%20%20%20%20%22gender%22%2C%0A%20%20%20%20%22acc_identifier%22%2C%0A%20%20%20%20%22patients%22%2C%0A%20%20%20%20%22medical_aid_option_uid%22%2C%0A%20%20%20%20%22medical_aid_no%22%2C%0A%20%20%20%20%22medical_aid_scheme_code%22%0A]&filter=[%0A%09%22%3D%22%2C%0A%09[%22I%22%2C%20%22entity_uid%22]%2C%0A%09[%22L%22%2C%201]%0A]&limit=100',
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'Cookie: session_id="\\"8d0fa9cc-591c-481d-bf78-6608fedee7e4\\"_applicant_001"'
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);

	return $response;
}

function create_booking_old($entity_uid, $diary_uid, $booking_type_uid, $booking_status_uid, $start_time, $duration, $patient_uid, $reason, $cancelled)
{
	$url = 'https://dev_interview.qagoodx.co.za/api/booking';
	$post_array['model'] = array('entity_uid' => $entity_uid, 'diary_uid' => $diary_uid, 'booking_type_uid' => $booking_type_uid, 'booking_status_uid' => $booking_status_uid, 'start_time' => $start_time, 'duration' => $duration, 'patient_uid' => $patient_uid, 'reason' => $reason, 'cancelled' => $cancelled);

	$data = json_encode($post_array);
	
	$result = post_api_call($url, $data);
	// $result = '{"status":"OK","data":{"uid":4}}';

	return $result;
}

function create_booking($entity_uid, $diary_uid, $booking_type_uid, $booking_status_uid, $start_time, $duration, $patient_uid, $reason, $cancelled)
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://dev_interview.qagoodx.co.za/api/booking',
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
			"model": 
			{
				"entity_uid": ' . $entity_uid . ', 
				"diary_uid": ' . $diary_uid . ', 
				"booking_type_uid": ' . $booking_type_uid . ', 
				"booking_status_uid": ' . $booking_status_uid . ', 
				"start_time": "' . $start_time . '", 
				"duration": ' . $duration . ', 
				"patient_uid": ' . $patient_uid . ', 
				"reason": "' . $reason . '", 
				"cancelled": false 
			}
		}',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			'Cookie: session_id="\\"8d0fa9cc-591c-481d-bf78-6608fedee7e4\\"_applicant_001"'
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		echo $response;
}

function update_booking($booking_uid, $start_time, $duration, $patient_uid, $reason)
{
	$curl = curl_init();

	// echo "AAA: $booking_uid, $start_time, $duration, $patient_uid, $reason";

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://dev_interview.qagoodx.co.za/api/booking/' . $booking_uid,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'PUT',
		CURLOPT_POSTFIELDS =>'{
			"model": 
			{
				"uid": ' . $booking_uid . ', 
				"start_time": "' . $start_time . '", 
				"duration": ' . $duration . ', 
				"patient_uid": ' . $patient_uid . ', 
				"reason": "' . $reason . '", 
				"cancelled": false 
			}
		}',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			'Cookie: session_id="\\"8d0fa9cc-591c-481d-bf78-6608fedee7e4\\"_applicant_001"'
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);

	return $response;
}

function delete_booking($booking_uid)
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://dev_interview.qagoodx.co.za/api/booking/' . $booking_uid,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'PUT',
		CURLOPT_POSTFIELDS =>'{
			"model": 
			{
				"uid": ' . $booking_uid . ', 
				"cancelled": true 
			}
		}',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			'Cookie: session_id="\\"8d0fa9cc-591c-481d-bf78-6608fedee7e4\\"_applicant_001"'
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);

	return $response;
}
?>
