<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailUnsubscribe extends CI_Controller {
//id,application,
	public function index(){
		$this->load->model('AccountRepository');
		$this->load->model('Error_model');
		
		
		$email=$this->input->get('email');
		if($this->AccountRepository->emailExsists($email)){
				
			$acc=$this->AccountRepository->loadFromEmail($email);
				
			$acc->setEmailSub('0');
			
			$acc=$this->AccountRepository->saveAcc($acc);
			
			$error=$this->Error_model->error('your email has been unsubscribed.');
		}else{
			$error=$this->Error_model->no_error('your email does not match an account.');
		}
		echo json_encode($error);
	}
}