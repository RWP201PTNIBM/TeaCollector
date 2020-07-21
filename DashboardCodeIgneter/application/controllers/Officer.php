<?php
class Officer extends CI_Controller
{
    function officer_registration()
    {

        $this->load->model('Officer_Model');
        $this->form_validation->set_rules('officer_name', 'Officer Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_isEmailExist');
        $this->form_validation->set_rules('user_name', 'User Name', 'required|callback_isUserNameExist');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('re_password', 'Confirm Password', 'required|min_length[8]|matches[password]');


        if ($this->form_validation->run() == false) {
            $this->load->view('officer_registration');
        } else {

            $Officer['name'] = $this->input->post('officer_name');
            $Officer['username'] = $this->input->post('user_name');
            $Officer['password'] = $this->input->post('password');
            $Officer['email'] = $this->input->post('email');
            $Officer['status'] = 0;
            $Officer['acc_type'] = "Officer";
            //$Account['emp_no']=intval($this->Officer_Model->get_new_employee_id())+1;
            $this->Officer_Model->addOfficer($Officer);
            if ($this->Officer_Model->sendEmail($this->input->post('email'))) {
                // $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Successfully registered. Please confirm the mail that has been sent to your email. </div>');
                // $this->load->view('Welcome/index');
                redirect(base_url() . 'Welcome/index');
            } else {
                // $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Failed!! Please try again.</div>');
                $this->load->view('officer_registration');
            }
            // redirect(base_url() . 'welcome');
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
            redirect('Welcome/login');
        } else {
            $this->session->set_flashdata('verify', '<div class="alert alert-danger text-center">Email address is not confirmed. Please try to re-register.</div>');
            redirect('Welcome/login');
        }
    }
}
