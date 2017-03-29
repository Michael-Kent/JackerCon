<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AccountObject extends CI_Model
{
	function __construct(){
		parent::__construct();
	}
	
	private $id=null;
	private $googleID=null;
	private $username;
	private $firstName;
	private $lastName;
	private $password;
	private $authKey;
	private $email;
	private $verify;//email verified
	private $emailSub;
	private $date_created;
	private $date_logged_in;
	private $flags;
	
	public function isAdmin(){
		return (strpos($this->flags,'A')!== FALSE);
	}
	
	public function isMod(){
		return $this->isAdmin()|(strpos($this->flags,'M')!==FALSE);
	}
	
	public function toArray()
	{
		$array=array();
		
		$array['id']=$this->id;
		$array['username']=$this->username;
		$array['firstName']=$this->firstName;
		$array['lastName']=$this->lastName;
		$array['email']=$this->email;
		$array['verify']=$this->verify;
		$array['emailSub']=$this->emailSub;
		$array['google_linked']=$this->googleID!==null;
		$array['date_created']=$this->date_created;
		$array['date_logged_in']=$this->date_logged_in;
		
		return $array;
	}
	
	function setId($id) { 
		$this->id = $id; 
		return $this->id!=null;
	}

	function getId() {
		return $this->id; 
	}
	
	function setGoogleID($googleID) { 
		$this->googleID = $googleID; 
		return $this->googleID!=null;
	}

	function GetGoogleID() {
		return $this->googleID; 
	}
		
	function setUsername($username) { 
		$username=preg_replace('/[^A-Za-z0-9]/u','', strip_tags($username));
		if (!preg_match('/[^A-Za-z0-9]/', $username))
			{		
				if(strlen($username)>0)
					$this->username = $username;
			}
		return $this->username!=null;
			 
	}

	function getUsername() { 
		return $this->username; 
	}
		
	function setFirstName($firstName) { 
		if(strlen($firstName)>0)
		$this->firstName = $firstName; 
		return $this->firstName!=null;
	}

	function getFirstName() { 
		return $this->firstName; 
	}

	function setLastName($lastName) {
		if(strlen($lastName)>0)
		$this->lastName = $lastName; 
		return $this->lastName!=null;
	}
		
	function getLastName() {
		return $this->lastName;
	}
		
	function setPassword($password) {
		$this->password = $password; 
		return $this->password!=null;
	}
		
	function getPassword() { 
		return $this->password;
	}
	 
	function setAuthKey($authKey) {
		$this->authKey = $authKey;
		return $this->authKey!=null;
	}
		
	function getAuthKey() {
		return $this->authKey; 
	}

	function setEmail($email) { 
	$this->email = $email; 
		return $this->email!=null;
	}
		
	function getEmail() { 
	return $this->email; 
	}
	
	function setVerify($verify) {
		$this->verify = $verify;
		return $this->verify!=null;
	}
		
	function getVerify() {
		return $this->verify;
	}
		
	function setEmailSub($emailSub) {
		$this->emailSub = $emailSub;
		return $this->emailSub!=null;
	}
		
	function getEmailSub() {
		return $this->emailSub;	
	}
		
	function setDate_created($date_created) {
		$this->date_created = $date_created;
		return $this->date_created!=null;
	}
		
	function getDate_created() { 
		return $this->date_created;
	}

	function setDate_logged_in($date_logged_in) {
		$this->date_logged_in = $date_logged_in; 
		return $this->date_logged_in!=null;
	}
		
	function getDate_logged_in() { 
		return $this->date_logged_in; 
	}

	function setFlags($flags) { 
		$this->flags = $flags; 
		return $this->flags!=null;
	}
	 
	function getFlags() { 
		return $this->flags; 
	}

}