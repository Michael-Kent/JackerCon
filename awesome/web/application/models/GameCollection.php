<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 
class GameCollection extends CI_Model
{
    private $games = array();
    
	public function __construct()
    {
		parent::__construct();
		$this->load->model('GameObject'); 
	}
 
    public function add($game)
    {
        if (!isset($this->games[$game->getId()])) {
            $this->games[$game->getId()] = $game;
        }
    }
 
    public function remove($game)
    {
        if (isset($this->games[$game->getId()])) {
            unset($this->games[$game->getId()]);
        }
    }
 
    public function getChildById($id)
    {
        return isset($this->games[$id]) ? $this->games[$id] : null;
    }
	
	public function toJson()
	{
		$result=array();
		foreach ($this->games as $game) {
			$result[]=$game->toArray();
		}
		return json_encode($result);
	}
	
	public function toArray()
	{
		$result=array();
		foreach ($this->games as $game) {
			$result[]=$game->toArray();
		}
		return $result;
	}
}