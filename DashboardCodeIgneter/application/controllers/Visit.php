<?php
class Visit extends MY_Controller
{
    public function viewAllVisits()
    {
        $this->load->model('Visit_Model');
          $logs=$this->Visit_Model->getAllVisits();
          $data=array();
          $data['logs']=$logs;
          $this->load->view('view_all_visits',$data);
    }
    public function deleteVisit($visitId)
    {
        $this->load->model('Visit_Model');
        $this->Visit_Model->deleteVisit($visitId);
        redirect(base_url().'visit/viewPendingVisits');
    }
    public function viewPendingVisits()
    {
        $this->load->model('Visit_Model');
        $logs=$this->Visit_Model->getPendingVisits();
        $data=array();
        $data['logs']=$logs;
        $this->load->view('cancel_visit',$data);
    }
    public function addVisit()
    {
        $this->load->model('Visit_Model');
        $suppliers=$this->Visit_Model->getSupplierNames();
        $this->load->view('new_visit',['suppliers'=>$suppliers]);
    }
    public function addVisitValidation()
    {
        $this->load->model('Visit_Model');
        $this->form_validation->set_rules('suppliers', 'Supplier', 'callback_checkDefault|callback_isExistingVisit');
        if ($this->form_validation->run()) {
            $this->Visit_Model->addVisit($this->input->post('suppliers'));
            $array=array( 'success'=> '<div class="alert alert-success">New Visit Added Successfully..</div>');
        }else {
            $array =array('error'=>true,'supplier_name_error'=>form_error('suppliers')); 
        }
       echo json_encode($array);

    }
    function checkDefault()
    {
        $this->input->post('suppliers');
        if( $this->input->post('suppliers')==0)
        {
            $this->form_validation->set_message(
                'checkDefault', 'please select the supplier'
            );
            return  false;    
        }
        else{
            return true;
        }
    }
    function isExistingVisit()
    {
        $this->load->model('Visit_Model');
        $is_exist = $this->Visit_Model->existingVisit($this->input->post('suppliers'));

    if ($is_exist) {
        $this->form_validation->set_message(
            'isExistingVisit', 'cannot make a visit to same supplier on same date twice'
        );
        return false;
    } else {
       
        return true;    
    }
    } 
}