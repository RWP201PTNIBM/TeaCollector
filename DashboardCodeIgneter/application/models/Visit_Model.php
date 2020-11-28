<?php
class Visit_Model extends CI_model
{
   function getAllVisits()
   {
    $this->db->select('v.visit_id,v.date,s.supplier_id,s.supplier_name,v.status,cp.cp_name');
    $this->db->from('visit v');
    $this->db->join('supplier s', 'v.supplier_id = s.supplier_id');
    $this->db->join('collection_point cp', 'v.cp_id = cp.cp_id');
    $this->db->order_by('v.date', 'DESC');
    return $this->db->get()->result_array();
   }
   function deleteVisit($visitId)
   {
    $this->db->where('visit_id',$visitId);
    $this->db->delete('visit');
   }
   function getPendingVisits()
   {
    $this->db->select('v.visit_id,v.date,s.supplier_id,s.supplier_name,v.status,cp.cp_name');
    $this->db->from('visit v');
    $this->db->join('supplier s', 'v.supplier_id = s.supplier_id');
    $this->db->join('collection_point cp', 'v.cp_id = cp.cp_id');
    $this->db->where('v.status', 0);
    $this->db->order_by('v.date', 'DESC');
    return $this->db->get()->result_array();
   }
   function getSupplierNames()
   {
      $query=$this->db->get('supplier');
		if($query->num_rows()>0)
		{
			return $query->result();
		}
   }
   function addVisit($supplierId)
	{
     
      $this->db->select('d.driver_id');
      $this->db->from('supplier s');
      $this->db->join('collection_point cl', 's.cp_id = cl.cp_id');
      $this->db->join('path p', 'cl.path_id = p.path_id');
      $this->db->join('driver d', 'p.path_id = d.path_id');
      $this->db->where('s.supplier_id', $supplierId);   
      $driverIdArray= $this->db->get()->result();
      $driverId=json_decode(json_encode($driverIdArray[0]),true);
      
      $this->db->select('cp_id');
      $this->db->where('supplier_id', $supplierId);
      $cpIdArray=$this->db->get('supplier')->result();
      $cpId=json_decode(json_encode($cpIdArray[0]),true);
     
      $visit['date']= date('Y-m-d') ;
      $visit['status']=0;
      $visit['driver_id']= $driverId['driver_id'];
      $visit['cp_id']= $cpId['cp_id'];
     
      $visit['supplier_id']=$supplierId;
      $this->db->insert('visit',$visit);
     
      

      
   }
   function existingVisit($supplierId)
   {
      $this->db->select('supplier_id');
      $this->db->where('supplier_id', $supplierId);
      $this->db->where('date', date('Y-m-d'));
      $query=$this->db->get('visit');
      if ($query->num_rows() > 0) {
         return true;
      } else {
         return false;
      }


   }

}   