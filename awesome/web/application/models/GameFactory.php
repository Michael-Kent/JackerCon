<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GameFactory extends CI_Model
{
 
    public function __construct()
    {
		parent::__construct();
		$this->load->model('GameObject'); 
		$this->load->model('ProfileCollection'); 
		$this->load->model('ProfileRepository'); 
		$this->load->model('CommentCollection'); 
		$this->load->model('CommentRepository'); 
    }
 
    public function createGame()
    {
        return new $this->GameObject();
    }
	
	public function setGameFromResults($row)
	{
		$game=new $this->GameObject();
		$host=$this->ProfileRepository->loadFromID($row->host_ID);
		$profileCollection=$this->ProfileRepository->loadCollectionFromGameID($row->ID);
		$commentCollection=$this->CommentRepository->loadCollectionFromGameID($row->ID);
		$game->setID($row->ID);
		$game->setHostID($host->getID());
		$game->setHostName($host->getUsername());
		$game->setName($row->name);
		$game->setSystem($row->system);
		$game->setDescription($row->description);
		$game->setTimestampStart($row->timestamp_start);
		$game->setTimestampFinish($row->timestamp_finish);
		$game->setPlayers($profileCollection);
		$game->setComments($commentCollection);
		$game->setMaxPlayers($row->max_players);
		$game->setHostingPlatform($row->hosting_platform);
		$game->setPlayerInfo($row->player_info);
		$game->setImageUrl($row->image_url);
		$game->isPublic($row->is_public);
		$game->setIsLive($row->live);
		
		return $game;
	}
}