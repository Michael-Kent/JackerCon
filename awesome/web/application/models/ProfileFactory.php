<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileFactory extends CI_Model
{
 
    public function __construct()
    {
		parent::__construct();
		$this->load->model('ProfileObject'); 
    }
 
    public function createProfile()
    {
        $profile= new $this->ProfileObject();
		return $profile;
    }
	
	public function setProfileFromResults($row)
	{
		$this->load->model('AccountRepository');
		
		$profile=new $this->ProfileObject();
		$account=$this->AccountRepository->loadFromID($row->accountID);
		$profile->setID($row->accountID);
		$profile->setAccountID($row->accountID);
		$profile->setUsername($account->getUsername());
		$profile->setImageLink($row->imageLink);
		$profile->setAboutMe($row->aboutMe);
		if(isset($row->approved)){
			$profile->setApproved($row->approved);
		}
		if(isset($row->join_timestamp)){
			$profile->setJoinTimestamp($row->join_timestamp);
		}
		
		return $profile;
	}
}