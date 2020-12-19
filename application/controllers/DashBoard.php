<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashBoard extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->helper('security'); 
				$this->load->library('form_validation');
				$this->load->library('email');
				$this->load->library('calendar');
				$this->login = NULL;
	}

	private function getLogin()
	{
		return $this->session->userdata('login');
	}

	private function isLoggedIn($login)
	{
		if($this->getLogin() === $login)
		{
			return true;
		}
		return false;
	}

	private function displayHeader($login)
	{
		$data = array('login' => $login);
		$this->load->view('header', $data);
	}

	public function displayDashBoard($login)
	{
		if($this->isLoggedIn($login))
		{
		$this->displayHeader($login);
		
		$this->load->model('poll');
		$this->load->model('participant');
		$data = array('login' => $login, 'polls' => $this->poll->getPolls($login), 'pollsPar' => $this->participant->getPolls($login));
		$this->load->view('DashBoard', $data);
		$this->load->view('footer');
		}
		else
		{
			redirect('DashBoard/index');
		}
	}

	public function displayDashBoardPoll($login, $poll, $creator, $over)
	{
		if($this->isLoggedIn($login))
		{
			$this->displayHeader($login);
			if($creator == true)
			{
				$this->load->model('participant');
				$data = array('login' => $login, 'creator' => $creator, 'poll' => $poll, 'over' => $over, 'participants' => $this->participant->getParticipants($poll));
				$this->load->view('DashBoardPoll', $data);
			}
			else
			{
				$this->load->model('scheduler');
				$data = array('login' => $login, 'poll' => $poll, 'dates' => $this->scheduler->getDate($poll));
				$this->load->view('schedulePoll', $data);
			}
		$this->load->view('footer');
		}
		else
		{
			redirect('DashBoard/index');
		}
	}
}
