<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailVerifyResend extends CI_Controller {
//id,application,

	public $apiResponse;
	
	public function index(){
		$this->load->model('AccountRepository');
		$this->load->model('EmailLinkFactory');
		$this->load->model('EmailLinkRepository');
		$this->load->library('email');
		$this->load->model('ApiResponse');
		$this->apiResponse= new ApiResponse();
		
		$email=$this->input->post('email');
		$emailLink=$this->EmailLinkFactory->createEmailLink();
		if($this->AccountRepository->emailExists($email)){
			$acc=$this->AccountRepository->loadFromEmail($email);
				$emailLink->setAction('verify');
				$emailLink->setAccountID($acc->getID());
				
				$this->email->from('admin@online-projects.co.uk');
				$this->email->to($acc->getEmail());
				$this->email->subject('online-projects email verification link resend.');

				$this->email->message(
					$this->load->view('email/insert_acc',array('acc'=>$acc,'emailLink'=>$emailLink),true).
					$this->load->view('email/footer',array('acc'=>$acc),true)
				);
					
				if ( ! $this->email->send())
				{
					
					$this->apiResponse->setMessage(
						'#resend'
						,
						'we were unable to resend your email, please try again.'
					);
					$this->apiResponse->setSuccess(false);
					echo ($this->email->print_debugger());
				}else{
					
					$this->EmailLinkRepository->insertEmailLink($emailLink);
					$this->apiResponse->setMessage(
						'#resend'
						,
						'your email has been resent.'
					);
					$this->apiResponse->setSuccess(true);
					
				}
		}else{
			
			$this->apiResponse->setMessage(
				'#resend'
				,
				'there is no account registered to '.$email.', please try registering again.'
			);
			$this->apiResponse->setSuccess(false);
		}
		
		$this->apiResponse->showResponse();
	}
}