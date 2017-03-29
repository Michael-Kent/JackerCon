<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Game extends MY_Controller 
{
	
	private $apiResponse;
    function __construct()
    {
        parent::__construct();
		$this->load->model('GameFactory');
		$this->load->model('GameRepository');
		$this->load->model('ApiResponse');
		$this->apiResponse=new $this->ApiResponse();
		
	}
	
	public function index(){
		echo('game api');
	}

	public function insert(){
		
		$data=$this->getData();
		$game=$this->GameFactory->createGame();
		$this->apiResponse->setSuccess(true);
		
		if($data['loggedIn']){
			//print_r($data);
				$game=$this->populateFromPost($game);
				
				$game->setHostID($data['account']['id']);
				if($this->apiResponse->getSuccess()==true){
					$this->GameRepository->insertGame($game);
					
					$this->apiResponse->setRedirectPage(base_url('Game/View/'.$this->db->insert_id()));
					$this->apiResponse->setMessage(
						'notification'
						,
						'You have successfully created '.$game->getName().','
					);
				//echo $this->db->last_query();
				}
		}else{
				$this->apiResponse->setMessage(
					'#response'
					,
					'You are required to be logged in before you can host a game.'
				);
				$this->apiResponse->setSuccess(false);
			}
		
		//$game=$this->GameRepository->loadCollection();
		
		$this->apiResponse->showResponse();
	}
	private function populateFromPost($game){
			if(!$game->setName($this->input->post('title'))){	
			}
			if(!$game->setSystem($this->input->post('system'))){
			}
			if(!$game->setDescription($this->input->post('description'))){
			}
			if(!$game->setTimestampStart($this->input->post('timestampStart'))){
			}
			if(!$game->setTimestampFinish($this->input->post('timestampFinish'))){
				$this->apiResponse->setMessage('#response',
					'An end time for your game has not been selected, this is required to ensure full attendance.'
				);
				$this->apiResponse->setSuccess(false);
			}
			if(!$game->setMaxPlayers($this->input->post('maxPlayers'))){
			}
			if(!$game->setHostingPlatform($this->input->post('hostingPlatform'))){
			}
			if(!$game->setPlayerInfo($this->input->post('playerInfo'))){
			}
			if(!$game->setImageUrl($this->input->post('imageUrl'))){
			}
			if(!$game->setIsLive($this->input->post('live')=='on')){
			}
			return $game;
	}
	/* Update
	
	post:   title,description,timestampStart,timestampFinish,maxPlayers
	
	*/
	public function update($gameID=null){
		
		
		$this->load->model('GameFactory');
		$this->load->model('GameRepository');
		$this->load->database();
		
		$data=$this->getData();
		$game=$this->GameRepository->loadFromID($gameID);
		
		if($data['loggedIn']&&$game!=null){
			if($data['account']['id']==$game->getHostID()){
				
				$game=$this->populateFromPost($game);
				
				$this->GameRepository->updateGame($game,$data['account']['id']);
				
				$this->apiResponse->setMessage(
					'#notification'
					,
					'your changes have been made.'
				);
				$this->apiResponse->setSuccess(true);
				$this->apiResponse->setRedirectPage(base_url('Game/View/'.$gameID));
			}else{
				$this->apiResponse->setMessage(
					'#notification'
					,
					'you need to be the host to edit a game.'
				);
				$this->apiResponse->setSuccess(false);
			}
		}else{
			$this->apiResponse->setMessage(
					'#notification'
					,
					'your changes were not successfull.'
				);
				$this->apiResponse->setSuccess(false);
		}
		
		$this->apiResponse->showResponse();
	}

	public function leave($gameID=null,$userID=null){
		$this->load->model('GameRepository'); 
		$game=$this->GameRepository->loadFromID($gameID);
		
		$data=$this->getData();
		$acc=$this->getAccount();
		$accountID=$acc['id'];
		
		if($game!==null){
				
				if($game->getPlayers()->getChildById($accountID)!==null){
						$this->GameRepository->removePlayer($game->getID(),$accountID);
						$this->apiResponse->setMessage(
							'#notification'
							,
							$acc['username'].' has been successfully removed from the game'
						);
						$this->apiResponse->setSuccess(true);
						$this->apiResponse->setRedirectPage(base_url('Game/View/'.$gameID));
				}else if($game->getHostID()==$accountID&&$userID!==null){
						$this->GameRepository->removePlayer($game->getID(),$userID);
						$this->apiResponse->setMessage(
							'#notification'
							,
							$acc['username'].' has been successfully removed from the game'
						);
						$this->apiResponse->setSuccess(true);
						$this->apiResponse->setRedirectPage(base_url('Game/View/'.$gameID));
				}else{
					$this->apiResponse->setMessage(
						'#notification'
						,
						$acc['username'].' is not currently a player in this game.'
					);
					$this->apiResponse->setSuccess(false);
				}
		}else{
			$this->apiResponse->setMessage(
				'#notification'
				,
				'It seems this game cannot be found.'
			);
			$this->apiResponse->setSuccess(false);
		}
		$this->apiResponse->showResponse();
	}

	public function join($gameID=null){
		$this->load->model('GameRepository'); 
			
		$game=$this->GameRepository->loadFromID($gameID);
		$acc=$this->getAccount();
		$accountID=$acc['id'];
				
		if($game!==null){
			if($game->getPlayers()->count()<$game->getMaxPlayers()){
				if($game->getPlayers()->getChildById($accountID)==null){
					if($game->getHostID()!==$accountID){
						$this->GameRepository->insertPlayer($game->getID(),$accountID);
						$this->apiResponse->setMessage(
							'#notification'
							,
							$acc['username'].' has been successfully added to the game'
						);
						$this->apiResponse->setSuccess(true);
						$this->apiResponse->setRedirectPage(base_url('Game/View/'.$gameID));
					}else{
						$this->apiResponse->setMessage(
							'#notification'
							,
							'You are hosting this game, and cannot be a participant.'
						);
						$this->apiResponse->setSuccess(false);
					}
				}else{
					$this->apiResponse->setMessage(
						'#notification'
						,
						'You are already in this game.'
					);
					$this->apiResponse->setSuccess(false);
				}
			}else{
				
				$this->apiResponse->setMessage(
					'#notification'
					,
					'It seems this game is already full, please check again closer to the event.'
				);
				$this->apiResponse->setSuccess(false);
			}
			
		}else{
			$this->apiResponse->setMessage(
				'#notification'
				,
				'It seems this game cannot be found.'
			);
			$this->apiResponse->setSuccess(false);
		}
		$this->apiResponse->showResponse();
	}
	
	public function approve($gameID=null,$userID=null){
		$this->load->model('GameRepository'); 
			
		$game=$this->GameRepository->loadFromID($gameID);
		$acc=$this->getAccount();
		$accountID=$acc['id'];
				
		if($game!==null){
			if($game->getHostID()==$accountID){
				if($game->getPlayers()->getChildById($userID)!==null){
					$this->GameRepository->approvePlayer($game->getID(),$userID);
					$this->apiResponse->setMessage(
						'#notification'
						,
						$acc['username'].' has been successfully approved for to the game'
					);
					$this->apiResponse->setSuccess(true);
					$this->apiResponse->setRedirectPage(base_url('Game/View/'.$gameID));
				}//else player has not requested to join.
			}//else action only avaliable to game host.
		}//else game not found.
		$this->apiResponse->showResponse();
	}
	
	public function AddComment($gameID=null){
		$this->load->model('GameRepository'); 
		$this->load->model('CommentRepository'); 
		$this->load->model('ProfileRepository'); 
		$this->load->model('CommentFactory'); 
			
		$game=$this->GameRepository->loadFromID($gameID);
		$acc=$this->getAccount();
		$accountID=$acc['id'];
				
		if($this->isLoggedIn()){
			if($game!==null){
				$comment=$this->CommentFactory->createComment();
				$comment->profile_id=$accountID;
				$comment->profile=$this->ProfileRepository->loadFromID($accountID);
				$comment->target_id=$game->getID();
				$comment->comment=$this->input->post('comment');
				$this->CommentRepository->insertComment($comment);
						$this->apiResponse->setMessage(
							'#notification'
							,
							$acc['username'].'\'s comment has been added to this game'
						);
						$this->apiResponse->setSuccess(true);
						$this->apiResponse->setRedirectPage(base_url('Game/View/'.$gameID));
			}//else game not found.
		}//user not logged in.
		$this->apiResponse->showResponse();
	}
}