<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ParticipantManager extends CI_Controller
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


    public function add($login, $poll)
    {
        $this->displayHeader($login);
        $this->form_validation->set_rules('newParticipants', '"titre requis"', 'trim|required|xss_clean');

        if($this->form_validation->run() == false)
        {
            $this->load->model('user');
            $this->load->model('participant');

            $newParticipants = $this->participant->getNewParticipants($poll);
            $data = array('login' => $login, 'poll' => $poll, 'previousParticipants' => $this->participant->getParticipants($poll), 'users' => $newParticipants);
            $this->load->view('displayNewParticipant', $data);
            $this->load->view('footer');
        }
        else
        {
            $newParticipant = $_POST['newParticipants'];
            $this->load->model('participant');
            $this->participant->add($poll, $newParticipant);
            redirect("ParticipantManager/add/".$login.'/'.$poll);
        }

    }

    public function remove($login, $poll, $idUser)
    {
        $this->load->model('participant');
        $this->participant->remove($poll, $idUser);
        $this->participant->remove($poll, $idUser);
        $this->participant->remove($poll, $idUser);
        $this->participant->remove($poll, $idUser);
        if($login !== $idUser)
        {
            redirect("ParticipantManager/add/".$login.'/'.$poll);
        }
        else
        {   
            redirect("DashBoard/displayDashBoard/".$login);
        }
    }

}