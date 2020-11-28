<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard_Model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

	function getTotalDrivers()
	{
		$this->db
			->select('Total_Drivers() as driver_count');
        $query = $this->db->get();
        $result = $query->result_array();

		if ($query->num_rows() > 0) {
			return $result[0]['driver_count'];
        }
        return 0;
    }
    
	function getTotalSuppliers()
	{
		$this->db
			->select('Total_Suppliers() as supplier_count');
            $query = $this->db->get();
            $result = $query->result_array();
    
            if ($query->num_rows() > 0) {
                return $result[0]['supplier_count'];
            }
            return 0;
    }
    
    function getLW_visitsRegistered()
	{
		$this->db
			->select('LW_VisitsRegistered() as visits');
            $query = $this->db->get();
            $result = $query->result_array();
    
            if ($query->num_rows() > 0) {
                return $result[0]['visits'];
            }
            return 0;
    }

    
    function getLW_visitsCompleted()
	{
		$this->db
			->select('LW_VisitsCompleted() as visits');
            $query = $this->db->get();
            $result = $query->result_array();
    
            if ($query->num_rows() > 0) {
                return $result[0]['visits'];
            }
            return 0;
    }

    
    function getLW_teabagsCollected()
	{
		$this->db
			->select('LW_TeabagsCollected() as totalbags');
            $query = $this->db->get();
            $result = $query->result_array();
    
            if ($query->num_rows() > 0) {
                return $result[0]['totalbags'];
            }
            return 0;
    }

    
    function getLW_teaWeightCollected()
	{
		$this->db
			->select('LW_TeaWeightCollected() as totalweight');
            $query = $this->db->get();
            $result = $query->result_array();
    
            if ($query->num_rows() > 0) {
                return $result[0]['totalweight'];
            }
            return 0;
    }
}
