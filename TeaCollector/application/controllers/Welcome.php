<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function index()
	{
		$this->load->view('welcome_message');
	}
    public function officer_registration()
    {

	 $this->load->view('officer_registration');

	}

	 function officer_registration_validation ()
   
   
	{

		$this->form_validation->set_rules('officer_name', 'Officer Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('NIC', 'NIC', 'required');
		$this->form_validation->set_rules('user_name', 'User Name', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
		$this->form_validation->set_rules('re_password', 'Confirm Password', 'required|min_length[8]|matches[password]');


		if ($this->form_validation->run()) {

			$array = array('success' => true);

		}
		else {
			$array = array(
				'error' => true,
				'officer_name_error' => form_error('officer_name'),
				'email_error' => form_error('email'),
				'NIC_error' => form_error('NIC'),
				'user_name_error' => form_error('user_name'),
				'password_error' => form_error('password'),
				're_password_error' => form_error('re_password')
			);

		}
		echo json_encode($array);
	}
}

