<?php
class Visit_Model extends CI_model
{
   function getAllVisits()
   {
    $this->db->select('v.visit_id,v.date,s.supplier_id,s.supplier_name,v.status,cp.cp_name');
    $this->db->from('visit v');
    $this->db->join('supplier s', 'v.supplier_id = s.supplier_id');
    $this->db->join('collection_point cp', 'v.cp_id = cp.cp_id');
    return $this->db->get()->result_array();
   }
   function deleteVisit($visitId)
   {
    $this->db->where('visit_id',$visitId);
    $this->db->delete('visit');
   }

}   