<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {
	
	public function index(){
		$data=$this->getData();
		
		if($data['loggedIn']){
				$acc=$this->getAccount();
				$username=$acc['username'];
		}
		$this->load->model('ProfileRepository'); 
		$profile=$this->ProfileRepository->loadFromUsername($username);
		if($profile!==null){
			$profile->loadComments();
			$data['profile']=$profile->toArray();
		}else{
			$data['profile']=array();
		}
		$this->load->view('shared/header');
		
		
		$this->load->view('shared/navigation',$data);
		$this->load->view('shared/notification',array('notification'=>$this->input->post('notification')));
		$this->load->view('view_profile',$data);	
		
		$this->load->view('shared/footer');
	}
	
	public function Search($username=null){
		$data=$this->getData();
		
		if($username==null){
		if($data['loggedIn']){
				$acc=$this->getAccount();
				$username=$acc['username'];
			}else{
				show_404();
			}
		}
		$this->load->model('ProfileRepository'); 
		$profile=$this->ProfileRepository->loadFromUsername($username);
		if($profile!==null){
			$profile->loadComments();
			$data['profile']=$profile->toArray();
		}else{
			//$data['profile']=array();
			show_404();
		}
		$this->load->view('shared/header');
		
		
		$this->load->view('shared/navigation',$data);
		$this->load->view('view_profile',$data);	
		
		$this->load->view('shared/footer');
	}
	
	public function edit(){
		$this->load->view('shared/header');
		
		if($this->isLoggedIn()){
			$data=$this->getData();
			$this->load->model('ProfileRepository'); 
			$profile=$this->ProfileRepository->loadFromUsername($data['account']['username']);
			if($profile!==null){
				$data['profile']=$profile->toArray();
			}else{
				$data['profile']=array();
			}
		
			$this->load->view('shared/navigation',$data);
			$this->load->view('edit_profile',$data);	
		}
		
		$this->load->view('shared/footer');
	}
	
}