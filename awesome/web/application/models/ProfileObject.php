<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileObject extends CI_Model
{
	private $accountID=null;
	private $imageLink;
	private $aboutMe;
	private $username;
	private $comments=null;
	private $approved=0;
	private $joinTimestamp;
	
    public function __construct()
    {
		parent::__construct();
		$this->load->model('CommentCollection'); 
		$this->load->model('CommentRepository'); 
    }
	public function toArray()
	{
		$array=array();
		
		$array['ID']=$this->accountID;
		$array['accountID']=$this->accountID;
		$array['imageLink']=$this->getImageLink();
		$array['aboutMe']=$this->aboutMe;
		$array['username']=$this->username;
		$array['approved']=$this->approved;
		$array['join_timestamp']=$this->joinTimestamp;
		
		if($this->comments==null){
			$collection=new $this->CommentCollection();
			$array['comments']=$collection->toArray();
		}else{
			$array['comments']=$this->comments->toArray();
		}
		
		return $array;
	}
	
	public function toDBArray(){
		$array=$this->toArray();
		unset($array['ID']);
		unset($array['username']);
		unset($array['approved']);
		unset($array['join_timestamp']);
		unset($array['comments']);
		
		return $array;
	}
	
	public function loadComments(){
		$this->comments=$this->CommentRepository->loadCollectionFromProfileID($this->getID());
	}
	
	public function setID($accountID)
	{
		$this->accountID=$accountID;
	}

	public function getID()
	{
		return $this->accountID;
	}
	public function setAccountID($accountID)
	{
		$this->accountID=$accountID;
	}

	public function getAccountID()
	{
		return $this->accountID;
	}
	
	
	public function setUsername($username)
	{
		$this->username=$username;
	}

	public function getUsername()
	{
		return $this->username;
	}
	
	public function setImageLink($imageLink)
	{
		if(strlen($imageLink)>0)
			$this->imageLink = $imageLink;
		return $this->imageLink!=null;
	}

	public function getImageLink()
	{
		if($this->imageLink!=null)
			return $this->imageLink;
			
		return 'https://www.jackercon.com/resources/images/default-profile.jpg';
	}
	
	public function setAboutMe($aboutMe)
	{
		$this->aboutMe = strip_tags($aboutMe,'<br><b><i><p>');
		return $this->aboutMe!=null;
	}
	public function getAboutMe()
	{
		return nl2br($this->aboutMe);
	}
	
	public function setApproved($approved)
	{
		$this->approved=$approved;
	}
	public function getApproved()
	{
		return $this->approved;
	}
	
	public function setJoinTimestamp($joinTimestamp)
	{
		$this->joinTimestamp=$joinTimestamp;
	}
	public function getJoinTimestamp()
	{
		return $this->joinTimestamp;
	}
}