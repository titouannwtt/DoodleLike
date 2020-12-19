<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Participant extends CI_Model

{
    protected $table = 'Participant';

		public function add($poll, $user)
		{
      return   $this->db->set('idPoll', $poll)
                    ->set('idUser',  $user)
										->insert($this->table);
    }

    public function getId($poll, $user)
    {
    	$this->db->select('isParticipant');
			$this->db->from($this->table);
			$this->db->where('idPoll', $poll);
			$this->db->where('idUser', $user);
			return $this->db->get()->result();

    }
		


		public function getNewParticipants($poll)
		{
			$sql = "select login from User where login not in (select idUser from Participant where idPoll = ?)";
			return $this->db->query($sql, $poll)->result();
		}

		public function getParticipants($poll)
		{
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('idPoll', $poll);
			return $this->db->get()->result();
		}

		public function checkParticipant($user)
		{
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('idUser', $user);
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

		public function getPolls($idUser)
		{
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('idUser', $idUser);
			return $this->db->get()->result();
		}

	
	public function remove($poll, $idUser)
	{
		$this->db->query("DELETE FROM $this->table WHERE idPoll = '".$poll."'and idUser = '".$idUser."'");
	}
}
