<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Error extends CI_Model {
	
	
    function __construct($code=0,$message="")
    {
        parent::__construct();
		
		$this->code=$code;
		$this->message=$message;
    }
	public $code;
	public $message;
	
}