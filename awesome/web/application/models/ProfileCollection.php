<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 
class ProfileCollection extends CI_Model
{
    private $profiles = array();
    
	public function __construct()
    {
		parent::__construct();
	}
 
    public function add($profile)
    {
        if (!isset($this->profiles[$profile->getId()])) {
            $this->profiles[$profile->getId()] = $profile;
        }
    }
 
    public function remove($profile)
    {
        if (isset($this->profiles[$profile->getId()])) {
            unset($this->profiles[$profile->getId()]);
        }
    }
 
    public function getChildById($id)
    {
        return isset($this->profiles[$id]) ? $this->profiles[$id] : null;
    }
	
	public function toJson()
	{
		$result=array();
		foreach ($this->profiles as $profile) {
			$result[]=$profile->toArray();
		}
		return json_encode($result);
	}
	
	public function toArray()
	{
		$result=array();
		foreach ($this->profiles as $profile) {
			$result[]=$profile->toArray();
		}
		return $result;
	}
	
	public function count()
	{
		return count($this->profiles);
	}
}