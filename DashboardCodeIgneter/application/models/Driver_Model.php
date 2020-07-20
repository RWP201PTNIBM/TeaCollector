<?php
class Driver_Model extends CI_model
{
	function addDriver()
	{


	}
	function get_paths_names() { 
		// $query = $this->db->select('path_name')->from('path')->get();
		//  $path_name = array();
		// foreach ($query->result_array() as $row)
		// {
  //         $path_name[]=$row;
		// }
		// return $path_name;
		$query=$this->db->get('path');
		if($query->num_rows()>0)
		{
			return $query->result();
		}

    }
}