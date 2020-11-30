<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Home extends MY_Controller
{
    public function viewOfficerDashboard()
    {
        $data['dashboardcontent'] = $this->load->view('dashboardcontent', $this->loadDashboardReport(), TRUE);
        $this->load->view('officer_dashboard',$data);
    }
    public function viewAdminDashboard()
    {
        if($this->session->userdata('url')==="viewAdminDashboard"){
            $data['dashboardcontent'] = $this->load->view('dashboardcontent', $this->loadDashboardReport(), TRUE);
            $this->load->view('admin_dashboard',$data);
        }
    }
    public function logout()
	{
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('url');
		$this->session->sess_destroy();
        redirect(base_url());
	}

    private function loadDashboardReport(){
		$this->load->model('Dashboard_Model');
		$data['totalDrivers'] = $this->Dashboard_Model->getTotalDrivers();
		$data['totalSuppliers'] = $this->Dashboard_Model->getTotalSuppliers();//
		$data['visitsRegistered'] = $this->Dashboard_Model->getLW_visitsRegistered();
		$data['visitsCompleted'] = $this->Dashboard_Model->getLW_visitsCompleted();
		$data['teabagsCollected'] = $this->Dashboard_Model->getLW_teabagsCollected();
		$data['teaWeightCollected'] = $this->Dashboard_Model->getLW_teaWeightCollected();
		
		return $data;
	}
}
