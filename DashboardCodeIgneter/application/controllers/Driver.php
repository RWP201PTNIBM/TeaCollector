<?php
class Driver extends CI_controller
{
    public function driver_registration()
    {    
    	      
        $this->load->model('Driver_Model');
        $paths=$this->Driver_Model->get_paths_names();
        $this->load->view('driver_registration',['paths'=>$paths]);
              
    }
    public function driver_registration_validation()
    {
        $this->load->model('Driver_Model');
        $this->form_validation->set_rules('driver_name', 'Driver Name', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required|regex_match[/^[0-9]{10}$/]|callback_isPhoneExist');
        $this->form_validation->set_rules('NIC', 'NIC', 'required|callback_isNicExist');
        $this->form_validation->set_rules('user_name', 'User Name', 'required|callback_isUserNameExist');
        $this->form_validation->set_rules('license_no', 'Licence No', 'required|callback_isLisenceNoExist');
        $this->form_validation->set_rules('vehicle_no', 'Vehicle No', 'required|callback_isVehicleNoExist');
        $this->form_validation->set_rules('paths', 'Path', 'callback_checkDefault');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('re_password', 'Confirm Password', 'required|min_length[8]|matches[password]');


    if ($this->form_validation->run()) {
           
     
       $array=array(
        'success'=>
        $Driver['name']=$this->input->post('driver_name'),
        $Driver['nic']=$this->input->post('NIC'),
        $Driver['username']=$this->input->post('user_name'),
        $Driver['password']=$this->input->post('password'),
        $Driver['license_no']=$this->input->post('license_no'),
        $Driver['vehicle_no']=$this->input->post('vehicle_no'),
        $Driver['phone']=$this->input->post('phone'),
        $Driver['path_id']=$this->input->post('paths'),
        //$Account['emp_no']=intval($this->Officer_Model->get_new_employee_id())+1;
        $this->Driver_Model->addDriver($Driver));
       }
        else {
            
                  $array =array(
                      'error'=>true,
                      'driver_name_error'=>form_error('driver_name'),
                      'phone_error'=>form_error('phone'),
                      'NIC_error'=>form_error('NIC'),
                      'user_name_error'=>form_error('user_name'),
                      'license_no_error'=>form_error('license_no'),
                      'vehicle_no_error'=>form_error('vehicle_no'),
                      'paths_error'=>form_error('paths'),
                      'password_error'=>form_error('password'),
                      're_password_error'=>form_error('re_password')


                     ); 
        }
        echo json_encode($array);
    }
    public function isPhoneExist($phone) {
        $this->load->model('Driver_Model');
        $is_exist = $this->Driver_Model->isPhoneExist($phone);
    
        if ($is_exist) {
            $this->form_validation->set_message(
                'isPhoneExist', 'Phone Number already exist.'
            );    
            return false;
        } else {
            return true;
        }
    }
    public function isNicExist($nic) {
        $this->load->model('Driver_Model');
        $is_exist = $this->Driver_Model->isNicExist($nic);
    
        if ($is_exist) {
            $this->form_validation->set_message(
                'isNicExist', 'NIC is already exist.'
            );    
            return false;
        } else {
            return true;
        }
    }
    public function isUserNameExist($user_name) {
        $this->load->model('Driver_Model');
        $is_exist = $this->Driver_Model->isUserNameExist($user_name);
    
        if ($is_exist) {
            $this->form_validation->set_message(
                'isUserNameExist', 'User Name is already exist.'
            );    
            return false;
        } else {
            return true;
        }
    }
    public function isLisenceNoExist($license) {
        $this->load->model('Driver_Model');
        $is_exist = $this->Driver_Model->isLisenceNoExist($license);
    
        if ($is_exist) {
            $this->form_validation->set_message(
                'isLisenceNoExist', 'Lisence Number is already exist.'
            );    
            return false;
        } else {
            return true;
        }
    }
    public function isVehicleNoExist($vehicle) {
        $this->load->model('Driver_Model');
        $is_exist = $this->Driver_Model->isVehicleNoExist($vehicle);
    
        if ($is_exist) {
            $this->form_validation->set_message(
                'isVehicleNoExist', 'Vehicle Number is already exist.'
            );    
            return false;
        } else {
            return true;
        }
    }
    
    function checkDefault()
{
  $this->input->post('paths');
  if( $this->input->post('paths')==0)
  {
    $this->form_validation->set_message(
        'checkDefault', 'please select the path'
    );
    return  false;    
  }
  else{
      return true;
  }
}
    


}