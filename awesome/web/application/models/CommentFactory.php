<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommentFactory extends CI_Model
{
 
    public function __construct()
    {
		parent::__construct();
		$this->load->model('CommentObject'); 
    }
 
    public function createComment()
    {
		return new $this->CommentObject();
    }
	
	public function setCommentFromResults($row)
	{
		$this->load->model('ProfileRepository');
		$comment=new $this->CommentObject();
		$profile=$this->ProfileRepository->loadFromID($row->profile_id);
		$comment->id=$row->id;
		$comment->timestamp=$row->timestamp;
		$comment->comment=$row->comment;
		if(property_exists($row,'game_id'))
			$comment->target_id=$row->game_id;
		if(property_exists($row,'account_id'))
			$comment->target_id=$row->account_id;
		$comment->profile=$profile;
		
		return $comment;
	}
}