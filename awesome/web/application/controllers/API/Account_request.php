<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_request extends CI_Controller {

	public function index()
	{
		$this->load->model('AccountRepository');
		$this->load->library('session');
		
		$acc=$this->AccountRepository->loadFromAuth(
			$this->session->userdata('auth_key')
		);
		
		echo json_encode($acc->toArray());
	}
	
}