<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Game_request extends CI_Controller 
{
	public function index()
	{
		$this->load->model('GameRepository');
		
		if($this->input->post('game_id')==null||null==$this->input->post('host_id')){
			$result=$this->GameRepository->loadCollection();
		}else if ($this->input->post('game_id')==null){
			$result=$this->GameRepository->loadCollectionFromHostID($this->input->post('host_id'));
		}else{
			$result=$this->GameRepository->loadFromID($this->input->post('host_id'));
		}
		
		echo $result->toJson();
	}	
}