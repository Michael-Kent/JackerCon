<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GameObject extends CI_Model
{
	private $id;
	private $hostId;
	private $hostName;
	private $name;
	private $system;
	private $description;
	private $playerInfo;
	private $timestampStart;
	private $timestampFinish;
	private $players;
	private $comments;
	private $maxPlayers;
	private $hostingPlatform;
	private $imageUrl;
	private $isPublic=1;
	private $isLive=1;
	
	public function toArray()
	{
		$array=array();
		
		$array['id']=$this->id;
		$array['hostId']=$this->hostId;
		$array['hostName']=$this->hostName;
		$array['name']=$this->name;
		$array['system']=$this->system;
		$array['description']=$this->description;
		$array['timestampStart']=$this->timestampStart;
		$array['timestampFinish']=$this->timestampFinish;
		$array['players']=$this->players->toArray();
		$array['comments']=$this->comments->toArray();
		$array['maxPlayers']=$this->maxPlayers;
		$array['hostingPlatform']=$this->hostingPlatform;
		$array['isPublic']=$this->isPublic;
		$array['isLive']=$this->isLive;
		$array['playerInfo']=$this->playerInfo;
		$array['imageUrl']=$this->imageUrl;
		
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
	
	public function setHostID($hostId)
	{
		$this->hostId=$hostId;
	}

	public function getHostID()
	{
		return $this->hostId;
	}
	
	public function setHostName($hostName)
	{
		$this->hostName=$hostName;
	}

	public function getHostName()
	{
		return $this->hostName;
	}
	
	public function setName($name)
	{
		$this->name=$name;
		return $this->name!=null;
	}

	public function getName()
	{
		return $this->name;
	}
	
	public function setSystem($system)
	{
		$this->system=$system;
		return $this->system!=null;
	}

	public function getSystem()
	{
		return $this->system;
	}
	
	public function setDescription($description)
	{
		$this->description=strip_tags($description,'<br><b><i><p>');
		return $this->description!=null;
	}

	public function getDescription()
	{
		return nl2br($this->description);
	}
	
	public function setTimestampStart($timestampStart)
	{
		$this->timestampStart=$timestampStart;
		return $this->timestampStart!=null;
	}

	public function getTimestampStart()
	{
		return $this->timestampStart;
	}
	
	public function setTimestampFinish($timestampFinish)
	{
		$this->timestampFinish=$timestampFinish;
		return $this->timestampFinish!=null;
	}

	public function getTimestampFinish()
	{
		return $this->timestampFinish;
	}
	
	public function setPlayers($players)
	{
		$this->players=$players;
	}

	public function getPlayers()
	{
		return $this->players;
	}
	
	
	public function setComments($comments)
	{
		$this->comments=$comments;
	}

	public function getComments()
	{
		return $this->comments;
	}
	
	public function setMaxPlayers($maxPlayers)
	{
		$this->maxPlayers=$maxPlayers;
		return $this->maxPlayers!=null;
	}

	public function getMaxPlayers()
	{
		return $this->maxPlayers;
	}
	
	public function setPlayerInfo($playerInfo)
	{
		$this->playerInfo=strip_tags($playerInfo,'<br><b><i><p>');
		return $this->playerInfo!=null;
	}

	public function getPlayerInfo()
	{
		return nl2br($this->playerInfo);
	}
	
	public function setImageUrl($imageUrl)
	{
		$this->imageUrl=$imageUrl;
		return true;//default
	}

	public function getImageUrl()
	{
		return $this->imageUrl;
	}
	
	public function setHostingPlatform($hostingPlatform)
	{
		$this->hostingPlatform=$hostingPlatform;
		return $this->hostingPlatform!=null;
	}

	public function getHostingPlatform()
	{
		return $this->hostingPlatform;
	}
	
	public function setIsLive($isLive)
	{
		$this->isLive=$isLive;
		return $this->isLive!=null;
	}

	public function getIsLive()
	{
		return $this->isLive;
	}
	
	public function hide()
	{
		$this->isPublic=false;
	}

	public function unhide()
	{
		$this->isPublic=true;
	}
	
	public function isPublic()
	{
		return $this->isPublic;
	}

}