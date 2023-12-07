<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bridge extends CI_Controller 
{
	public function login()
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

		$ajax_data = file_get_contents("php://input");
        $json_data = json_decode($ajax_data);
		
		$cred_1 = $json_data->cred_1;
		$cred_2 = $json_data->cred_2;

		$san_cred_1 = filter_var($cred_1, FILTER_SANITIZE_STRING);
		$san_cred_2 = filter_var($cred_2, FILTER_SANITIZE_STRING);

		$post_array = array();

		$post_array['model'] = array('timeout' => 259200);
		$post_array['auth'][0] = array(0 => 'password', array('username' => $san_cred_1, 'password' => $san_cred_2));
		
		$data = json_encode($post_array);

		$result = $this->do_api_call($url, $data);

		echo $result;
	}

	public function getDiaries()
	{
		/*{{gxweb_url}}/api/diary?fields=[
			"uid",
			"entity_uid",
			"treating_doctor_uid",
			"service_center_uid",
			"booking_type_uid",
			"name",
			"uuid",
			"disabled"
		]*/

		$url = 'https://dev_interview.qagoodx.co.za/api/diary?fields=';
		$params = rawurlencode('["uid", "entity_uid", "treating_doctor_uid", "service_center_uid", "booking_type_uid", "name", "uuid", "disabled"]');
		$api_call = $url . $params;


		// https://dev_interview.qagoodx.co.za/api/diary?fields=[
		// 	"uid",
		// 	"entity_uid",
		// 	"treating_doctor_uid",
		// 	"service_center_uid",
		// 	"booking_type_uid",
		// 	"name",
		// 	"uuid",
		// 	"disabled"
		// ]

		$result = $this->get_api_call($api_call);

		echo $result;
	}

	private function get_api_call($api_call)
    {
        /* Init cURL resource */
        $ch = curl_init($api_call);

        /* pass encoded JSON string to the POST fields */
		curl_setopt($ch,CURLOPT_COOKIE, 'session_id="\"109cca73-4090-40f6-ac1f-45d9104fc512\"_applicant_001"');
		
        /* set the content type json */
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

		/* handle https/ssl */
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);

        /* set return type json */
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
        /* execute request */
        $result = curl_exec($ch);
             
		/* output errors */
		echo 'Curl error: ' . curl_error($ch); 

        curl_close($ch);

        return $result;
    }

	private function do_api_call($url, $data)
    {
        /* API URL */
        // $url = 'https://opentdb.com/api.php?amount=10&category=9&difficulty=easy';
   
        /* Init cURL resource */
        $ch = curl_init($url);

        /* Array Parameter Data */
        // $data = ['name'=>'', 'email'=>''];

		curl_setopt ( $ch, CURLOPT_POST, 1 );
   
        /* pass encoded JSON string to the POST fields */
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		
        /* set the content type json */
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

		/* handle https/ssl */
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);

        /* set return type json */
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
        /* execute request */
        $result = curl_exec($ch);
             
        curl_close($ch);

        return $result;
    }

	private function bbb()
	{
		$url = 'https://opentdb.com/api.php?amount=10&category=9&difficulty=easy';

		$ch = curl_init( );
        $headers = array(
        'plain/text'
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, 1 );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
		// curl_setopt ($ch, 'SSL_VERIFYHOST', false);


		//curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_body );
        // Allow cUrl functions 20 seconds to execute
        curl_setopt ( $ch, CURLOPT_TIMEOUT, 20 );
        // Wait 10 seconds while trying to connect
        curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
        $output = array();
        $output['server_response'] = curl_exec( $ch );
        $curl_info = curl_getinfo( $ch );
        $output['http_status'] = $curl_info[ 'http_code' ];
        $output['error'] = curl_error($ch);
        curl_close( $ch );

		print_r($output);
        return $output;
	}
	

	// function get_api_call($api_call)
// {
// 	/* Init cURL resource */
// 	$ch = curl_init($api_call);

// 	/* pass encoded JSON string to the POST fields */
// 	curl_setopt($ch,CURLOPT_COOKIE, 'session_id="\"8d0fa9cc-591c-481d-bf78-6608fedee7e4\"_applicant_001"');
	
// 	/* set the content type json */
// 	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

// 	/* handle https/ssl */
// 	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);

// 	/* set return type json */
// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
// 	/* execute request */
// 	$result = curl_exec($ch);
			
// 	/* output errors */
// 	// echo 'Curl error: ' . curl_error($ch); 

// 	curl_close($ch);

// 	return $result;
// }
}
