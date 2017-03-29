<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Model
{
	public $id;
	public $color='#F0F0F0';
	public $text='';
	
	public function toArray()
	{
		$array=array();
		
		$array['id']=$this->id;
		$array['color']=$this->color;
		$array['text']=$this->text;
		
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
	
	public function setColor($color)
	{
		$this->color=$color;
	}

	public function getColor()
	{
		return $this->color;
	}
	
	public function setText($text)
	{
		$this->text=$text;
	}

	public function getText()
	{
		return $this->text;
	}
}