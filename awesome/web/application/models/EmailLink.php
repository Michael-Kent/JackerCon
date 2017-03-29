<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailLink extends CI_Model
{
	private $id=null;
	private $accountID;
	private $action;
	private $code;
	
	public function toArray()
	{
		$array=array();
		
		$array['ID']=$this->id;
		$array['accountID']=$this->accountID;
		$array['action']=$this->action;
		$array['code']=$this->code;
		
		return $array;
	}
	
	
	public function setID($id)
	{
		$this->id=$id;
	}

	public function getID()
	{
		return $this->id;
	}
	
	public function setAccountID($accountID)
	{
		$this->accountID=$accountID;
	}

	public function getAccountID()
	{
		return $this->accountID;
	}
	
	
	public function setAction($action)
	{
		$this->action=$action;
	}

	public function getAction()
	{
		return $this->action;
	}
	
	public function setCode($code)
	{
		$this->code=$code;
	}
	public function getCode()
	{
		return $this->code;
	}
}