<?php
class Model_videos extends CI_Model
{
	
	function get_videos() {
	
		$query = $this->db->query("	SELECT * FROM `glb_videos` ORDER BY `glb_videos`.`id` DESC");
		
		$videos = $query->result_array();
		
		if ( $videos ) { return $videos; }
		else { return null; }
		
	}
	
	function add_videos($title,$alias,$type,$mime_type,$token,$video,$thumb,$category,
						$description,$status,$likes,$dislikes,$uploaded_by,$published,$sorting) {
	
		$query = $this->db->query("INSERT INTO `glb_videos` (`id` , `title` ,`alias` ,`type`,`mime_type` ,`token` ,`video` ,
															`thumb` ,`category` ,`description` ,`status` ,
															`likes` ,`dislikes` ,`uploaded_by`,`published` ,`sorting`)
									VALUES ( NULL ,'$title','$alias','$type','$mime_type','$token','$video',
											'$thumb','$category','$description','$status','$likes',
											'$dislikes','$uploaded_by','$published','$sorting')");

		return $this->db->insert_id();		
		
	}
	
	function update_videos($video_id, $title,$alias,$type,$mime_type,$token,$video,$thumb,$category,
							$description,$status,$likes,$dislikes,$uploaded_by,$published,$sorting) {
	
		$query = $this->db->query("UPDATE `glb_videos` SET `title` = '$title', 
														`alias` = '$alias', 
														`type` = '$type', 
														`mime_type` = '$mime_type', 
														`video` = '$video', 
														`thumb` = '$thumb', 
														`description` = '$description', 
														`status` = '$status', 
														`uploaded_by` = '$uploaded_by',
														`published` = '$published', 
														`sorting` = '$sorting' 
													WHERE `glb_videos`.`id` = $video_id");
		die($this->db->_error_message());
		return;		
		
	}
	
	function select_video( $video_id ){
		
		$query = $this->db->query("SELECT * FROM `glb_videos` WHERE `glb_videos`.`id` = $video_id " );
		
		return $query->result_array();
	}
	
	function get_latest_video(){
		
		$query = $this->db->query("SELECT * FROM `glb_videos` WHERE `type` = 'local' ORDER BY `glb_videos`.`id` DESC LIMIT 1" );
				
		if( $query->num_rows() > 0 ){
			return $query->result_array();
		}else{
			return array();
		}
	}
	
	function delete_video($video_id){
		
		$query = $this->db->query("DELETE FROM `glb_videos` WHERE `glb_videos`.`id` = $video_id " );
		return;

	}
	
	function get_published_videos() {
	
		$query = $this->db->query("	SELECT * FROM `glb_videos` WHERE `glb_videos`.`status` = 'published' ORDER BY `glb_videos`.`id` DESC");
		
		$videos = $query->result_array();
		
		if ( $videos ) { return $videos; }
		else { return null; }
		
	}
	
	function get_pub_videos() {
	
		$query = $this->db->query("	SELECT * FROM `glb_videos` 
									WHERE `glb_videos`.`status` = 'published' 
									ORDER BY `glb_videos`.`id` DESC LIMIT 6");
		
		$videos = $query->result_array();
		
		if ( $videos ) { return $videos; }
		else { return null; }
		
	}
	
	function get_pub_videos_second($latest_video_id) {
	
		$query = $this->db->query("	SELECT * FROM `glb_videos` 
									WHERE id < $latest_video_id
									AND `glb_videos`.`status` = 'published' 
									ORDER BY `glb_videos`.`id` DESC LIMIT 6");
		
		$videos = $query->result_array();
		
		if ( $videos ) { return $videos; }
		else { return null; }
		
	}
	
	function get_video_byid($video_id) {
	
		$query = $this->db->query("	SELECT * FROM `glb_videos` WHERE id = $video_id");
		
		$video_info = $query->result_array();
		
		if ( $video_info ) { return $video_info; }
		else { return null; }
		
	}
}

?>