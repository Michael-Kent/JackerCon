<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {
	
	public function index()
	{
		$data=$this->getData();
		if($data['isAdmin']){
			$this->load->view('shared/header');
			
			$this->load->view('shared/navigation',$data);
			$this->load->view('shared/notification',array('notification'=>$this->input->post('notification')));
			$this->load->view('admin');	
			
			
			$this->load->view('shared/footer');
		}else{
			header("Location: ".base_url()); 
			die();
		}
	}
}
?>