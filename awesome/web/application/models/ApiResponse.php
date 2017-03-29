<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class ApiResponse extends CI_Model {
	
	private $success;
	private $redirectPage;
	private $messages;
	
	function getResponse(){
		$this->load->helper('url');
		$data=array();
		$data['URI']=current_url();
		$data['success']=$this->getSuccess();
		$data['redirectPage']=$this->getRedirectPage();
		$data['messages']=$this->getMessages();
		return json_encode($data);
	}
	function showResponse(){
		echo $this->getResponse();
	}
	function setSuccess($bool){
		$this->success=$bool;
	}
	
	function getSuccess(){
		return isset($this->success) ? $this->success : false; 
	}
	
	function setRedirectPage($redirect){
		$this->redirectPage=$redirect;
	}
	
	function getRedirectPage(){
		return isset($this->redirectPage) ? $this->redirectPage : null; 
	}
	
	function canRedirect(){
		return $this->redirectPage!=null;
	}
	
	function setMessage($selector,$message){
		if(!is_array($this->messages))
			$this->messages=array();
		
		$this->messages[$selector]=$message;
	}
	
	function removeMessage($selector){
		unset($this->messages[$selector]);
	}
	
	function getMessages(){
		if(!is_array($this->messages))
			$this->messages=array();
		
		return $this->messages;
	}
	
}