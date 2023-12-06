<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data = array();

		$data['main_content'] = 'home/index';

		$this->load->view('includes/template' , $data);
	}
}
