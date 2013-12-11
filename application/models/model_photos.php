<?php
class Model_photos extends CI_Model
{
	function getPhotoDetails($photo_id){
		$this->db->where('photo_id', $photo_id); 
		$query = $this->db->get('glb_photos');
		
		if( $query->num_rows() > 0 ){
			$photo_details = array();
			$photo_details = $query->row_array();
			
			return $photo_details;
		}else{
			return array();
		}
	}
	
	function editPhoto($post_data){
		$photo_id = $post_data['photo_id'];
		
		$data = array(
		   'photo_caption' 			=> $post_data['photo_caption'],
		   'photo_filename' 		=> $post_data['photo_filename'],
		   'photo_thumb_filename' 	=> $post_data['photo_thumb_filename'],
		   'photo_sort' 			=> $post_data['photo_sort'],
		   'date_uploaded' 			=> $post_data['date_uploaded'],
		   'uploaded_by' 			=> $post_data['uploaded_by'],
		   'photo_status' 			=> $post_data['photo_status']
		);

		$this->db->where('photo_id', $photo_id);
		$this->db->update('glb_photos', $data); 
		
		return $photo_id;
	}
	
	function get_photos_by_album($album_id) {
	
		$query = $this->db->query("	SELECT * FROM `glb_photos` WHERE  albumid = '$album_id'");
		
		$photos = $query->result_array();
		
		if ( $photos ) { return $photos; }
		else { return null; }
		
	}	

	
	function get_photos_info($photo_id) {
	
		$query = $this->db->query("	SELECT * FROM `glb_photos` WHERE  photo_id = '$photo_id'");
		
		$photos = $query->result_array();
		
		if ( $photos ) { return $photos; }
		else { return null; }
		
	}		
}

?>