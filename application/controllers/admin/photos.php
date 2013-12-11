<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photos extends GLB_Controller {
	
	function __construct() {
		parent::__construct();
		
		$this->load->model('model_photos');
		$this->load->model('model_albums');
	}
	
	public function shortenString($string, $limit){
		if( strlen($string) <= $limit ){
			return $string;
		}else{
			return substr($string, 0, $limit);
		}
	}
	
	public function shortenStringWithEllipsis($string, $limit){
		if( strlen($string) <= $limit ){
			return $string;
		}else{
			return substr($string, 0, $limit) . '...';
		}
	}
	
	public function index() {
		redirect($this->config->base_url() . 'admin/albums', 'refresh');
	}
	
	public function edit_photo($photo_id=null) {
		if (!$this->session->userdata('logged_in')) { redirect('admin/login'); } // logged in?
		
		if( $photo_id == null ){ redirect($this->config->base_url() . 'admin/albums', 'refresh'); }
		
		$photo_id = (int)$photo_id;
		$photo_details = $this->model_photos->getPhotoDetails($photo_id);
		
		$_data 						= array();
		$_data['page'] 				= "photo";
		$_data['photo_details'] 	= $photo_details;
		$_data['content'] 			= $this->load->view('admin/tpl_photos_edit', $_data, TRUE);
		
		$this->load->view('admin/tpl_main', $_data);
	}
	
	public function upload_photo(){
		if (!$this->session->userdata('logged_in')) { redirect('admin/login'); } // logged in?
		
		if($_FILES['photo_image']['size'] != 0){
			$image_path 				= "_assets/images/photos/";
			$orig_image_name			= $_FILES["photo_image"]['name'];

			$config						= array();
			$config['upload_path'] 		= $image_path;
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
			$config['max_size']			= '9999';
			$config['file_name']		= $orig_image_name;
			
			$this->load->library('upload', $config);
			
			if(!$this->upload->do_upload("photo_image")){
				$msg = $this->upload->display_errors();
				$status = 'error-'.$_FILES['photo_image'].'-'.$orig_image_name.'--'.$msg;
				$upload = array("status" => "error", "msg" => $msg, "filename" => $orig_image_name);
			}else{
				$image_data = $this->upload->data();
				
				$image_filename = $image_data['file_name'];
				$image_path_with_filename = $image_path . $image_filename;
				$image_path_without_filename = str_replace($image_filename, '', $image_path_with_filename);
				
				if( file_exists($image_path_with_filename) ){
					//file exists
					$fileParts = pathinfo($image_path_with_filename);
					$ext = $fileParts['extension'];
					$main_image_is_unique = false;
					
					//rename main image
					while( $main_image_is_unique == false ){
						$thumb_marker = '-thumb';
						$new_filename = date("Y-m-d_H-i-s") . '.' . $ext;
						$thumb_filename = date("Y-m-d_H-i-s") . $thumb_marker . '.' . $ext;
						$new_image_path_with_filename = $image_path_without_filename . $new_filename;
						
						if( !file_exists($new_image_path_with_filename) ){
							$main_image_is_unique = true;
							rename($image_path_with_filename, $new_image_path_with_filename);
							$image_filename = $new_filename;
							$image_path_with_filename = $new_image_path_with_filename;
							break;
						}
					}
					
					//load library
					$this->load->library('image_lib');
					
					//resize image
					$thumb_image_path_with_filename 	= $image_path_without_filename . $image_filename;
					$config_thumbs						= array();
					$config_thumbs['source_image']		= $image_path_with_filename;
					$config_thumbs['maintain_ratio']	= true;
					$config_thumbs['master_dim']		= 'auto';
					$config_thumbs['width']				= 1000;
					$config_thumbs['height']			= 1000;
					
					$this->image_lib->initialize($config_thumbs); 
					$this->image_lib->resize();
					
					//create thumbnail
					$thumb_image_path_with_filename 	= $image_path_without_filename . $image_filename;
					$config_thumbs						= array();
					$config_thumbs['source_image']		= $image_path_with_filename;
					$config_thumbs['maintain_ratio']	= true;
					$config_thumbs['create_thumb']		= true;
					$config_thumbs['thumb_marker']		= $thumb_marker;
					$config_thumbs['master_dim']		= 'auto';
					$config_thumbs['width']				= 200;
					$config_thumbs['height']			= 200;
					
					$this->image_lib->initialize($config_thumbs); 
					$this->image_lib->resize();

					$status = "success";
				
					$msg = "Photo successfully uploaded.";
					
					$upload = array("status" => $status, "msg" => $msg, "filename" => $image_filename, "thumbfilename" => $thumb_filename);
				}else{
					$upload = array("status" => "error", "msg" => "Oops, something went wrong. Your action may or may not have been completed.");
				}
			}	
		}else{
			$upload = array("status" => "error", "msg" => "Oops, something went wrong. Your action may or may not have been completed.");
		}
		
		echo json_encode($upload);
	}
	
	public function process_edit(){
		if (!$this->session->userdata('logged_in')) { redirect('admin/login'); } // logged in?
		
		$post_data = array();
		$post_data['photo_id'] = (int)trim($this->input->post('photo-id'));
		$post_data['albumid'] = (int)trim($this->input->post('albumid'));
		$post_data['photo_caption'] = trim($this->input->post('photo-caption'));
		$post_data['photo_filename'] = trim($this->input->post('photo-filename'));
		$post_data['photo_thumb_filename'] = trim($this->input->post('photo-thumb-filename'));
		$post_data['old_photo_filename'] = trim($this->input->post('old-photo-filename'));
		$post_data['old_photo_thumb_filename'] = trim($this->input->post('old-photo-thumb-filename'));
		$post_data['photo_sort'] = (int)trim($this->input->post('photo-sort'));
		$post_data['date_uploaded'] = trim($this->input->post('date-uploaded'));
		$post_data['uploaded_by'] = trim($this->input->post('uploaded-by'));
		$post_data['photo_status'] = trim($this->input->post('photo-status'));
		
		//edit photo
		$photo_id = $this->model_photos->editPhoto($post_data);
		
		//delete old photo and thumb
		if( trim($this->input->post('old-photo-filename')) != trim($this->input->post('photo-filename')) ){
			if( trim($this->input->post('old-photo-filename')) != '' ){
				if( file_exists("_assets/images/photos/" . $this->input->post('old-photo-filename')) ){
					unlink("_assets/images/photos/" . $this->input->post('old-photo-filename'));
				}
			}
		}
		if( trim($this->input->post('old-photo-thumb-filename')) != trim($this->input->post('photo-thumb-filename')) ){
			if( trim($this->input->post('old-photo-thumb-filename')) != '' ){
				if( file_exists("_assets/images/photos/" . $this->input->post('old-photo-thumb-filename')) ){
					unlink("_assets/images/photos/" . $this->input->post('old-photo-thumb-filename'));
				}
			}
		}
		
		//display album
		$album_id = (int)$this->input->post('albumid');
		$album_details = $this->model_albums->getAlbumDetails($album_id);
		$photos = array();
		
		if( empty($album_details) ){ redirect($this->config->base_url() . 'admin/albums', 'refresh'); }
		
		if( isset($album_details['photos']) && count($album_details['photos']) > 0 ){
			foreach( $album_details['photos'] as $photo ){
				$photo['photo_short_caption'] = $this->shortenStringWithEllipsis($photo['photo_caption'], 10);
				$photo['photo_short_filename'] = $this->shortenStringWithEllipsis($photo['photo_filename'], 10);
				$photo['photo_short_thumb_filename'] = $this->shortenStringWithEllipsis($photo['photo_thumb_filename'], 10);
				$photo['short_uploaded_by'] = $this->shortenStringWithEllipsis($photo['uploaded_by'], 10);
				$photos[] = $photo;
			}
		}
		
		$_data 						= array();
		$_data['page'] 				= "album";
		$_data['album_details'] 	= $album_details;
		$_data['photos'] 			= $photos;
		$_data['content'] 			= $this->load->view('admin/tpl_albums_edit', $_data, TRUE);
		
		$this->load->view('admin/tpl_albums_edit', $_data);
	}
}
?>