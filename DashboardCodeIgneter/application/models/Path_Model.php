<?php
class Path_Model extends CI_model
{
    private $table = 'path';

	function addPath($Path)
	{
		return $this->db->insert($this->table, $Path);
	}

	function isNameExist($path_name)
	{
		$this->db->select('path_id');
		$this->db->where('path_name', $path_name);
		$query = $this->db->get($this->table);

		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	function get_paths_names()
	{
		$query = $this->db->get($this->table);
		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	function all()
	{
		$this->db
			->select('p.path_id, p.path_name, COUNT(cp.path_id) as cp_count')
			->from('path p')
            ->join('collection_point cp', 'cp.path_id = p.path_id', 'left')
            ->group_by('p.path_id');
		return $this->db->get()->result_array(); //SELECT p.path_id, p.path_name, COUNT(cp.path_id) as cp_count
												// FROM Path p, collection_point cp
												// WHERE cp.path_id = p.path_id
	}

	function getPath($pathId)
	{
		$this->db->where('path_id', $pathId);
		return $this->db->get($this->table)->row_array();
	}

	function deletePath($pathId)
	{
		$this->db->where('path_id', $pathId);
		$this->db->delete($this->table);
	}

	function isEditNameExist($pathId, $path_name)
	{
		$this->db->select('path_id');
		$this->db->where('path_name', $path_name);
		$query = $this->db->get($this->table);
		$id = $query->result_array();

		if ($query->num_rows() > 0) {
			if ($id[0]['path_id'] == $pathId) {
				return false;
			} else {
				return true;
			}
		} else {
			return false;
		}
	}

	function updatePath($pathId, $formArray)
	{
		$this->db->where('path_id', $pathId);
		$this->db->update($this->table, $formArray);
	}
	
	function get_drivers_for_path($pathId)
	{
		$this->db->select('driver_id, name, phone');
		$this->db->where('path_id', $pathId);
		$query = $this->db->get('driver');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
	}

}
