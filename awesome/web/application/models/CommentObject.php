<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommentObject extends CI_Model
{
	private $id,$timestamp,$comment,$profile,$target_id,$target_table='games-comments',$target_feild='game_id';
	
	public function toArray()
	{
		$array=array();
		
		$array['id']=$this->id;
		if($this->profile!=null)
			$array['profile_id']=$this->profile->getID();
		$array[$this->target_feild]=$this->target_id;
		if($this->profile!=null)
			$array['profile']=$this->profile->toArray();
		$array['timestamp']=$this->timestamp;
		$array['comment']=$this->comment;
		
		return $array;
	}
	
	public function toDBArray(){
		$array=$this->toArray();
		unset($array['profile']);
		unset($array[$this->target_feild]);
		return $array;
	}
	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}
		return null;
	}

	public function __set($property, $value=null) {
		if (property_exists($this, $property)) {
			$this->$property = $value;
		}
		return $this;
	}
}