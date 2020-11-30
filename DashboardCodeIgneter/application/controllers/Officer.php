<?php
class Officer extends CI_Controller
{
    function officer_registration()
    {
        $this->load->model('Officer_Model');
        $this->load->view('officer_registration');
    }
    public function officer_registration_validation()
    {
       
        $this->load->model('Officer_Model');
        $this->form_validation->set_rules('officer_name', 'Officer Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_isEmailExist');
        $this->form_validation->set_rules('user_name', 'User Name', 'required|callback_isUserNameExist');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('re_password', 'Confirm Password', 'required|min_length[8]|matches[password]');


        if ($this->form_validation->run()) {
            $Officer['name'] = $this->input->post('officer_name');
            $Officer['username'] = $this->input->post('user_name');
            // $Officer['password']=password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            $Officer['password'] = $this->input->post('password');
            $Officer['email'] = $this->input->post('email');
            $Officer['status'] = 0;
            $Officer['acc_type'] = "Officer";
            
            if ($this->Officer_Model->sendEmail($this->input->post('email'))) {
            $this->Officer_Model->addOfficer($Officer);
            } else {
               
                $this->load->view('officer_registration');
            }
            $array=array(
                'success'=> '<div class="alert alert-success">New Officer Added Successfully..</div>'
            );
           
        } else {

            $array =array(
                'error'=>true,
                'officer_name_error'=>form_error('officer_name'),
                'email_error'=>form_error('email'),
                'user_name_error'=>form_error('user_name'),
                'password_error'=>form_error('password'),
                're_password_error'=>form_error('re_password')


               ); 
           
        }
        echo json_encode($array);
    }
    public function isUserNameExist($user_name)
    {
        $this->load->model('Officer_Model');
        $is_exist = $this->Officer_Model->isUserNameExist($user_name);

        if ($is_exist) {
            $this->form_validation->set_message(
                'isUserNameExist',
                'User Name is already exist.'
            );
            return false;
        } else {
            return true;
        }
    }

    public function isEmailExist($email)
    {
        $this->load->model('Officer_Model');
        $is_exist = $this->Officer_Model->isEmailExist($email);

        if ($is_exist) {
            $this->form_validation->set_message(
                'isEmailExist',
                'Email is already exist.'
            );
            return false;
        } else {
            return true;
        }
    }
    function confirmEmail($hashcode)
    {
        $this->load->model('Officer_Model');
        if ($this->Officer_Model->verifyEmail($hashcode)) {
            $this->session->set_flashdata('verify', '<div class="alert alert-success text-center">Email address is confirmed. Please login to the system</div>');
            redirect(base_url().'login/viewLogin');
        } else {
            $this->session->set_flashdata('verify', '<div class="alert alert-danger text-center">Email address is not confirmed. Please try to re-register.</div>');
            redirect(base_url().'login/viewLogin');
        }
    }
    function viewAllOfficers()
    {
        $this->load->model('Officer_Model');
        $officers=$this->Officer_Model->getAllOfficers();
        $data=array();
        $data['officers']=$officers;
        $this->load->view('manage_officers',$data);
    }
    function editOfficer($officerId)
  {
    $this->load->model('Officer_Model');
    $officer=$this->Officer_Model->getOfficer($officerId);
    $data=array();
    $data['officer']=$officer;
    $this->load->view('edit_officer',$data);

  }
  function editOfficerValidations($officerId)
  {
    
    $this->load->model('Officer_Model');
    $this->form_validation->set_rules('officer_name', 'Officer Name', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|callback_isEditEmailExist');
    $this->form_validation->set_rules('user_name', 'User Name', 'required|callback_isEditUserNameExist');
    $this->form_validation->set_rules('password', 'Password', 'min_length[8]');
    $this->form_validation->set_rules('re_password', 'Confirm Password', 'min_length[8]|matches[password]');

   if ($this->form_validation->run()) {
       
        $current_email=$this->input->post('current_email');
        $current_status=$this->input->post('current_status');
        $Officer['name']=$this->input->post('officer_name');
        $Officer['username']=$this->input->post('user_name');
        // $Officer['password']=password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        $pwd = $this->input->post('password');
        if(!empty($pwd))
        {
            $Officer['password']=$this->Officer_Model->getHash($pwd);
        }
        $Officer['email']=$this->input->post('email');
        // $Officer['acc_type']="Officer";
        $Officer['status']=$current_status;

        if($current_email != $Officer['email']){
            if($this->Officer_Model->sendEmail($Officer['email'])) {
                $Officer['status']=0;

                //$Account['emp_no']=intval($this->Officer_Model->get_new_employee_id())+1;
                $this->Officer_Model->updateOfficer($officerId,$Officer);
                
                $array=array(
                    'success'=> true
                );
            }
            
        }
        else {
            //$Account['emp_no']=intval($this->Officer_Model->get_new_employee_id())+1;
            $this->Officer_Model->updateOfficer($officerId,$Officer);
                    
            $array=array(
                'success'=> true
            );
        }
    
   }
    else {
        
              $array =array(
                  'error'=>true,
                  'officer_name_error'=>form_error('officer_name'),
                  'email_error'=>form_error('email'),
                  'user_name_error'=>form_error('user_name'),
                  'password_error'=>form_error('password'),
                  're_password_error'=>form_error('re_password')


                 ); 
    }
    echo json_encode($array);
  }
  public function isEditEmailExist($email) {
    $officerId=$this->input->post('officer_id');
    $this->load->model('Officer_Model');
    $is_exist = $this->Officer_Model->isEditEmailExist($officerId,$email);

    if ($is_exist) {
        $this->form_validation->set_message(
            'isEditEmailExist', 'Email is already exist.'
        );    
        return false;
    } else {
        return true;
    }
}
  public function isEditUserNameExist($user_name) {
    $officerId=$this->input->post('officer_id');
    $this->load->model('Officer_Model');
    $is_exist = $this->Officer_Model->isEditUserNameExist($officerId,$user_name);

    if ($is_exist) {
        $this->form_validation->set_message(
            'isEditUserNameExist', 'User Name is already exist.'
        );    
        return false;
    } else {
        return true;
    }
}
function deleteOfficer($officerId)
{
  $this->load->model('Officer_Model');
  $this->Officer_Model->deleteOfficer($officerId);
  redirect(base_url().'officer/viewAllOfficers');
}
}
