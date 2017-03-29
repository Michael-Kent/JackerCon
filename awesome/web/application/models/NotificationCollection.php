<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 
class NotificationCollection extends CI_Model
{
    public $notifications = array();
    public $count=0;
	public function __construct()
    {
		parent::__construct();
		$this->load->model('Notification'); 
	}
 
    public function add($notification)
    {
            $this->notifications[$this->count] = $notification;
			$this->notifications[$this->count]->setID($this->count);
			$this->count=$this->count+1;
    }
	public function toArray()
	{
		$result=array();
		foreach ($this->notifications as $notification) {
			$result[]=$notification->toArray();
		}
		return $result;
	}
}