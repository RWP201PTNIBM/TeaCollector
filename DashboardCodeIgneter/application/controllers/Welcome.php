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
	
	public function resetlink()
	{
		$email = $this->input->post('email');
		$resultpass = $this->db->query("select * from usertest where email='" . $email . "'")->result_array();
		if(count($resultpass)>0){



			$tokan = rand(1000,9999);
			$this->db->query("update usertest set password='".$tokan."' where email='" . $email . "'");
			$message = "Please Click on Password Reset Link <a href='" . base_url('Welcome/reset?tokan=') .$tokan. "'> Reset Password </a>";


			$from = "zshtmad@gmail.com";    //senders email address
			$subject = 'reset Password Link';  //email subject	
			//config email settings
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'ssl://smtp.gmail.com';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = $from;
			$config['smtp_pass'] = 'waste1234';  //sender's password
			$config['mailtype'] = 'html';
			$config['charset'] = 'iso-8859-1';
			$config['wordwrap'] = 'TRUE';
			$config['newline'] = "\r\n";
	
			$this->load->library('email', $config);
			$this->email->initialize($config);
			//send email
			$this->email->from($from);
			$this->email->to($email);
			$this->email->subject($subject);
			$this->email->message($message);
	
			if ($this->email->send()) {
				$this->load->view('forgot-password');

				return true;
			} else {
				echo "email send failed";
				return false;
			}

			echo "exists";
		}else{
			$this->session->set_flashdata('message','Email not Regsitered');
			redirect(base_url('forgot_password'));
			// echo "email not regsitered";
		}
	}
	public function reset(){
		$data['tokan'] = $this->input->get('tokan');
		$_SESSION['tokan'] = $data['tokan'];
		$this->load->view('Forget_Recorrect');
	}
	public function updatepass(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules("password", "Password", 'required');
		$this->form_validation->set_rules("cpassword", "Cpassword", 'required|matches[password]');
		if ($this->form_validation->run()) {
		$_SESSION['tokan'];
		$data = $this->input->post();
		if($data['password'] == $data['cpassword']){
			$this->db->query("update usertest set password='".$data['password']."' where password='" .$_SESSION['tokan']. "'");
		}
		$this->load->view('login');
	}
	else{
		echo "Password is Not matched or something went wrong";
	}
	}

}
