<?php
class CollectionPoint_Model extends CI_model
{

    function addCollectionPoint($CollectionPoint)
    {
        return $this->db->insert('Collection_Point', $CollectionPoint);
    }
    
    function isNameExist($cp_name)
    {
        $this->db->select('cp_id');
        $this->db->where('cp_name', $cp_name);
        $query = $this->db->get('Collection_Point');

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_paths_names() { 
		
		$query=$this->db->get('path');
		if($query->num_rows()>0)
		{
			return $query->result();
		}

	}
}
