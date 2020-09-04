<?php
defined('BASEPATH') or exit('No direct script access allowed');
class CollectionPoint_Model extends CI_model
{

	function addCollectionPoint($CollectionPoint)
	{
		return $this->db->insert('collection_point', $CollectionPoint);
	}

	function isNameExist($cp_name)
	{
		$this->db->select('cp_id');
		$this->db->where('cp_name', $cp_name);
		$query = $this->db->get('collection_point');

		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	function get_paths_names()
	{
		$query = $this->db->get('path');
		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	function all()
	{
		$this->db
			->select('cp.cp_id, cp.cp_name, cp.latitude, cp.longitude, p.path_name')
			->from('collection_point cp')
			->join('path p', 'cp.path_id = p.path_id');
		return $this->db->get()->result_array(); //SELECT cp.cp_id, cp.cp_name, cp.latitude, cp.longitude, p.path_name
												// FROM collection_point
												// WHERE cp.path_id = p.path_id
	}

	function getColletionPoint($cpId)
	{
		$this->db->where('cp_id', $cpId);
		return $this->db->get('collection_point')->row_array();
	}

	function deleteCollectionPoint($cpId)
	{
		$this->db->where('cp_id', $cpId);
		$this->db->delete('collection_point');
	}

	function get_default_path($cpId)
	{
		$this->db->select('path.path_id,path.path_name');
		$this->db->from('path');
		$this->db->join('collection_point', 'path.path_id = collection_point.path_id');
		$this->db->where('collection_point.cp_id', $cpId);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	function get_paths_except_default($cpId)
	{
		$this->db->select('path_id');
		$this->db->where('cp_id', $cpId);
		$subquery = $this->db->get('collection_point')->row_array();

		$this->db->select('path_id,path_name');
		$this->db->where_not_in('path_id', $subquery['path_id']);
		$query = $this->db->get('path');
		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	function get_cps_for_path($pathId)
	{
		$this->db->where('path_id', $pathId);
		$query = $this->db->get('collection_point');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
	}

	function isEditCPNameExist($cpId, $cp_name)
	{
		$this->db->select('cp_id');
		$this->db->where('cp_name', $cp_name);
		$query = $this->db->get('collection_point');
		$id = $query->result_array();

		if ($query->num_rows() > 0) {
			if ($id[0]['cp_id'] == $cpId) {
				return false;
			} else {
				return true;
			}
		} else {
			return false;
		}
	}

	function updateCollectionPoint($cpId, $formArray)
	{
		$this->db->where('cp_id', $cpId);
        $this->db->update('collection_point', $formArray);
        
	}
}
