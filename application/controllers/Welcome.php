<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	private $login;

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->helper('form');
        $this->load->helper('security'); 
				$this->load->library('form_validation');
				$this->load->library('email');
				$this->load->library('calendar');
				$this->login = NULL;
	}

 	public function addParticipant($login, $poll)
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
			print_r($newParticipant);
			$this->load->model('participant');
			$this->participant->add($poll, $newParticipant);
			redirect("Welcome/addParticipant/".$login.'/'.$poll);
		}

	}

	public function removeParticipant($login, $poll, $id)
	{
		$this->load->model('participant');
		$this->participant->remove($poll, $id);
		redirect("Welcome/addParticipant/".$login.'/'.$poll);
	}


	}
















}
