<?php
class Supplier extends MY_Controller
{
    public function supplier_registration()
    {
        $this->load->model('Supplier_Model');
        $paths=$this->Supplier_Model->get_paths_names();
        $data=array();
        $data['paths']=$paths;
        $this->load->view('supplier_registration',$data);
    }
    public function getCollectionPoints(){
        $this->load->model('Supplier_Model');
        $points = array();
        $path_id = $this->input->post('path_id');
       
        if($path_id){
            $con['conditions'] = array('path_id'=>$path_id);
            $points = $this->Supplier_Model->getPointRows($con);
        }
        echo json_encode($points);
    }
    function supplier_registration_validation()
    {
        $this->load->model('Supplier_Model');
        $this->form_validation->set_rules('supplier_name', 'Supplier Name', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required|regex_match[/^[0-9]{10}$/]|callback_isPhoneExist');
        $this->form_validation->set_rules('paths', 'Path', 'callback_checkDefaultPath');
        $this->form_validation->set_rules('points', 'Collection Point', 'callback_checkDefaultPoint');


        if ($this->form_validation->run()) {
            $Supplier['supplier_name'] = $this->input->post('supplier_name');
            $Supplier['supplier_address'] = $this->input->post('address');
            $Supplier['supplier_phone'] = $this->input->post('phone');
            // $Supplier['path_id'] =  $this->input->post('paths');
            $Supplier['cp_id'] =  $this->input->post('points');
            $this->Supplier_Model->addSupplier($Supplier);
            
           
            $array=array(
                'success'=> '<div class="alert alert-success">New Supplier Added Successfully..</div>'
            );
           
        } else {

            $array =array(
                'error'=>true,
                'supplier_name_error'=>form_error('supplier_name'),
                'address_error'=>form_error('address'),
                'phone_error'=>form_error('phone'),
                'paths_error'=>form_error('paths'),
                'points_error'=>form_error('points')
               ); 
           
        }
        echo json_encode($array);
    }
    public function isPhoneExist($phone) {
        $this->load->model('Supplier_Model');
        $is_exist = $this->Supplier_Model->isPhoneExist($phone);
    
        if ($is_exist) {
            $this->form_validation->set_message(
                'isPhoneExist', 'Phone Number already exist.'
            );    
            return false;
        } else {
            return true;
        }
    }
    function checkDefaultPath()
    {
      
      if( $this->input->post('paths')==0)
      {
        $this->form_validation->set_message(
            'checkDefaultPath', 'please select the path'
        );
        return  false;    
      }
      else{
          return true;
      }
    }
    function checkDefaultPoint()
    {
      
      if( $this->input->post('points')==0)
      {
        $this->form_validation->set_message(
            'checkDefaultPoint', 'please select the collection point'
        );
        return  false;    
      }
      else{
          return true;
      }
    }
    function viewAllSuppliers()
  {
    $this->load->model('Supplier_Model');
    $suppliers=$this->Supplier_Model->getAllSuppliers();
    $data=array();
    $data['suppliers']=$suppliers;
    $this->load->view('manage_suppliers',$data);


  }
  function editSupplier($supplierId)
  {
    $this->load->model('Supplier_Model');
    $supplier=$this->Supplier_Model->getSupplier($supplierId);
    $paths=$this->Supplier_Model->get_paths_except_default($supplierId);
    $defaultPath=$this->Supplier_Model->get_default_path($supplierId);
    $points=$this->Supplier_Model->get_points_except_default($supplierId);
    $defaultPoint=$this->Supplier_Model->get_default_point($supplierId);
    $data=array();
    $data['supplier']=$supplier;
    $data['paths']=$paths;
    $data['dpaths']=$defaultPath;
    $data['points']=$points;
    $data['dpoints']=$defaultPoint;
  
    $this->load->view('edit_supplier',$data);

  }
  function editSupplierValidations($supplierId)
  {
    $this->load->model('Supplier_Model');
    $this->form_validation->set_rules('supplier_name', 'Supplier Name', 'required');
    $this->form_validation->set_rules('address', 'Address', 'required');
    $this->form_validation->set_rules('phone', 'Phone', 'required|regex_match[/^[0-9]{10}$/]|callback_isEditPhoneExist');
    $this->form_validation->set_rules('paths', 'Path', 'callback_checkDefaultPath');
    $this->form_validation->set_rules('points', 'Collection Point', 'callback_checkDefaultPoint');
  


if ($this->form_validation->run()) {

    $Supplier['supplier_name']=$this->input->post('supplier_name');
    $Supplier['supplier_address']=$this->input->post('address');
    $Supplier['supplier_phone']=$this->input->post('phone');
    // $Supplier['path_id']=$this->input->post('paths');
    $Supplier['cp_id']=$this->input->post('points');
    //$Account['emp_no']=intval($this->Officer_Model->get_new_employee_id())+1;
    $this->Supplier_Model->updateSupplier($supplierId,$Supplier);
    $array=array('success'=>true);
   }
    else {
        
              $array =array(
                  'error'=>true,
                  'supplier_name_error'=>form_error('supplier_name'),
                  'address_error'=>form_error('address'),
                  'phone_error'=>form_error('phone'),
                  'paths_error'=>form_error('paths'),
                  'points_error'=>form_error('points')


                 ); 
    }
    echo json_encode($array);
  }
  public function isEditPhoneExist($phone) {
    $supplierId=$this->input->post('supplier_id');
    $this->load->model('Supplier_Model');
    $is_exist = $this->Supplier_Model->isEditPhoneExist($supplierId,$phone);

    if ($is_exist) {
        $this->form_validation->set_message(
            'isEditPhoneExist', 'Phone Number already exist.'
        );    
        return false;
    } else {
        return true;
    }
}
  function deleteSupplier($supplierId)
  {
    $this->load->model('Supplier_Model');
    $this->Supplier_Model->deleteSupplier($supplierId);
    redirect(base_url().'supplier/viewAllSuppliers');
  }
}
