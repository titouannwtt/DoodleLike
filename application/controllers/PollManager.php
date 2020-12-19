<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PollManager extends CI_Controller
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


 public function setTitle($login, $idPoll = NULL)
	{
		$this->displayHeader($login);
	$this->form_validation->set_rules('title', '"titre requis"', 'trim|required|xss_clean');
		$this->form_validation->set_rules('place', '"endroit"', 'trim|required|xss_clean');
   	$this->form_validation->set_rules('str', '"description"', 'trim|required|xss_clean');


		if ($this->form_validation->run() == false) 
		{
			$this->load->model('poll');
			$title = $this->poll->getTitle($idPoll);
     	$place = $this->poll->getPlace($idPoll);
			$description = $this->poll->getDescription($idPoll);

				$data = array('login' => $login, 'idPoll' => $idPoll, 'title' => $title, 'place' => $place, 'description' => $description);
				$this->load->view('setTitlePoll', $data);
		}
		else
		{
			if(!empty($_POST['edit']))
			{
			$newTitle = $this->input->post('title');
	    $newPlace = $this->input->post('place');
 		  $newDescription = $this->input->post('str');

			$this->load->model('poll');
			if(!isset($idPoll))
			{
			$poll = $this->poll->Add($login ,$newTitle,$newPlace,$newDescription);
			}
			else
			{
				 $this->poll->update($idPoll ,$newTitle,$newPlace,$newDescription);
				$poll = $idPoll;
			}
			redirect("PollManager/setTitle/".$login.'/'.$poll);

			}
			if(!empty($_POST['next']))
			{
				redirect("PollManager/setPropositions/".$login.'/'.$idPoll);
			}
		}

		$this->load->view('footer');
	}

	public function setPropositions($login, $idPoll)
	{
		$this->displayHeader($login);
	
			$this->load->model('proposition');
			$propositions = $this->proposition->get($idPoll);

			$data = array('login' => $login, 'idPoll' => $idPoll, 'propositions' => $propositions);
	    $this->load->view('propositionsPoll', $data);
		
			if(!empty($_POST['next']))
			{
				redirect("PollManager/schedulePoll/".$login.'/'.$idPoll);
			}
			if(!empty($_POST['previous']))
			{
				redirect("PollManager/setTitle/".$login.'/'.$idPoll);
			}
			if(!empty($_POST['submit']))
			{
			$proposition	= $this->input->post('proposition');
			$this->load->model('proposition');
			$this->proposition->Add($idPoll, $proposition);
			redirect("PollManager/setPropositions/".$login.'/'.$idPoll);
			}

		$this->load->view('footer');
	}

	public function removeProposition($login, $idPoll, $proposition)
	{
		$this->load->model('proposition');
		$this->proposition->remove($idPoll, $proposition);
		redirect("PollManager/setPropositions/".$login.'/'.$idPoll);
	}

	public function schedulePoll($login, $poll)
	{
		$this->displayHeader($login);


		$this->form_validation->set_rules('year', '"titre requis"', 'trim|required|xss_clean');


		if ($this->form_validation->run() == false)
		{
			  $this->load->model('scheduler');
				$data = array('login' => $login, 'poll' => $poll, 'dates' => $this->scheduler->getDate($poll));
				$this->load->view('displayDatePoll', $data);
				$this->load->view('footer');
		}
		else
		{
			if(!empty($_POST['submit']))
			{
			$this->load->model('scheduler');
			$year = $_POST['year'];
			$month = $_POST['month'];
			$day = $_POST['day'];
			$hourstart = $_POST['hourstart'];
			$hourend = $_POST['hourend'];
			$minutestart = $_POST['minutestart'];
			$minuteend = $_POST['minuteend'];
			$this->scheduler->add($poll, $year, $month, $day, $hourstart, $minutestart, $hourend, $minuteend);

		$data = array('login' => $login, 'poll' => $poll, 'dates' => $this->scheduler->getDate($poll));
		$this->load->view('displayDatePoll', $data);
		$this->load->view('footer');
			}
			if(!empty($_POST['previous']))
			{
				redirect("ParticipantManager/setPropositions/".$login.'/'.$poll);
			}
			if(!empty($_POST['next']))
			{
				redirect("ParticipantManager/add/".$login.'/'.$poll);
			}
		}
		}

	public function removeSchedule($login, $poll, $id)
	{
		$this->load->model('scheduler');
		$this->scheduler->remove($id);
		redirect("PollManager/schedulePoll/".$login.'/'.'/'.$poll);
	}

	public function close($login, $poll)
	{
		if($this->isLoggedIn($login))
		{
			$this->displayHeader($login);
			$this->load->model('poll');
			$this->poll->closePoll($poll);
			redirect("DashBoard/displayDashBoard/".$login);
		}
		else
		{
			redirect('Home/index');
		}
	}

	public function remove($login, $poll)
	{
		$this->load->model('poll');
		$this->poll->remove($poll);
		redirect("DashBoard/displayDashBoard/".$login);
	}
}
