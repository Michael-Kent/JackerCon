<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	
	public function index()
	{
		echo('home test');
		return;
		$this->load->view('shared/header');
		
		$this->load->view('shared/navigation',$this->getData());
		$this->load->view('shared/notification',array('notification'=>$this->input->post('notification')));
		
		$games=null;
		$data=$this->getData();
		if($data['loggedIn']){
			$this->load->model('GameCollection'); 
			$this->load->model('GameRepository'); 
			$acc=$this->getAccount();
			$accountID=$acc['id'];
			$games=$this->GameRepository->loadCollectionFromUserID($accountID);
		}
		if($games!==null){	
			$data['games']=$games->toArray();
		}else{
			$data['games']=array();
		}
		
		$this->load->view('home',$data);	
		
		
		$this->load->view('shared/footer');
		
	}
}
?>