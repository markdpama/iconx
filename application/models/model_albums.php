<?php
class Model_albums extends CI_Model
{
	function getAlbumDetails($album_id){
		$this->db->where('album_id', $album_id); 
		$query = $this->db->get('glb_photo_album');
		
		if( $query->num_rows() > 0 ){
			$album_details = array();
			$album_details = $query->row_array();
			$photos = $this->getAlbumPhotos($album_id);
			$album_details['photos'] = $photos;
			$album_details['photos_count'] = count($photos);
			
			return $album_details;
		}else{
			return array();
		}
	}
	
	function getAlbumPhotos($album_id){
		$this->db->order_by('photo_sort', 'ASC');
		$this->db->order_by('photo_id', 'DESC');
		$this->db->where('albumid', $album_id); 
		$query = $this->db->get('glb_photos');
		
		if( $query->num_rows() > 0 ){
			return $query->result_array();
		}else{
			return array();
		}
	}
	
	function getAlbums(){
		$this->db->order_by('album_sort', 'ASC');
		$this->db->order_by('album_id', 'DESC');
		$query = $this->db->get('glb_photo_album');
		
		if( $query->num_rows() > 0 ){
			$tmp_albums = $query->result_array();
			$albums = array();
			$ctr = 0;
			
			foreach( $tmp_albums as $album ){
				$albums[$ctr] = $album;
				$albums[$ctr]['photos_count'] = $this->getPhotosCountByAlbum($album['album_id']);
				$ctr++;
			}
			
			return $albums;
		}else{
			return array();
		}
	}
	
	function getPhotosCountByAlbum($album_id){
		$this->db->where('albumid', $album_id); 
		$query = $this->db->get('glb_photos');
		
		if( $query->num_rows() > 0 ){
			return $query->num_rows();
		}else{
			return 0;
		}
	}
	
	function addAlbum($post_data){
		$data = array(
		   'album_name' 		=> $post_data['album_name'],
		   'album_desc' 		=> $post_data['album_desc'],
		   'album_status' 		=> $post_data['album_status'],
		   'album_publish_date' => $post_data['album_publish_date'],
		   'album_created_by' 	=> $post_data['album_created_by'],
		   'album_sort' 		=> $post_data['album_sort'],
		   'album_cover' 		=> $post_data['cover_image_name'],
		   'album_cover_thumb' 	=> $post_data['cover_thumb_image_name']
		);

		$this->db->insert('glb_photo_album', $data);
		
		return $this->db->insert_id();
	}
	
	function editAlbum($post_data){
		$album_id = $post_data['album_id'];
		
		$data = array(
		   'album_name' 		=> $post_data['album_name'],
		   'album_desc' 		=> $post_data['album_desc'],
		   'album_status' 		=> $post_data['album_status'],
		   'album_publish_date' => $post_data['album_publish_date'],
		   'album_created_by' 	=> $post_data['album_created_by'],
		   'album_sort' 		=> $post_data['album_sort'],
		   'album_cover' 		=> $post_data['cover_image_name'],
		   'album_cover_thumb' 	=> $post_data['cover_thumb_image_name']
		);

		$this->db->where('album_id', $album_id);
		$this->db->update('glb_photo_album', $data); 
		
		return $album_id;
	}
	
	function getNextPhotoSort($album_id){
		$this->db->where('albumid', $album_id); 
		$this->db->order_by('photo_sort', 'DESC');
		$query = $this->db->get('glb_photos');
		
		if( $query->num_rows > 0 ){
			$result = $query->row_array();
			
			return $result['photo_sort'] + 1;
		}else{
			return 1;
		}
	}
	
