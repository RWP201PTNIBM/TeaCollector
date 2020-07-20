<?php
class Officer extends CI_Controller
{
    function officer_registration()
    {

        $this->load->model('Officer_Model');
        $this->form_validation->set_rules('officer_name', 'Officer Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('NIC', 'NIC', 'required|callback_isNicExist');
        $this->form_validation->set_rules('user_name', 'User Name', 'required|callback_isUserNameExist');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('re_password', 'Confirm Password', 'required|min_length[8]|matches[password]');


        if ($this->form_validation->run() == false) {
            $this->load->view('officer_registration');
        } else {
            $Employee['nic_no'] = $this->input->post('NIC');
            $Employee['emp_name'] = $this->input->post('officer_name');
            $Employee['email'] = $this->input->post('email');
            $Account['user_name'] = $this->input->post('user_name');
            $Account['password'] = $this->input->post('password');
            $Account['acc_type'] = "Officer";
            $Account['status'] = 0;
            $Account['emp_no'] = intval($this->Officer_Model->get_new_employee_id()) + 1;
            $this->Officer_Model->addOfficer($Employee, $Account);
            //    redirect(base_url().'welcome');
            if ($this->Officer_Model->sendEmail($this->input->post('email'))) {
                // $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Successfully registered. Please confirm the mail that has been sent to your email. </div>');
                $this->load->view('Welcome/index');
            } else {
                // $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Failed!! Please try again.</div>');
                $this->load->view('officer_registration');
            }
        }
    }
    function confirmEmail($hashcode)
    {
        $this->load->model('Officer_Model');
        if ($this->Officer_Model->verifyEmail($hashcode)) {
            // $this->session->set_flashdata('verify', '<div class="alert alert-success text-center">Email address is confirmed. Please login to the system</div>');
            redirect('Welcome/login');
        } else {
            // $this->session->set_flashdata('verify', '<div class="alert alert-danger text-center">Email address is not confirmed. Please try to re-register.</div>');
            redirect('Welcome/login');
        }
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
    public function isNicExist($nic)
    {
        $this->load->model('Officer_Model');
        $is_exist = $this->Officer_Model->isNicExist($nic);

        if ($is_exist) {
            $this->form_validation->set_message(
                'isNicExist',
                'Nic is already exist.'
            );
            return false;
        } else {
            return true;
        }
    }
}
