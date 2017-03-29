<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {
	
	public function index()
	{
		$this->load->view('shared/header');
		
		$data=$this->getData();
		
		if($data['loggedIn']){	
			$this->load->view('shared/navigation',$data);
			$this->load->view('shared/notification',array('notification'=>$this->input->post('notification')));
			$this->load->view('user_details',$data);
		}else{
			header("Location: ".base_url()); 
			die();
		}
		$this->load->view('shared/footer');
	}
	
	public function Edit(){
		$this->load->view('shared/header');
		
		if($this->isLoggedIn()){
			$data=$this->getData();
			$this->load->view('shared/navigation',$data);
			$this->load->view('shared/notification',array('notification'=>$this->input->post('notification')));
			$this->load->view('edit_account',$data);	
		}
		
		$this->load->view('shared/footer');
	}
	
	public function Login(){
		$this->load->view('shared/header');
		
		$this->load->view('shared/navigation',$this->getData());
			$this->load->view('shared/notification',array('notification'=>$this->input->post('notification')));
		$this->load->view('login');	
		
		$this->load->view('shared/footer');
	}
	
	public function Register(){
		
		$this->load->view('shared/header');
		
		$this->load->view('shared/navigation',$this->getData());
			$this->load->view('shared/notification',array('notification'=>$this->input->post('notification')));
		$this->load->view('register');	
		
		$this->load->view('shared/footer');
	}

	
	public function UnSubscribe(){
		
		$this->load->view('shared/header');
		$data=$this->getData();
		$this->load->view('shared/navigation',$data);
			$this->load->view('shared/notification',array('notification'=>$this->input->post('notification')));
		$email=null;
		if($data['loggedIn']){
			$email=$this->getAccount()['email'];
		}else{
			$email=$this->input->get('email');
		}
		if($email!==null){
			$data['unsubscribe_email']=$email;
			$this->load->view('unsubscribe',$data);	
		}
		$this->load->view('shared/footer');
	}

	
}