	function addPhotoToAlbum($photo_details, $album_id){
		$photo_caption = '';
		$photo_filename = '';
		$photo_thumb_filename = '';
		$photo_sort = $this->getNextPhotoSort($album_id);
		$photo_status = 'draft';
		$photo_uploaded_by = '';
		$photo_date_uploaded = date("Y-m-d H:i:s");
		
		if( isset($photo_details['photo-caption']) ){
			$photo_caption = $photo_details['photo-caption'];
		}
		
		if( isset($photo_details['photo-filename']) ){
			$photo_filename = $photo_details['photo-filename'];
		}
		
		if( isset($photo_details['photo-thumb-filename']) ){
			$photo_thumb_filename = $photo_details['photo-thumb-filename'];
		}
		
		if( isset($photo_details['photo-sort']) ){
			$photo_sort = $photo_details['photo-sort'];
		}
		
		if( isset($photo_details['photo-status']) ){
			$photo_status = $photo_details['photo-status'];
		}
		
		if( isset($photo_details['uploaded-by']) ){
			$photo_uploaded_by = $photo_details['uploaded-by'];
		}
		
		if( isset($photo_details['date-uploaded']) ){
			$photo_date_uploaded = $photo_details['date-uploaded'];
		}
		
		$data = array(
		   'albumid' 				=> $album_id,
		   'photo_caption' 			=> $photo_caption,
		   'photo_filename' 		=> $photo_filename,
		   'photo_thumb_filename' 	=> $photo_thumb_filename,
		   'photo_sort' 			=> $photo_sort,
		   'photo_status' 			=> $photo_status,
		   'date_uploaded' 			=> $photo_date_uploaded,
		   'uploaded_by' 			=> $photo_uploaded_by
		);
		
		$this->db->insert('glb_photos', $data);
		
		return array(
			'photoid' 			=> $this->db->insert_id(),
			'sort' 				=> $photo_sort,
			'uploaded_by' 		=> $photo_uploaded_by,
			'date_uploaded' 	=> date('Y-m-d', strtotime($photo_date_uploaded))
		);
	}
	
	function deletePhotoFromAlbum($photo_id){
		$this->db->where('photo_id', $photo_id); 
		$query = $this->db->get('glb_photos');
		$photo = array();
		$photo['photo_id'] = 0;
		$photo['albumid'] = 0;
		$photo['photo_caption'] = '';
		$photo['photo_filename'] = '';
		$photo['photo_thumb_filename'] = '';
		$photo['photo_sort'] = 0;
		$photo['date_uploaded'] = '';
		$photo['uploaded_by'] = '';
		$photo['photo_status'] = '';
		
		if( $query->num_rows() > 0 ){
			$tmp_photo = $query->row_array();
			$photo = $tmp_photo;
		}
		
		$this->db->where('photo_id', $photo_id);
		$this->db->delete('glb_photos');

		return $photo;
	}
	
	function deleteAlbum($album_id){
		$this->db->where('album_id', $album_id); 
		$query = $this->db->get('glb_photo_album');
		$album = array();
		$album['album_id'] = 0;
		$album['album_name'] = '';
		$album['album_desc'] = '';
		$album['album_cover'] = '';
		$album['album_cover_thumb'] = '';
		$album['album_status'] = '';
		$album['album_publish_date'] = '';
		$album['album_created_by'] = '';
		$album['album_sort'] = 0;
		
		if( $query->num_rows() > 0 ){
			$tmp_album = $query->row_array();
			$album = $tmp_album;
		}
		
		$this->db->where('album_id', $album_id);
		$this->db->delete('glb_photo_album');

		return $album;
	}
	
	/**** frontend ****/	
	function getPubAlbums(){
		$this->db->where('album_status', 'published'); 
		$this->db->order_by('album_publish_date', 'DESC');
		$query = $this->db->get('glb_photo_album');
		
		if( $query->num_rows() > 0 ){
			$tmp_albums = $query->result_array();
			$albums = array();
			$ctr = 0;
			
			foreach( $tmp_albums as $album ){
				$albums[$ctr] = $album;
				$albums[$ctr]['photos_count'] = $this->getPhotosCountByAlbum($album['album_id']);
				$ctr++;
			}
			
			return $albums;
		}else{
			return array();
		}
	}
	
	function get_pub_album() {
	
		$this->db->where('album_status', 'published'); 
		$this->db->order_by('album_publish_date', 'DESC');
		$this->db->limit(6);
		$query = $this->db->get('glb_photo_album');
		
		if( $query->num_rows() > 0 ){
			$tmp_albums = $query->result_array();
			$albums = array();
			$ctr = 0;
			
			foreach( $tmp_albums as $album ){
				$albums[$ctr] = $album;
				$albums[$ctr]['photos_count'] = $this->getPhotosCountByAlbum($album['album_id']);
				$ctr++;
			}
			
			return $albums;
		}else{
			return array();
		}
		
	}
	
	
	
	function get_pub_album_second($latest_album_date) {
	
		$query = $this->db->query("	SELECT * FROM `glb_photo_album` 
									WHERE `glb_photo_album`.`album_publish_date` < $latest_album_date
									AND `glb_photo_album`.`album_status` = 'published' 
									ORDER BY `glb_photo_album`.`album_publish_date` DESC LIMIT 6");
		
		$albums = $query->result_array();
		
		if ( $albums ) { return $albums; }
		else { return null; }
		
	}
	
	
}

?>