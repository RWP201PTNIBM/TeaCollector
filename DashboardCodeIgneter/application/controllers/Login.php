<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

	
    }	
		
    public function viewLogin()
    {
        $this->load->view('login');
    }
	public function login_validations()
    {   $this->load->model('Login_Model');
        $this->form_validation->set_rules('email', 'Email', 'required|callback_isValidEmail|callback_isActiveAcc');
        $this->form_validation->set_rules('password', 'Password', 'required|callback_isPassNotMatched');
        if ($this->form_validation->run()==false) {
            $this->load->view('login');
         
		} else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $row=$this->Login_Model->login($email,$password);
            if ($row) {
                $accType=$this->Login_Model->getType($email);
                $array1 = json_decode(json_encode($accType[0]),true);

              
               if($array1['acc_type']=='OFFICER')
                {
					$this->session->set_userdata('name', $email);
					$this->session->set_userdata('url', 'viewOfficerDashboard');
                    redirect(base_url().'home/viewOfficerDashboard');
              
                }
               else if($array1['acc_type']=='ADMIN')
               {
					$this->session->set_userdata('name', $email);
					$this->session->set_userdata('url', 'viewAdminDashboard');  
                    redirect(base_url().'home/viewAdminDashboard');
                }
              
           }
		}

		
    }
   
    public function isPassNotMatched()
    {
        $this->load->model('Login_Model');
        $email = $this->input->post('email');
		$password = $this->input->post('password');
        $is_exist=$this->Login_Model->passNotMatched($email,$password);
        if ($is_exist) {
           return true;
        } 
        else {
            $this->form_validation->set_message(
                'isPassNotMatched', 'Invalid Password'
            );    
            return false;
          }


    }
    public function forgot_password()
	{   
		$this->load->view('forgot_password');
	}
	public function forget_Recorrect()
	{
		$this->load->view('Forget_Recorrect');
	}

	public function resetlink()
	{   $this->form_validation->set_rules('email', 'Email', 'required|callback_isValidEmail');
		
		if($this->form_validation->run()==false)
		{
			$this->load->view('forgot_password');
		}
		else{ 
			    $email = $this->input->post('email');
				$tokan = rand(1000, 9999);
				$this->db->query("update officer set password='" . $tokan . "' where email='" . $email . "'");
				$message = "Please Click on Password Reset Link <a href='" . base_url('login/reset?tokan=') . $tokan . "'> Reset Password </a>";
	
	
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
					$this->session->set_flashdata('forgetpass', '<div class="alert alert-success text-center">Recorrect Password link sent to Your Email </div>');
					 redirect(base_url().'login/forgot_password');
				
					return true;
				} else {
					$this->session->set_flashdata('verify', '<div class="alert alert-danger text-center">Email address is not confirmed. Please try to re-register.</div>');
					echo "email send failed";
					return false;
				}

		}
	
	
}
public function isValidEmail()
{
	$this->load->model('Login_Model');
	$email = $this->input->post('email');
	$is_exist=$this->Login_Model->validEmail($email);
	if ($is_exist) {
		return true;
	 } 
	 else {
		 $this->form_validation->set_message(
			 'isValidEmail', 'Invalid Email'
		 );    
		 return false;
	   }


}
public function isActiveAcc()
{
	$this->load->model('Login_Model');
	$email = $this->input->post('email');
	$is_active=$this->Login_Model->activeAcc($email);
	if ($is_active) {
		return true;
	 } 
	 else {
		 $this->form_validation->set_message(
			 'isActiveAcc', 'This account is not activated by the user'
		 );    
		 return false;
	   }


}
 
	public function reset()
	{
		$data['tokan'] = $this->input->get('tokan');
		$_SESSION['tokan'] = $data['tokan'];
		$this->load->view('Forget_Recorrect');
	}
	public function updatepass()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("password", "Password", 'required');
		$this->form_validation->set_rules("cpassword", "Cpassword", 'required|matches[password]');
		if ($this->form_validation->run()==false) {
			$this->load->view('Forget_Recorrect');
		} else {
			$_SESSION['tokan'];
			$data = $this->input->post();
			if ($data['password'] == $data['cpassword']) {
				$this->db->query("update officer set password='" . $data['password'] . "' where password='" . $_SESSION['tokan'] . "'");
			}
			$this->load->view('login');
		}
	}
}
