<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login_Model extends CI_Model{
    public function login($email,$password){
        $que = $this->db->query("select * from officer where email='" . $email . "' and password=hash_string('" . $password . "') and status = 1");
        return $que->num_rows();
       
     }
    public function getType($email)
    {
        $this->db->select('acc_type');
		$this->db->where('email', $email);
        $query =$this->db->get('officer');
		if($query->num_rows()>0)
		{
			return $query->result();
		}
    }
    public function passNotMatched($email,$password)
    {
        $query =$this->db->query("select name from officer where email='" . $email . "' and password=hash_string('" . $password . "')");
        if($query->num_rows()>0)
		{
            return true;
        }
        else{
           return false;
        }
    }
   public function validEmail($email)
   {
    $this->db->select('name');
    $this->db->where('email', $email);
    $query =$this->db->get('officer');
    if($query->num_rows()>0)
    {
        return true;
    }
    else{
       return false;
    }
   }
   public function activeAcc($email)
   {
    $this->db->select('name');
    $this->db->where('email', $email);
    $this->db->where('status', 1);
    $query =$this->db->get('officer');
    if($query->num_rows()>0)
    {
        return true;
    }
    else{
       return false;
    }
   }
}