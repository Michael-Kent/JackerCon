<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class EmailLinkRepository extends CI_Model
{
	function __construct(){
		parent::__construct();
		$this->load->model('EmailLinkFactory'); 
		$this->load->model('Security'); 
		$this->load->library('session');
		$this->load->database();
		date_default_timezone_set('Europe/London');
	}
	
	public function loadFromCode($code){//for admins or mods
		$email=null;
		$this->db->from('email_link');
		$this->db->where(array('email_link.code'=>$code));
		$this->db->limit(1);
		$query = $this->db->get();
		$res = $query->result();
		
		if(array_key_exists('0', $res))
			$email=$this->EmailLinkFactory->setEmailLinkFromResults($res[0]);
        
		return $email;
	}
	
	public function insertEmailLink($emailLink){
		
			$this->db->insert('email_link', $emailLink->toArray());
	}
	
	public function deleteEmailLink($emailLink){
		$this->db->delete('email_link', array('id' => $emailLink->getID())); 
	}
}