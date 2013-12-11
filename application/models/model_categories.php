<?php
class Model_categories extends CI_Model
{

	function get_categories() {
	
		$query = $this->db->query("	SELECT * FROM glb_categories");
		
		$categories = $query->result_array();
		
		if ($categories) { return $categories; }
		else { return null; }
		
	}
	
	function get_parent_categories() {
	
		$query = $this->db->query("	SELECT * FROM glb_categories WHERE parent_id = 0");
		
		$parent_categories = $query->result_array();
		
		if ($parent_categories) { return $parent_categories; }
		else { return null; }
		
	}
	
	function get_sub_categories() {
	
		$query = $this->db->query("	SELECT * FROM glb_categories WHERE parent_id != 0");
		
		$parent_categories = $query->result_array();
		
		if ($parent_categories) { return $parent_categories; }
		else { return null; }
		
	}
}

?>