<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailSubscribe extends CI_Controller {//not really needed just use update
//id,application,
	public function index(){
		$this->load->model('AccountRepository');
		$this->load->model('Account');
		$this->load->model('Error_model');
		$this->load->library('email');
			
		
		$email=$this->input->post('email');
		if($this->AccountRepository->emailExsists($email)){
				
			$acc=$this->AccountRepository->loadFromEmail($email);
				
			$acc->setEmailSub('1');
			
			$acc=$this->AccountRepository->saveAcc($acc);
			
			$error=$this->Error_model->error('your email has been verified.');
		}else{
			$error=$this->Error_model->no_error('your email does not match an account.');
		}
		echo json_encode($error);
	}
}