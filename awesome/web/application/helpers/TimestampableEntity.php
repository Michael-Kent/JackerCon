<?php

trait timestampableEntity
{
	private $createdAt;
	private $updatedAt;
	
	public function updateTimestamps()
	{
		if (!$this->createdAt) {
			$this->createdAt = new DateTime();
		}

		$this->updatedAt = new DateTime();
	}

	public function getCreatedAt()
	{
		if (!$this->createdAt) {
			$this->updateTimestamps();
		}

		return $this->createdAt;
	}

	public function setCreatedAt($at)
	{
		$this->createdAt=$at;
	}

	public function getUpdatedAt()
	{
		if (!$this->updatedAt) {
			$this->updateTimestamps();
		}

		return $this->updatedAt;
	}
	public function setUpdatedAt($at)
	{
		$this->updatedAt=$at;
	}

}