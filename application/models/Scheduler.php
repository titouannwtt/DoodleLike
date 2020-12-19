<?php

class Scheduler extends CI_Model
{
	protected $table = 'Scheduler';

	protected function checkUnique($idPoll, $year, $month, $day,  $hourstart, $minutestart, $hourend, $minuteend)
	{
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('idPoll', $idPoll);
			$this->db->where('year', $year);
			$this->db->where('month', $month);
			$this->db->where('day', $day);
			$this->db->where('hourstart', $hourstart);
			$this->db->where('minutestart', $minutestart);
			$this->db->where('hourend', $hourend);
			$this->db->where('minuteend', $minuteend);
			$query = $this->db->get();
			if($query->num_rows() == 0)
			{
				return true;
			}
			else
			{
				return false;
			}
	}	


	public function Add($idPoll, $year, $month, $day,  $hourstart, $minutestart, $hourend, $minuteend)
	{
		if($this->checkUnique($idPoll, $year, $month, $day, $hourstart, $minutestart, $hourend, $minuteend))
		{
		$this->db->set('idPoll', $idPoll)
										->set('year', $year)
										->set('month', $month)
                    ->set('day',  $day)
                    ->set('hourstart', $hourstart)
                    ->set('minutestart', $minutestart)
										->set('hourend',     $hourend)
										->set('minuteend', $minuteend)
										->insert($this->table);
		}
	}
	
	public function remove($id)
	{
		$this->db->query("DELETE FROM $this->table WHERE idScheduler = $id");
	}

 	public function getDate($poll)
	{
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('idPoll', $poll);
			return $this->db->get()->result();
	}

}
