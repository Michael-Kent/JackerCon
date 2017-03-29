<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_link extends MY_Controller {
//id,application,
	public function index(){
		$this->load->model('EmailLinkRepository');
		$this->load->model('EmailLink');
		$this->load->model('AccountRepository');
		$this->load->library('email');
			
		$this->load->view('shared/header');
		
		$this->load->view('shared/navigation',$this->getData());
		$this->load->view('shared/notification',array('notification'=>$this->input->post('notification')));
		
		$acc=null;
		
		$code=$this->input->get('code');
		$emailLink=$this->EmailLinkRepository->loadFromCode($code);
		if($emailLink!==null)
			$acc=$this->AccountRepository->loadFromID($emailLink->getAccountID());
		
		if($acc!==null){
			
			switch ($emailLink->getAction()) {
				case "verify":
						
						$acc->setVerify('1');
						$acc=$this->AccountRepository->saveAcc($acc);
						
						echo('your email has been verified.');
					$header='Success';
					$class='';
					$note='your email has been verified.';
					$this->EmailLinkRepository->deleteEmailLink($emailLink);
				break;
				case "resetPassword":
					$this->load->view('password_reset',array('code'=>$emailLink->getCode()));
				break;
			}
	}else{
			echo('Email link invalid');
		if($emailLink!==null)
			echo('account not found');
		$header='Error';
		$class='error';
		$note='account not found';
	}
	
	
		$this->load->view('shared/footer');
	
	
	}
}