<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Game extends MY_Controller 
{
	public function index(){
		$this->Create();
	}
	
	public function Search($userID=null){
		$this->load->view('shared/header');
		
		$data=$this->getData();
		
		$this->load->view('shared/navigation',$data);
		$this->load->view('shared/notification',array('notification'=>$this->input->post('notification')));
		

			$games=null;
		$this->load->model('GameCollection'); 
		$this->load->model('GameRepository'); 
		
		if($userID==null){
			$games=$this->GameRepository->loadCollection();
		}else{
			if(is_numeric($userID)){
				$games=$this->GameRepository->loadCollectionFromUserID($userID);
			}else{
				$this->load->model('AccountRepository'); 
				$acc=$this->AccountRepository->loadFromUsername($userID);
				if($acc!==null)
					$games=$this->GameRepository->loadCollectionFromUserID($acc->getId());
			}
		}
		if($games!==null){	
			$data['games']=$games->toArray();
		}else{
			$data['games']=array();
		}
		$this->load->view('view_games',$data);	
		
		$this->load->view('shared/footer');
	}
	public function View($gameID=null){
		if($gameID==null){
			header("Location: ".base_url('View/Games')); 
			die();
		}else{
			$this->load->model('GameRepository'); 
			$game=$this->GameRepository->loadFromID($gameID);
			
			$this->load->model('AccountRepository'); 
			$host=$this->AccountRepository->loadFromID($game->getHostID());
			$this->load->view('shared/header');
			
			$data=$this->getData();
			
			$this->load->view('shared/navigation',$data);
		$this->load->view('shared/notification',array('notification'=>$this->input->post('notification')));
			if($game!==null){
				$data['game']=$game->toArray();
				$data['host']=$host->toArray();
			}else{
				$data['game']=array();
				$data['host']=array();
			}		
					
			$this->load->view('view_game',$data);	
			
			$this->load->view('shared/footer');
		}
	}
	public function Create()
	{
		$this->load->view('shared/header');
		$data=$this->getData();
		if($data['loggedIn']){
			$this->load->view('shared/navigation',$data);
		$this->load->view('shared/notification',array('notification'=>$this->input->post('notification')));
			$this->load->view('createGame',$data);	
		}else{
			header("Location: ".base_url()); 
			die();
		}
		$this->load->view('shared/footer');
	}
	
	public function Manage($gameID=null){
		if($gameID==null){
			header("Location: ".base_url('View/Games')); 
			die();
		}else{
			$this->load->model('GameRepository'); 
			$game=$this->GameRepository->loadFromID($gameID);
			$this->load->view('shared/header');
		
			$data=$this->getData();
			$acc=$this->getAccount();
			$accountID=$acc['id'];
			$this->load->view('shared/navigation',$data);
		$this->load->view('shared/notification',array('notification'=>$this->input->post('notification')));
			if($game!==null){
				if($game->getHostID()==$accountID){
					
					$data['game']=$game->toArray();
					
				}else{
					$data['game']=array();
					echo('you are not GM.');
				}
			}else{
				$data['game']=array();
			}
			$this->load->view('edit_game',$data);	
		
			$this->load->view('shared/footer');
		}
	}
	
}