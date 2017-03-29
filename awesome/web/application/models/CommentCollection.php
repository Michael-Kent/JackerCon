<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 
class CommentCollection extends CI_Model
{
    private $comments = array();
    
	public function __construct()
    {
		parent::__construct();
	}
 
    public function add($comment)
    {
        if (!isset($this->comments[$comment->id])) {
            $this->comments[$comment->id] = $comment;
        }
    }
 
    public function remove($comment)
    {
        if (isset($this->comments[$comment->id])) {
            unset($this->comments[$comment->id]);
        }
    }
 
    public function getChildById($id)
    {
        return isset($this->comments[$id]) ? $this->comments[$id] : null;
    }
	
	public function toJson()
	{
		$result=array();
		foreach ($this->comments as $comment) {
			$result[]=$comment->toArray();
		}
		return json_encode($result);
	}
	
	public function toArray()
	{
		$result=array();
		foreach ($this->comments as $comment) {
			$result[]=$comment->toArray();
		}
		return $result;
	}
	
	public function count()
	{
		return count($this->comments);
	}
}