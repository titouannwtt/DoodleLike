<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{
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
		public function getLogin()
	{
		return $this->session->userdata('login');
	}

	public function isLoggedIn($login)
	{
		if($this->getLogin() === $login)
		{
			return true;
		}
		return false;
	}

	public function displayHeader()
	{
		$login = $this->getLogin();
		$data = array('login' => $login);
		$this->load->view('header', $data);
	}


	public function index()
	{
		$this->displayHeader();
		$this->load->view('footer');
	}
}
