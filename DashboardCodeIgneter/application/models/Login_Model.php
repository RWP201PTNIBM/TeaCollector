<?php
class Login_Model extends CI_Model{
    public function login($email,$password){
        $que = $this->db->query("select * from officer where email='" . $email . "' and password='" . $password . "' and status = 1");
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
        $this->db->select('name');
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query =$this->db->get('officer');
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
}