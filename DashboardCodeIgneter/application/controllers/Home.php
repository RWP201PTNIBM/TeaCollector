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
        $this->session->unset_userdata('url');
		$this->session->sess_destroy();
        redirect(base_url().'login/viewLogin');
	}

}
