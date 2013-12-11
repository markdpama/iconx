<?php
class Model_users extends CI_Model
{

	function login($username, $password)
	{
		$query = $this->db->query("	SELECT * 
									FROM glb_users
									WHERE username = '$username' 
									AND password = '$password'");
		$user_details = $query->result_array();
		$user_details = $user_details[0];
		
		if ($user_details) { return $user_details; }
		else { return null; }
	}
}

?>