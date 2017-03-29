<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class CommentRepository extends CI_Model
{
	function __construct(){
		parent::__construct();
		$this->load->model('CommentFactory');
		$this->load->model('CommentCollection');
		$this->load->database();
		date_default_timezone_set('Europe/London');
	}
	
	public function loadCollectionFromGameID($gameID){
		$collection=new $this->CommentCollection();
		$this->db->from('comments');
		$this->db->join('games-comments','comments.id = games-comments.comment_id','left');
		$this->db->where(array('games-comments.game_id'=>$gameID));
		$query = $this->db->get();
		$res = $query->result();
		
		foreach ($res as $row) {
				$collection->add(
					$this->CommentFactory->setCommentFromResults($row)
				);
			}
		return $collection;
	}
	
	public function loadCollectionFromProfileID($profileID){
		$collection=new $this->CommentCollection();
		$this->db->from('comments');
		$this->db->join('profile-comments','comments.id = profile-comments.comment_id','left');
		$this->db->where(array('profile-comments.account_id'=>$profileID));
		$query = $this->db->get();
		$res = $query->result();
		
		foreach ($res as $row) {
				$collection->add(
					$this->CommentFactory->setCommentFromResults($row)
				);
			}
		return $collection;
	}
	
	public function updateComment($comment){
		$this->db->update('comments', $comment->toDBArray());
	}
	
	public function insertComment($comment){
		$this->db->insert('comments', $comment->toDBArray());
		if($comment->target_id!==null)
			$this->db->insert($comment->target_table, array($comment->target_feild=>$comment->target_id,'comment_id'=>$this->db->insert_id()));
	}
	
	public function deleteComment($comment){
		$this->db->delete($comment->target_table,array('comment_id'=>$comment->id));
		$this->db->delete('comments', array('id' => $comment->getID())); 
	}
}
	