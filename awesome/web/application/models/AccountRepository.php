<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class AccountRepository extends CI_Model
{
	function __construct(){
		parent::__construct();
		$this->load->model('AccountFactory'); 
		$this->load->model('Security'); 
		$this->load->library('session');
		$this->load->database();
		date_default_timezone_set('Europe/London');
	}
	
	public function loadFromID($id){//for admins or mods
		$acc=null;
		$this->db->from('account');
		$this->db->where(array('account.id'=>$id));
		$this->db->limit(1);
		$query = $this->db->get();
		$res = $query->result();
		
		if(array_key_exists('0', $res))
			$acc=$this->AccountFactory->setAccountFromResults($res[0]);
        
		return $acc;
	}

	public function loadFromEmail($email){

		$this->db->from('account');
		$this->db->select('*');
		$this->db->where(array('account.email' => $email));
		$this->db->limit(1);
		$query = $this->db->get();
		$res = $query->result();
		$acc=null;
		if(array_key_exists('0', $res))
			$acc=$this->AccountFactory->setAccountFromResults($res[0]);
        
		return $acc;
	}
	public function loadFromUsername($username){

		$this->db->from('account');
		$this->db->select('*');
		$this->db->where(array('account.username' => $username));
		$this->db->limit(1);
		$query = $this->db->get();
		$res = $query->result();
		$acc=null;
		if(array_key_exists('0', $res))
			$acc=$this->AccountFactory->setAccountFromResults($res[0]);
        
		return $acc;
	}
	public function loadFromPasswordEmail($password,$email){
		$password=$this->Security->salt_hash_password($password,$email);
		
		if($password==null)return;
		
		
		$this->db->from('account');
		$this->db->select('*');
		$this->db->where(array('account.password'=>$password));
		$this->db->where(array('account.email' => $email));
		$this->db->limit(1);
		$query = $this->db->get();
		$res = $query->result();
		$acc=null;
		if(array_key_exists('0', $res))
			$acc=$this->AccountFactory->setAccountFromResults($res[0]);
        
		return $acc;
	}
	public function loadFromGoogleID($googleID){
		if($googleID==null)return;
		$acc=null;
		$this->db->from('account');
		$this->db->select('*');
		$this->db->where(array('account.google_id'=>$googleID));
		$this->db->limit(1);
		$query = $this->db->get();
		$res = $query->result();
		if(array_key_exists('0', $res))
			$acc=$this->AccountFactory->setAccountFromResults($res[0]);
        
		return $acc;
	}

	public function loadFromAuth($auth){
		
		$this->db->from('account');
		$this->db->select('*');
		$this->db->where(array('account.auth_key'=>$auth));
		$this->db->limit(1);
		$query = $this->db->get();
		$res = $query->result();
		if(array_key_exists('0', $res))
			return $this->AccountFactory->setAccountFromResults($res[0]);
        return null;
	}
	
	public function updateAuthKey($acc){
		$chars = array_merge(range("a","z"),range("A","Z"),range("0","9"));
					 shuffle($chars);
				    $auth_key =implode('',array_slice($chars,0,10));
				
		$this->db->from('account');
		$this->db->where('id', $acc->getId());
		$this->db->set('date_logged_in', 'DATE_ADD(NOW(), INTERVAL 1 MINUTE)', FALSE);
		$this->db->set('auth_key', $auth_key);
		$this->db->update('account');
		$acc->setAuthKey($auth_key);
		//echo($this->db->last_query().'<br>');
		return $acc;
	}
	
	public function signOut(){
		$auth=$this->session->userdata('auth_key');
		$this->db->where(array('account.auth_key' => $auth,'account.verify'=>'1'));
		$this->db->update('account', array('auth_key'=> NULL));
		
		$this->Security->setUserAccount(null);
	}
	
	public function emailExists($email){
		$this->db->where('email', $email);
		$query = $this->db->get('account');
		
		return($query->num_rows() > 0);
	}
	
	public function insertAcc($acc){
		
		$this->db->insert('account', array(
				'username'=> $acc->getUsername(),
				'first_name'=> $acc->getFirstName(),
				'last_name'=> $acc->getLastName(),
				'email'=> $acc->getEmail()
				)); 
		$acc->setId($this->db->insert_id());
		$password=$this->Security->salt_hash_password($acc->getPassword(),$acc->getEmail());
		$this->updateAuthKey($acc);
		$acc->setPassword($password);
		$this->saveAccPass($acc);
		$this->db->insert('profile', array('accountID'=> $acc->getId())); 
		$acc=$this->loadFromAuth($acc->getAuthKey());
		$this->Security->setUserAccount($acc);
	}
	
	public function insertGoogleAcc($acc){
		
		$this->db->insert('account', array(
				'username'=> $acc->getUsername(),
				'first_name'=> $acc->getFirstName(),
				'last_name'=> $acc->getLastName(),
				'email'=> $acc->getEmail(),
				'google_id'=> $acc->getGoogleID(),
				'verify'=> $acc->getVerify()
				)); 
		$acc->setId($this->db->insert_id());
		$password=$this->Security->salt_hash_password($acc->getPassword(),$acc->getEmail());
		$this->updateAuthKey($acc);
		$acc->setPassword($password);
		$this->saveAccPass($acc);
		$this->db->insert('profile', array('accountID'=> $acc->getId()));
		$acc=$this->loadFromAuth($acc->getAuthKey());
		$this->Security->setUserAccount($acc);
		return $acc;
	}
	
	public function saveAcc($acc){
		$this->db->where(array('account.auth_key' => $acc->getAuthKey()));
			$this->db->update('account',
			array(
				'username'=> $acc->getUsername(),
				'first_name'=> $acc->getFirstName(),
				'last_name'=> $acc->getLastName(),
				'verify'=> $acc->getVerify(),
				'email_sub'=> $acc->getEmailSub(),
				'google_id'=> $acc->getGoogleID(),
				'flags'=> $acc->getFlags()
			));
	}
	
	public function saveAccPass($acc){
		
		$this->db->where(array('account.auth_key' => $acc->getAuthKey()));
			$this->db->update('account',
			array(
				'password'=> $acc->getPassword()
			));
		//echo($this->db->last_query().'<br>');
	}
	
	public function saveAccEmail(){
		
		$this->db->where(array('account.auth_key' => $acc->getAuthKey()));
			$this->db->update('account',
			array(
				'email'=> $acc->getEmail()
			));
	}
	
} 