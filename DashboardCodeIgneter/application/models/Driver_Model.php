<?php
class Driver_Model extends CI_model
{
	function addDriver($driver)
	{
		$this->db->insert('driver',$driver);

	}
	function get_paths_names() { 
		
		$query=$this->db->get('path');
		if($query->num_rows()>0)
		{
			return $query->result();
		}

	}
	function isPhoneExist($phone) {
		$this->db->select('driver_id');
		$this->db->where('phone', $phone);
		$query = $this->db->get('driver');
	
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	function isNicExist($nic) {
		$this->db->select('driver_id');
		$this->db->where('nic', $nic);
		$query = $this->db->get('driver');
	
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	function isUserNameExist($user_name) {
		$this->db->select('driver_id');
		$this->db->where('username', $user_name);
		$query = $this->db->get('driver');
	
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	function isLisenceNoExist($license) {
		$this->db->select('driver_id');
		$this->db->where('license_no', $license);
		$query = $this->db->get('driver');
	
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	function isVehicleNoExist($vehicle) {
		$this->db->select('driver_id');
		$this->db->where('vehicle_no', $vehicle);
		$query = $this->db->get('driver');
	
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	function getAllDrivers()
	{   //$this->db->select('driver_id, name, path_id');
		return $drivers=$this->db->get('driver')->result_array();
	}
	function getDriver($driverId)
	{
		$this->db->where('driver_id',$driverId);
		return $driver=$this->db->get('driver')->row_array();

	}
	function updateDriver($driverId,$formArray)
	{
		$this->db->where('driver_id',$driverId);
		$this->db->update('driver',$formArray);

    
	}
	function isEditNicExist($driverId,$nic) {
		$this->db->select('driver_id');
		$this->db->where('nic', $nic);
		$query = $this->db->get('driver');
	
		$id= $query->result_array();
	
		if ($query->num_rows() > 0) {
			if($id[0]['driver_id']==$driverId)
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
	function isEditPhoneExist($driverId,$phone) {
		$this->db->select('driver_id');
		$this->db->where('phone', $phone);
		$query = $this->db->get('driver');
		$id= $query->result_array();
	
		if ($query->num_rows() > 0) {
			if($id[0]['driver_id']==$driverId)
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
	function isEditUserNameExist($driverId,$user_name)
	{
		$this->db->select('driver_id');
		$this->db->where('username', $user_name);
		$query = $this->db->get('driver');
		$id= $query->result_array();
	
		if ($query->num_rows() > 0) {
			if($id[0]['driver_id']==$driverId)
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
function isEditLisenceNoExist($driverId,$license) {
		$this->db->select('driver_id');
		$this->db->where('license_no', $license);
		$query = $this->db->get('driver');
	    $id= $query->result_array();
	
		if ($query->num_rows() > 0) {
			if($id[0]['driver_id']==$driverId)
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
	function isEditVehicleNoExist($driverId,$vehicle) {
		$this->db->select('driver_id');
		$this->db->where('vehicle_no', $vehicle);
		$query = $this->db->get('driver');
	    $id= $query->result_array();
	
		if ($query->num_rows() > 0) {
			if($id[0]['driver_id']==$driverId)
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
	function deleteDriver($driverId)
	{
	  $this->db->where('driver_id',$driverId);
	  $this->db->delete('driver');
	}
}