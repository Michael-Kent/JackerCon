<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email  extends MY_Controller {
	public $apiResponse;
	
	
   function __construct() {
       parent::__construct();
		$this->load->model('ApiResponse');
		$this->apiResponse= new ApiResponse();
		$this->load->model('AccountRepository');
   }/*
   public function index(){
	   //phpinfo();
	   $fp = fsockopen('localhost', 80, $errno, $errstr, 5);
		if (!$fp) {
			echo('port 80 is closed or blocked.');
		} else {
			echo('port 80 is open and available');
			fclose($fp);
		}
	   $fp = fsockopen('localhost', 25, $errno, $errstr, 5);
		if (!$fp) {
			echo('port 25 is closed or blocked.');
		} else {
			echo('port 25 is open and available');
			fclose($fp);
		}
	   $fp = fsockopen('localhost', 587, $errno, $errstr, 5);
		if (!$fp) {
			echo('port 587 is closed or blocked.');
		} else {
			echo('port 587 is open and available');
			fclose($fp);
		}
	   $fp = fsockopen('localhost', 465, $errno, $errstr, 5);
		if (!$fp) {
			echo('port 465 is closed or blocked.');
		} else {
			echo('port 465 is open and available');
			fclose($fp);
		}
   }*/
   public function subscribe(){
		if($this->isLoggedIn()){
		$acc=$this->Security->getUserAccount();
			$acc->setEmailSub('1');
			$acc=$this->AccountRepository->saveAcc($acc);	
			$this->apiResponse->setMessage(
				'#notification'
				,
				'Subscribed to emails .'
			);
			$this->apiResponse->setSuccess(true);
		}else{
			$this->apiResponse->setMessage(
				'#notification'
				,
				'you must be logged in to complete this action.'
			);
			$this->apiResponse->setSuccess(false);
		}
		$this->apiResponse->showResponse();
   }
   public function unSubscribe($email=null){
	   
		if($this->isLoggedIn()){
		$acc=$this->Security->getUserAccount();
			$acc->setEmailSub('0');
			$acc=$this->AccountRepository->saveAcc($acc);
			$this->apiResponse->setMessage('#notification',
				'Your email has been unsubscribed.'
			);
			$this->apiResponse->setSuccess(true);
		}else{
			if($email==null) $email=$this->input->post('email');
		
			if($email==null) $email=$this->input->get('email');
		
			if($this->AccountRepository->emailExists($email)){
				$acc=$this->AccountRepository->loadFromEmail($email);
				$acc->setEmailSub('0');
				$acc=$this->AccountRepository->saveAcc($acc);
				
				$this->apiResponse->setMessage('#notification',
					'your email has been unsubscribed.'
				);
				$this->apiResponse->setSuccess(true);
			}else{
				$this->apiResponse->setMessage('#notification',
					'that email does not match an account.'
				);
				$this->apiResponse->setSuccess(false);
			}
		}
		$this->apiResponse->showResponse();
   }
   public function send($action){
	   
		$this->load->model('AccountRepository');
		$this->load->model('EmailLinkFactory');
		$this->load->model('EmailLinkRepository');
		$this->load->library('email');
		$this->load->model('ApiResponse');
		$this->apiResponse= new ApiResponse();
		
				
				
		$email=$this->input->post('email');
		$emailLink=$this->EmailLinkFactory->createEmailLink();
		
		switch($action){
			case 'PasswordReset':
				$this->passwordReset($email,$emailLink);
			break;
			case 'VerifyResend':
				$this->verifyResend($email,$emailLink);
			break;
			default:
				$this->apiResponse->setMessage(
					'#notification'
					,
					'default case reached.'
				);
				$this->apiResponse->setSuccess(false);
			
	   }
		$this->apiResponse->showResponse();
   }
   
   private function passwordReset($email,$emailLink){
				if($this->AccountRepository->emailExists($email)){
					$acc=$this->AccountRepository->loadFromEmail($email);
					$emailLink->setAction('resetPassword');
					$emailLink->setAccountID($acc->getID());
					
					$this->email->from('no-reply@jackercon.com');
					$this->email->to($acc->getEmail());
					$this->email->subject('JackerCon email password reset link.');

					$this->email->message(
						$this->load->view('email/insert_acc',array('acc'=>$acc,'emailLink'=>$emailLink),true).
						$this->load->view('email/footer',array('acc'=>$acc),true)
					);
						
					if ( ! $this->email->send())
					{
						
						$this->apiResponse->setMessage(
							'#notification'
							,
							'we were unable to resend your email, please try again.'
						);
						$this->apiResponse->setMessage(
							'#resend-error'
							,
							$this->email->print_debugger()
						);
						$this->apiResponse->setSuccess(false);
					}else{
						
						$this->EmailLinkRepository->insertEmailLink($emailLink);
						$this->apiResponse->setMessage(
							'#notification'
							,
							'you have been sent an email with a reset password link.'
						);
						$this->apiResponse->setSuccess(true);
						
					}
				}else{
					
					$this->apiResponse->setMessage(
						'#notification'
						,
						'there is no account registered to '.$email.', please try registering again.'
					);
					$this->apiResponse->setSuccess(false);
				}
   }
   
   private function verifyResend($email,$emailLink){
	   if($this->AccountRepository->emailExists($email)){
			$acc=$this->AccountRepository->loadFromEmail($email);
				$emailLink->setAction('verify');
				$emailLink->setAccountID($acc->getID());
				
				
				$this->email->from('no-reply@jackercon.com');
				$this->email->to($acc->getEmail());
				$this->email->subject('JackerCon email verification link resend.');

				$this->email->message(
					$this->load->view('email/email_verification',array('acc'=>$acc,'emailLink'=>$emailLink),true).
					$this->load->view('email/footer',array('acc'=>$acc),true)
				);
					
				if ( ! $this->email->send())
				{
					
					$this->apiResponse->setMessage(
						'#notification'
						,
						'we were unable to resend your email, please try again.'
					);
					$this->apiResponse->setSuccess(false);
					echo ($this->email->print_debugger());
				}else{
					
					$this->EmailLinkRepository->insertEmailLink($emailLink);
					$this->apiResponse->setMessage(
						'#notification'
						,
						'your email has been resent.'
					);
					$this->apiResponse->setSuccess(true);
					
				}
		}else{
			
			$this->apiResponse->setMessage(
				'#notification'
				,
				'there is no account registered to '.$email.', please try registering again.'
			);
			$this->apiResponse->setSuccess(false);
		}
   }
   
}