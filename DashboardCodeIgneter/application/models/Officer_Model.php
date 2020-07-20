<?php
class Officer_Model extends CI_model
{

    function addOfficer($employee, $account)
    {

        $this->db->trans_begin();

        $this->db->insert('employee', $employee);
        $this->db->insert('account', $account);
        // $this->db->insert('officer', $officer);         

        if ($this->db->trans_status() == false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }
    function isNicExist($nic)
    {
        $this->db->select('emp_no');
        $this->db->where('nic_no', $nic);
        $query = $this->db->get('employee');

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    function isUserNameExist($user_name)
    {
        $this->db->select('emp_no');
        $this->db->where('user_name', $user_name);
        $query = $this->db->get('account');

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    function get_new_employee_id()
    {
        $result = $this->db->query("SELECT emp_no FROM employee WHERE emp_no = (SELECT max(emp_no) FROM employee)")->result();
        if (count($result) > 0) {
            return $result[0]->emp_no;
        }
        return 0;
    }
    //send confirm mail
    public function sendEmail($receiver)
    {
        $from = "zshtmad@gmail.com";    //senders email address
        $subject = 'Verify email address';  //email subject

        //sending confirmEmail($receiver) function calling link to the user, inside message body
        $message = 'Dear User,<br><br> Please click on the below activation link to verify your email address<br><br>
         <a href=\'http://www.localhost/DashboardCodeIgneter/Officer/confirmEmail/' . md5($receiver) . '\'>http://www.localhost/DashboardCodeIgneter/Officer/confirmEmail/' . md5($receiver) . '</a><br><br>Thanks';



        //config email settings
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = $from;
        $config['smtp_pass'] = 'waste1234';  //sender's password
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = 'TRUE';
        $config['newline'] = "\r\n";

        $this->load->library('email', $config);
        $this->email->initialize($config);
        //send email
        $this->email->from($from);
        $this->email->to($receiver);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            //for testing
            // echo "sent to: " . $receiver . "<br>";
            // echo "from: " . $from . "<br>";
            // echo "protocol: " . $config['protocol'] . "<br>";
            // echo "message: " . $message;
            return true;
        } else {
            echo "email send failed";
            return false;
        }
    }
    //activate account
    function verifyEmail($key)
    {
        $account = array('status' => 1);
        $this->db->where('md5(email)', $key);             // this code use for 
        return $this->db->update('account', $account);    //update status as 1 to make active user
    }
}
