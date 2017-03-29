<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class ProfileRepository extends CI_Model
{
	function __construct(){
		parent::__construct();
		$this->load->model('ProfileFactory'); 
		$this->load->model('Security'); 
		$this->load->library('session');
		$this->load->database();
		date_default_timezone_set('Europe/London');
	}
	
	public function loadFromID($accountID){
		$profile=null;
		$this->db->from('profile');
		$this->db->where(array('profile.accountID'=>$accountID));
		$this->db->limit(1);
		$query = $this->db->get();
		$res = $query->result();
		
		if(array_key_exists('0', $res))
			$profile=$this->ProfileFactory->setProfileFromResults($res[0]);
        
		return $profile;
	}
	
	public function loadFromUsername($username){
		$profile=null;
		$this->db->from('profile');
$this->db->join('account', 'account.id = profile.accountID');
		$this->db->where(array('account.username'=>$username));
		$this->db->limit(1);
		$query = $this->db->get();
		$res = $query->result();
		
		if(array_key_exists('0', $res))
			$profile=$this->ProfileFactory->setProfileFromResults($res[0]);
        
		return $profile;
	}
	
	public function loadCollectionFromGameID($gameID){
		$collection=new $this->ProfileCollection();
		$this->load->database();
			$this->db->select('*');
			$this->db->from('profile');
$this->db->join('games-players', 'games-players.accountID = profile.accountID','left');
			$this->db->where(array('games-players.gameID'=> $gameID));
			$query = $this->db->get();
			$res = $query->result();  // this returns an object of all results
			
			foreach ($res as $row) {
				$collection->add(
					$this->ProfileFactory->setProfileFromResults($row)
				);
			}
		return $collection;
	}
	
	public function updateProfile($profile){
			$array=$profile->toDBArray();
			$this->db->from('profile');
			$this->db->where(array('profile.accountID'=>$array['accountID']));
			unset($array['accountID']);
			$this->db->update('profile', $array);
	}
	
	public function insertProfile($profile){
		
			$this->db->insert('profile', $profile->toArray());
	}
	
	public function deleteProfile($profile){
		//$this->db->delete('profile', array('id' => $profile->getID())); 
	}
}