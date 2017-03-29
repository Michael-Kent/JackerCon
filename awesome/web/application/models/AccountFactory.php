<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class AccountFactory extends CI_Model
{
	function __construct(){
		
		parent::__construct();
		$this->load->model('AccountObject'); 
		$this->load->model('AccountRepository');
		$this->load->database();
		date_default_timezone_set('Europe/London');
	}
     public function createAccount($id = null)
    {
        if(isset($id))return $this->AccountRepository->loadFromID($id);
		
		return new AccountObject();
    }
	
	public function setAccountFromResults($row){
				
			$account=new AccountObject();
			$account->setId($row->ID);
			$account->setGoogleID($row->google_id);
			$account->setUsername($row->username);
			$account->setFirstName($row->first_name);
			$account->setLastName($row->last_name);
			$account->setPassword($row->password);
			$account->setAuthKey($row->auth_key);
			$account->setEmail($row->email);
			$account->setVerify($row->verify);
			$account->setEmailSub($row->email_sub);
			$account->setDate_created($row->date_created);
			$account->setDate_logged_in($row->date_logged_in);
			$account->setFlags($row->flags);
			return $account;
	}
}
 