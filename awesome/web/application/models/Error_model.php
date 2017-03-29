<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Error_model extends CI_Model {
	
	private $errorList=array();
	
    function __construct()
    {
        parent::__construct();
		$this->load->model('error');
    }
	
	public function getErrors(){
		return $errorList;
	}
	
	
	
	public function no_error($message='')
	{
		$errorList[]=new $this->error(0,$message);
		
		return array(
		'error_code'=>'0',
		'error_message'=>''.$message
		);	
	}
	public function error($message='')
	{
		$errorList[]=new $this->error(1,$message);
		return array(
		'error_code'=>'1',
		'error_message'=>''.$message
		);	
	}
	public function email_exsists()
	{
		$errorList[]=new $this->error(10,'the email you have used already has an account associated with it.');
		return array(
		'error_code'=>'10',
		'error_message'=>'the email you have used already has an account associated with it.'
		);	
	}
	public function auth_error()
	{
		$errorList[]=new $this->error(11,'please check your password and email.');
		return array(
		'error_code'=>'11',
		'error_message'=>'please check your password and email'
		);	
	}
	public function no_login()
	{
		$errorList[]=new $this->error(12,'you are currently not logged in.');
		return array(
		'error_code'=>'12',
		'error_message'=>'you are currently not logged in.'
		);	
	}
}