<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('email');
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('main_model');
		$this->load->library('email');
	}

	public function index()
	{
		$this->load->view('index');
		// $this->load->view('login');
		// $this->load->view('register');
		// $this->load->view('forgot-password');
		// $this->load->view('buttons');
		// $this->load->view('blank');
		// $this->load->view('cards');
		// $this->load->view('tables');
		// $this->load->view('charts');
		// $this->load->view('utilities-animation');
		// $this->load->view('utilities-border');
		// $this->load->view('utilities-color');
		// $this->load->view('utilities-other');
	}
	public function login()
	{
		$this->load->view('login');
		$username = $this->input->post('username');
		$pass = $this->input->post('pass');
		$que = $this->db->query("select * from usertest where email='" . $username . "' and password='" . $pass . "' and status = 1");
		$row = $que->num_rows();
		if ($row) {
			$this->session->set_userdata('name', $username);
			redirect('');
		} else {
			$data['error'] = "<h3 style='color:red'>Invalid login details</h3>";
		}

		// $this->load->view('login');
	}
	public function register()
	{
		$this->load->view('register');
	}
	public function form_validation()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("first_name", "First Name", 'required');
		$this->form_validation->set_rules("last_name", "Last Name", 'required');
		$this->form_validation->set_rules("email", "Email", 'required');
		$this->form_validation->set_rules("password", "Password", 'required');
		$this->form_validation->set_rules("compassword", "ComPassword", 'required|matches[password]');
		if ($this->form_validation->run()) {
			$this->load->model("main_model");
			$email = $this->input->post('email');
			$data = array("first_name"  => $this->input->post("first_name"), "last_name"  => $this->input->post("last_name"), "email"  => $this->input->post("email"), "password"  => $this->input->post("password"),);
			if ($this->main_model->insert_data($data)) {
				if ($this->main_model->sendEmail($this->input->post('email'))) {
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Successfully registered. Please confirm the mail that has been sent to your email. </div>');
					$this->load->view('register');
				} else {
					$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Failed!! Please try again.</div>');
					$this->load->view('register');
				}
			}
		}
	}
	function confirmEmail($hashcode)
	{
		if ($this->main_model->verifyEmail($hashcode)) {
			$this->session->set_flashdata('verify', '<div class="alert alert-success text-center">Email address is confirmed. Please login to the system</div>');
			redirect('Welcome/login');
		} else {
			$this->session->set_flashdata('verify', '<div class="alert alert-danger text-center">Email address is not confirmed. Please try to re-register.</div>');
			redirect('Welcome/login');
		}
	}

	public function forgot_password()
	{
		// $this->load->view('index');
		// $this->load->view('login');
		// $this->load->view('register');
		$this->load->view('forgot-password');
		// $this->load->view('buttons');
		// $this->load->view('blank');
		// $this->load->view('cards');
		// $this->load->view('tables');
		// $this->load->view('charts');
		// $this->load->view('utilities-animation');
		// $this->load->view('utilities-border');
		// $this->load->view('utilities-color');
		// $this->load->view('utilities-other');
	}
	public function forget_Recorrect()
	{
		$this->load->view('Forget_Recorrect');
	}
}
