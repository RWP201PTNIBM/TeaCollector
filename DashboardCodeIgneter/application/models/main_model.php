<?php
class main_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function insert_data($data)
    {
        return $this->db->insert("usertest", $data);
    }
    //send confirm mail
    public function sendEmail($receiver)
    {
        $from = "zshtmad@gmail.com";    //senders email address
        $subject = 'Verify email address';  //email subject

        //sending confirmEmail($receiver) function calling link to the user, inside message body
        $message = 'Dear User,<br><br> Please click on the below activation link to verify your email address<br><br>
            <a href=\'http://www.localhost/DashboardCodeIgneter/Welcome/confirmEmail/' . md5($receiver) . '\'>http://www.localhost/DashboardCodeIgneter/Welcome/confirmEmail/' . md5($receiver) . '</a><br><br>Thanks';



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
        $data = array('status' => 1);
        $this->db->where('md5(email)', $key);
        return $this->db->update('usertest', $data);    //update status as 1 to make active user
    }
}
