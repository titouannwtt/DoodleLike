<?php

class Poll extends CI_Model
{
	protected $table = 'Poll';
	
	protected  function GenerateKey()
	{
		$key = "";
		$charset = "0123456789abcdefghijklmnopqrstuvwxyz";

		for($i = 0; $i < 64; $i++)
		{
			$char = $charset[rand(0,35)];
			$key = $key.$char;
		}
		return $key;
	}

	protected function checkKey($key)
	{
			$this->db->select('idPoll');
			$this->db->from($this->table);
			$this->db->where('idPoll', $key);
			$query = $this->db->get();
			if($query->num_rows() == 0)
			{
				return false;
			}
			else
			{
				return true;
			}
	}	

	public function Add($login, $title, $place, $str)
	{
		$key = "";
		do
		{
			$key = $this->GenerateKey();
		} while($this->checkKey($key));

	 $this->db->set('idPoll', $key)
                    ->set('creator',  $login)
                    ->set('title',      $title)
                    ->set('place', $place)
										->set('description',     $str)
										->set('over', 0)
										->insert($this->table);
		return $key;
	}

	public function update($idPoll, $title, $place, $description)
	{
		$this->db->query("update $this->table set title ='".$title."', place ='".$place."', description = '".$description."'");
	}



	public function getPoll($idPoll)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('idPoll', $idPoll);
		return $this->db->get()->result();
	}

	public function getTitle($idPoll)
	{
		$query = $this->getPoll($idPoll);
		foreach($query as $title)
		{
			return $title->title;
		}
	}
	public function getPlace($idPoll)
	{
		$query = $this->getPoll($idPoll);
		foreach($query as $place)
		{
			return $place->place;
		}
	}
	public function getDescription($idPoll)
	{
		$query = $this->getPoll($idPoll);
		foreach($query as $description)
		{
			return $description->description;
		}
	}


 	public function getPolls($creator)
	{
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('creator', $creator);
			return $this->db->get()->result();
	}

	public function closePoll($poll)
	{
		$this->db->set('over', 1);
		$this->db->where('idPoll', $poll);
		$this->db->update($this->table);
	}	

	public function remove($poll)
	{
		$this->db->query("DELETE FROM $this->table WHERE idPoll = '".$poll."'");
	}
}
