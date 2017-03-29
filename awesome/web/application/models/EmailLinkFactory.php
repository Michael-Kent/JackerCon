<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailLinkFactory extends CI_Model
{
 
    public function __construct()
    {
		parent::__construct();
		$this->load->model('EmailLink'); 
    }
 
    public function createEmailLink()
    {
        $emailLink= new $this->EmailLink();
		$emailLink->setCode($this->Security->createRandomCode());
		return $emailLink;
    }
	
	public function setEmailLinkFromResults($row)
	{
		$emailLink=new $this->EmailLink();
		
		$emailLink->setID($row->ID);
		$emailLink->setAccountID($row->accountID);
		$emailLink->setAction($row->action);
		$emailLink->setCode($row->code);
		
		return $emailLink;
	}
}