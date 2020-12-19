<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserSession extends CI_Controller
{
	public function getLogin()
	{
		return $this->session->userdata('login');
	}

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
	}

	public function logout()
    {
		$this->session->sess_destroy();
		redirect('Home/index');
	}

	public function inscription()
	{
		$login = $this->getLogin();
		if($login === NULL)
		{
			$this->form_validation->set_rules('login', '"login"', 'trim|required|xss_clean');
			$this->form_validation->set_rules('pass', '"pass"', 'trim|required|xss_clean');
			$this->form_validation->set_rules('pass2', '"pass2"', 'trim|required|xss_clean');
			$this->form_validation->set_rules('lname', '"nom"', 'trim|required|xss_clean');
			$this->form_validation->set_rules('firstname', '"prenom"', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', '"email"', 'trim|required|xss_clean');

			$data = array('login' => $login);
			$this->load->view('header', $data);


		    if ($this->form_validation->run() == FALSE)
		    {
				$this->load->view('formulaire');
		    }
		    else
		    {
	        	$login = $this->input->post('login');
		        $pass = $this->input->post('pass');
		        $pass2 = $this->input->post('pass2');
		        $lname = $this->input->post('lname');
		        $firstname = $this->input->post('firstname');
		        $email = $this->input->post('email');

			    if($pass === $pass2)
				{
					$this->load->model('user');
					$this->user->Add_user($login, $pass, $lname, $firstname, $email);
					
					$this->email->from('Doodle@gmail.com', 'Doodle');
					$this->email->to($email);
					$this->email->subject('Bienvenue');
					$this->email->message("Bienvenue sur Doodle\nVotre login : ".$login."\nAinsi que votre mot de passe : ".$pass);
					$this->email->send();
					redirect('UserSession/connexion');
				}
				else
				{
					echo "Les 2 mots de passe sont différents";
				}
	        }
		$this->load->view('footer');
		}
		else
		{
			redirect('User/connexion');
		}
	}

	public function connexion()
	{	
		$login = $this->getLogin();
		if($login === NULL)
		{
		$this->form_validation->set_rules('login', '"login"', 'trim|required|xss_clean');
  		$this->form_validation->set_rules('pass', '"pass"', 'trim|required|xss_clean');


			if ($this->form_validation->run() == false) 
			{
				$data = array('login' => $login);
				$this->load->view('header', $data);
				$this->load->view('connexion');
				$this->load->view('footer');
			}
			else
			{
				$login = $this->input->post('login');
				$pass  = $this->input->post('pass'); 
				$newdata = array('login'  => $login);
				$this->load->model('user');
				$check = $this->user->Check_user($login, $pass);

				if($check === true)
				{
					$this->session->set_userdata($newdata);
				  $login = $_SESSION['login'];
					redirect("DashBoard/displayDashBoard/".$login);
				}
				else
				{
					redirect('UserSession/connexion');
					echo "Mot de passe invalide";
				}
			}
		}
		else
		{
			redirect('UserSession/connexion');
		}
	}

	public function remove($idLogin)
	{	
		$this->load->model('user');
		$this->user->remove($idLogin);
		$this->logout();
	}


}
