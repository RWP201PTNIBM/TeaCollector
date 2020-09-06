<?php
class Visit extends CI_Controller
{
    public function viewAllVisits()
    {
        $this->load->model('Visit_Model');
          $logs=$this->Visit_Model->getAllVisits();
          $data=array();
          $data['logs']=$logs;
          $this->load->view('manage_visits',$data);
    }
    public function deleteVisit($visitId)
    {
        $this->load->model('Visit_Model');
        $this->Visit_Model->deleteVisit($visitId);
        redirect(base_url().'visit/viewAllVisits');
    }
}