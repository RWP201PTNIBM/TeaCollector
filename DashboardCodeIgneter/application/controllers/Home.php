<?php

class Home extends CI_Controller
{
    public function viewOfficerDashboard()
    {
        $this->load->view('officer_dashboard');
    }
    public function viewAdminDashboard()
    {
        $this->load->view('admin_dashboard');
    }
    public function logout()
	{
		$this->session->unset_userdata('name');
		$this->session->sess_destroy();
		$this->load->view('login');
	}

}
