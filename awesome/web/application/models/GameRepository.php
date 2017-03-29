<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class GameRepository extends CI_Model
{
 
    public function __construct()
    {
		parent::__construct();
		$this->load->model('GameFactory'); 
		$this->load->model('GameCollection'); 
		$this->load->database();
    }
	
	public function loadFromID($id){//for admins or mods
		$game=null;
		$this->db->from('games');
		
		$this->db->select('*');
		$this->db->where(array('games.ID'=>$id));
		$query = $this->db->get();
		$res = $query->result();
		
		if(array_key_exists('0', $res))
			$game=$this->GameFactory->setGameFromResults($res[0]);
		
		return $game;
	}
	
	
	public function loadCollection(){
		$collection=new $this->GameCollection();
		$this->load->database();
			$this->db->select('*');
			$this->db->from('games');
			$this->db->where(array('is_public'=> true));
			$this->db->order_by('timestamp_start');
			$query = $this->db->get();
			$res = $query->result();  // this returns an object of all results
			
			foreach ($res as $row) {
				$collection->add(
					$this->GameFactory->setGameFromResults($row)
				);
			}
		return $collection;
	}
	
	public function loadCollectionFromHostID($hostId){
		$collection=new $this->GameCollection();
		$this->load->database();
			$this->db->select('*');
			$this->db->from('games');
			$this->db->where(array('host_ID'=>$hostId));
			$this->db->order_by('timestamp_start');
			$query = $this->db->get();
			$res = $query->result();  // this returns an object of all results
			
			foreach ($res as $row) {
				$collection->add(
					$this->GameFactory->setGameFromResults($row)
				);
			}
		return $collection;
	}
	
	public function loadCollectionFromUserID($playerId){
		$collection=new $this->GameCollection();
		$this->load->database();
			$this->db->select('*');
			$this->db->from('games');
			$this->db->join('games-players', 'games.ID = games-players.gameID','left');
			$this->db->where(array('host_ID'=>$playerId));
			$this->db->or_where(array('accountID'=>$playerId));
			$this->db->order_by('timestamp_start');
			$query = $this->db->get();
			$res = $query->result();  // this returns an object of all results
			
			foreach ($res as $row) {
				$collection->add(
					$this->GameFactory->setGameFromResults($row)
				);
			}
		return $collection;
	}
	
	public function insertGame($game){
		
			$this->db->insert('games', array(
				'host_id'=> $game->getHostID(),
				'name'=> $game->getName(),
				'system'=> $game->getSystem(),
				'description'=> $game->getDescription(),
				'timestamp_start'=> $game->getTimestampStart(),
				'timestamp_finish'=> $game->getTimestampFinish(),
				'max_players'=> $game->getMaxPlayers(),
				'hosting_platform'=> $game->getHostingPlatform(),
				'image_url'=> $game->getImageUrl(),
				'player_info'=> $game->getPlayerInfo(),
				'is_public'=> $game->isPublic(),
				'live'=> $game->getIsLive()
				));			
	}
	
	public function insertPlayer($userID,$gameID){
		
			$this->db->insert('games-players', array(
				'gameID'=> $userID,
				'accountID'=> $gameID
				));			
	}
	
	public function approvePlayer($userID,$gameID){
		
			$this->db->from('games-players');
			$this->db->where(array(
				'gameID'=> $userID,
				'accountID'=> $gameID
				));
			
			$this->db->update('games-players', array(
					'approved'=> 1
				));			
	}
	
	public function removePlayer($userID,$gameID){
		
			$this->db->delete('games-players', array(
				'gameID'=> $userID,
				'accountID'=> $gameID
				));			
	}
	
	public function updateGame($game,$userID){
		
		
			$this->db->where(array('ID'=>$game->getID(),'host_id'=>$userID));
			$this->db->update('games', array(
				'host_id'=> $game->getHostID(),
				'name'=> $game->getName(),
				'system'=> $game->getSystem(),
				'description'=> $game->getDescription(),
				'timestamp_start'=> $game->getTimestampStart(),
				'timestamp_finish'=> $game->getTimestampFinish(),
				'max_players'=> $game->getMaxPlayers(),
				'hosting_platform'=> $game->getHostingPlatform(),
				'image_url'=> $game->getImageUrl(),
				'player_info'=> $game->getPlayerInfo(),
				'is_public'=> $game->isPublic(),
				'live'=> $game->getIsLive()
				));			
	}
	
}