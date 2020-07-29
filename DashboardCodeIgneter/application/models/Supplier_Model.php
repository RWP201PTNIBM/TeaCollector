<?php
class Supplier_Model extends CI_model
{
    function get_paths_names() { 
		
		$query=$this->db->get('path');
		if($query->num_rows()>0)
		{
			return $query->result();
		}

    }
  
	function getPointRows($params = array()){
        $this->db->select('cp_id,cp_name');
        $this->db->from('collection_point');
        
        //fetch data by conditions
        if(array_key_exists("conditions",$params)){
            foreach ($params['conditions'] as $key => $value) {
                if(strpos($key,'.') !== false){
                    $this->db->where($key,$value);
                }else{
                    $this->db->where($key,$value);
                }
            }
        }
        
        $query = $this->db->get();
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;

        //return fetched data
        return $result;
    }
    function addSupplier($supplier)
    {
        $this->db->insert('supplier',$supplier);
    }
	function isPhoneExist($phone) {
		$this->db->select('supplier_id');
		$this->db->where('supplier_phone', $phone);
		$query = $this->db->get('supplier');
	
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
    }
    function getAllSuppliers()
    {
        return $this->db->get('supplier')->result_array();
    }
    function getSupplier($supplierId)
	{
		$this->db->where('supplier_id',$supplierId);
		return $this->db->get('supplier')->row_array();

    }
    function updateSupplier($supplierId,$formArray)
    {
        $this->db->where('supplier_id',$supplierId);
		$this->db->update('supplier',$formArray);

    }
    function isEditPhoneExist($supplierId,$phone) {
		$this->db->select('supplier_id');
		$this->db->where('supplier_phone', $phone);
		$query = $this->db->get('supplier');
		$id= $query->result_array();
	
		if ($query->num_rows() > 0) {
			if($id[0]['supplier_id']==$supplierId)
			{
				return false;
			}
			else
			{
				return true;
				
			}
			
		}
		else
		{
			return false;
		}
    }
    function deleteSupplier($supplierId)
	{
	  $this->db->where('supplier_id',$supplierId);
	  $this->db->delete('supplier');
	}
}