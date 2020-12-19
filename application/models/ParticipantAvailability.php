<?php

class ParticipantAvailability extends CI_Model
{
	protected $table = 'ParticipantAvailability';


	public function Add($idPoll, $idParticipant, $idScheduler)
	{
	 	$this->db->set('idPoll',  $idPoll)
	 			->set('idParticipant',  $idParticipant)
	 			->set('idScheduler',  $idScheduler)
									->insert($this->table);
	}
}
