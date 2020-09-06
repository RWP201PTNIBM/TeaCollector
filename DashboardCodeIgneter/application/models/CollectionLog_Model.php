<?php
class CollectionLog_Model extends CI_model
{
    function getCollectionLog()
	{   
		//return $this->db->get('collection_log')->result_array();
		$this->db->select('date(cl.date),time(cl.date),s.supplier_name,cl.weight,cl.no_of_bags,d.name');
		$this->db->from('collection_log cl');
        $this->db->join('supplier s', 'cl.supplier_id = s.supplier_id');
        $this->db->join('visit v', 'cl.visit_id = v.visit_id');
        $this->db->join('driver d', 'v.driver_id = d.driver_id');   
		return $this->db->get()->result_array();
	}
}