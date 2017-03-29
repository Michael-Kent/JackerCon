<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terms_and_conditions extends MY_Controller {
	
	public function index()
	{
		
		$data=$this->getData();
		
		$this->load->view('shared/header');
		
		$this->load->view('shared/navigation',$data);
		$this->load->view('shared/notification',array('notification'=>$this->input->post('notification')));
		$this->load->view('terms');	
		
		$this->load->view('shared/footer');
		
	}
}
?>