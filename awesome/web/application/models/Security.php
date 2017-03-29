<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Security extends CI_Model//possibly should be singleton
{
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		date_default_timezone_set('Europe/London');
	}
	
	public function salt_hash_password($password,$email){
		$this->db->select('date_created');
		$this->db->from('account');
		$this->db->where(array('account.email' => $email));
		$query = $this->db->get();
		$res = $query->result();  // this returns an object of all results
		if(array_key_exists('0', $res)){
			$row = $res[0]; 
			$salt=$row->date_created;
		}else{
			//echo $this->db->last_query();
		}
		$key=$this->config->item('encryption_key');
		return array_key_exists('0', $res)?sha1($salt.$password.$salt.$key):null;
	}
	public function createRandomCode(){
		$key=$this->config->item('encryption_key');
		return sha1(time().$key.time());
	}
	
	private $userAccount;
	
	public function getUserAccount(){
		return $this->userAccount;
	}
	public function setUserAccount($acc){
		$this->userAccount=$acc;
		if($acc!==null){
			$this->session->set_userdata('auth_key',$acc->getAuthKey());
		}else{
			$this->session->set_userdata('auth_key',null);
		}
	}
	
	public function isAdmin(){
		$acc=$this->getUserAccount();
		return $acc!=null?$acc->isAdmin():false;
	}
	public function isMod(){
		$acc=$this->getUserAccount();
		return $acc!=null?$acc->isMod():false;
	}
	public function isLoggedIn(){
		$acc=$this->getUserAccount();
		return $acc!=null;
	}
	
}