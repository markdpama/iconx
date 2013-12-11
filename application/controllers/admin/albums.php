<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Albums extends GLB_Controller {
	
	function __construct() {
		parent::__construct();
		error_reporting(0);
		
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
		if (!$this->session->userdata('logged_in')) { redirect('admin/login'); } // logged in?
		
		$tmp_albums = $this->model_albums->getAlbums();
		
		$albums = array();
		foreach( $tmp_albums as $album ){
			$album['album_short_name'] = $this->shortenStringWithEllipsis($album['album_name'], 10);
			$album['album_short_created_by'] = $this->shortenStringWithEllipsis($album['album_created_by'], 10);
			$album['album_short_desc'] = $this->shortenStringWithEllipsis($album['album_desc'], 10);
			$album['album_formated_publish_date'] = date("Y-m-d", strtotime($album['album_publish_date']));
			$albums[] = $album;
		}
		
		$_data 					= array();
		$_data['page'] 			= "albums";
		$_data['albums'] 		= $albums;
		$_data['content'] 		= $this->load->view('admin/tpl_albums', $_data, TRUE);
		
		$this->load->view('admin/tpl_main', $_data);
	}
	
	public function add_album(){
		if (!$this->session->userdata('logged_in')) { redirect('admin/login'); } // logged in?
		
		$_data 					= array();
		$_data['page'] 			= "album";
		$_data['content'] 		= $this->load->view('admin/tpl_albums_add', $_data, TRUE);
		
		$this->load->view('admin/tpl_main', $_data);
	}
	
	public function process_add(){
		if (!$this->session->userdata('logged_in')) { redirect('admin/login'); } // logged in?
		
		$post_data 								= array();
		$post_data['album_name']				= trim($this->input->post('album-name'));
		$post_data['album_desc'] 				= trim($this->input->post('album-desc'));
		$post_data['album_publish_date'] 		= trim($this->input->post('album-publish-date'));
		$post_data['album_status'] 				= trim($this->input->post('album-status'));
		$post_data['album_created_by'] 			= trim($this->input->post('album-created-by'));
		$post_data['album_sort'] 				= trim($this->input->post('album-sort'));
		$post_data['cover_image_name'] 			= trim($this->input->post('cover-image-name'));
		$post_data['cover_thumb_image_name'] 	= trim($this->input->post('cover-thumb-image-name'));
		
		//add album
		$album_id = $this->model_albums->addAlbum($post_data);
		
		if( $this->input->post('photosfilenames') && count($this->input->post('photosfilenames')) > 0 ){
			$arr_photos = $this->input->post('photosfilenames');
			
			foreach( $arr_photos as $photo ){
				$arr_tmp_photo_details = explode('|', $photo);
				$photo_filename = '';
				$photo_thumb_filename = '';
				if( isset($arr_tmp_photo_details[0]) ){
					$photo_filename = $arr_tmp_photo_details[0];
				}
				if( isset($arr_tmp_photo_details[1]) ){
					$photo_thumb_filename = $arr_tmp_photo_details[1];
				}
				
				$photo_details = array();
				$photo_details['photo-filename'] = $photo_filename;
				$photo_details['photo-thumb-filename'] = $photo_thumb_filename;
				$photo_details['uploaded-by'] = trim($this->input->post('album-created-by'));
				
				$this->model_albums->addPhotoToAlbum($photo_details, $album_id);
			}
		}
		
		//display albums
		$tmp_albums = $this->model_albums->getAlbums();
		
		$albums = array();
		foreach( $tmp_albums as $album ){
			$album['album_short_name'] = $this->shortenStringWithEllipsis($album['album_name'], 10);
			$album['album_short_created_by'] = $this->shortenStringWithEllipsis($album['album_created_by'], 10);
			$album['album_short_desc'] = $this->shortenStringWithEllipsis($album['album_desc'], 10);
			$album['album_formated_publish_date'] = date("Y-m-d", strtotime($album['album_publish_date']));
			$albums[] = $album;
		}
		
		$_data 					= array();
		$_data['page'] 			= "albums";
		$_data['albums'] 		= $albums;
		$_data['content'] 		= $this->load->view('admin/tpl_albums', $_data, TRUE);
		
		$this->load->view('admin/tpl_albums', $_data);
	}
	
	public function process_edit(){
		if (!$this->session->userdata('logged_in')) { redirect('admin/login'); } // logged in?
		
		$post_data 									= array();
		$post_data['album_id']						= (int)$this->input->post('album-id');
		$post_data['album_name']					= trim($this->input->post('album-name'));
		$post_data['album_desc'] 					= trim($this->input->post('album-desc'));
		$post_data['album_publish_date'] 			= trim($this->input->post('album-publish-date'));
		$post_data['album_status'] 					= trim($this->input->post('album-status'));
		$post_data['album_created_by'] 				= trim($this->input->post('album-created-by'));
		$post_data['album_sort'] 					= trim($this->input->post('album-sort'));
		$post_data['cover_image_name'] 				= trim($this->input->post('cover-image-name'));
		$post_data['cover_thumb_image_name'] 		= trim($this->input->post('cover-thumb-image-name'));
		$post_data['old_cover_image_name'] 			= trim($this->input->post('old-cover-image-name'));
		$post_data['old_cover_thumb_image_name'] 	= trim($this->input->post('old-cover-thumb-image-name'));
		
		//edit album
		$album_id = $this->model_albums->editAlbum($post_data);
		
		//delete old album cover and album thumb
		if( trim($this->input->post('old-cover-image-name')) != trim($this->input->post('cover-image-name')) ){
			if( trim($this->input->post('old-cover-image-name')) != '' ){
				if( file_exists("_assets/images/photos/" . $this->input->post('old-cover-image-name')) ){
					unlink("_assets/images/photos/" . $this->input->post('old-cover-image-name'));
				}
			}
		}
		if( trim($this->input->post('old-cover-thumb-image-name')) != trim($this->input->post('cover-thumb-image-name')) ){
			if( trim($this->input->post('old-cover-thumb-image-name')) != '' ){
				if( file_exists("_assets/images/photos/" . $this->input->post('old-cover-thumb-image-name')) ){
					unlink("_assets/images/photos/" . $this->input->post('old-cover-thumb-image-name'));
				}
			}
		}
		
		//display albums
		$tmp_albums = $this->model_albums->getAlbums();
		
		$albums = array();
		foreach( $tmp_albums as $album ){
			$album['album_short_name'] = $this->shortenStringWithEllipsis($album['album_name'], 10);
			$album['album_short_created_by'] = $this->shortenStringWithEllipsis($album['album_created_by'], 10);
			$album['album_short_desc'] = $this->shortenStringWithEllipsis($album['album_desc'], 10);
			$album['album_formated_publish_date'] = date("Y-m-d", strtotime($album['album_publish_date']));
			$albums[] = $album;
		}
		
		$_data 					= array();
		$_data['page'] 			= "albums";
		$_data['albums'] 		= $albums;
		$_data['content'] 		= $this->load->view('admin/tpl_albums', $_data, TRUE);
		
		$this->load->view('admin/tpl_albums', $_data);
	}
	
	public function process_delete(){
		$ajax_result = array();
		$ajax_result['status'] = 'error';
		$ajax_result['msg'] = 'error';
		
		if( $this->input->post('album_id') ){    
			$album_details = $this->model_albums->getAlbumDetails($this->input->post('album_id'));
			
			//delete album cover and thumb cover
			if( isset($album_details['album_cover']) && trim($album_details['album_cover']) != '' ){
				if( file_exists('_assets/images/photos/' . $album_details['album_cover']) ){
					unlink('_assets/images/photos/' . $album_details['album_cover']);
				}
			}
			if( isset($album_details['album_cover_thumb']) && trim($album_details['album_cover_thumb']) != '' ){
				if( file_exists('_assets/images/photos/' . $album_details['album_cover_thumb']) ){
					unlink('_assets/images/photos/' . $album_details['album_cover_thumb']);
				}
			}
			
			//delete album photos
			if( isset($album_details['photos']) && count($album_details['photos']) > 0 ){
				foreach( $album_details['photos'] as $photo ){
					$photo_id = $photo['photo_id'];
					$photo_filename = $photo['photo_filename'];
					$photo_thumb_filename = $photo['photo_thumb_filename'];
					
					//delete photo and photo thumb
					if( $photo_filename != '' ){
						if( file_exists('_assets/images/photos/' . $photo_filename) ){
							unlink('_assets/images/photos/' . $photo_filename);
						}
					}
					if( $photo_thumb_filename != '' ){
						if( file_exists('_assets/images/photos/' . $photo_thumb_filename) ){
							unlink('_assets/images/photos/' . $photo_thumb_filename);
						}
					}
					
					//delete photo from db
					$photo_details = $this->model_albums->deletePhotoFromAlbum($photo_id);
				}
			}
			
			//delete album from db
			$album_details = $this->model_albums->deleteAlbum($album_details['album_id']);
			
			$ajax_result['status'] = 'success';
			$ajax_result['msg'] = 'success';
		}else{
			$ajax_result['status'] = 'error';
			$ajax_result['msg'] = 'error';
		}
		
		echo json_encode($ajax_result);
	}
	
	public function process_delete_photo_from_album(){
		$photo_id = 0;
		$ajax_result = array();
		$ajax_result['status'] = '';
		$ajax_result['msg'] = '';
		
		if( $this->input->post('photo_id') ){
			$photo_id = $this->input->post('photo_id');
			$photo_id = (int)$photo_id;
			$photo_details = $this->model_albums->deletePhotoFromAlbum($photo_id);
			
			$ajax_result['status'] = 'success';
			$ajax_result['msg'] = 'success';
			
			//delete photo and thumbnail photo from server
			$path_filename = '_assets/images/photos/' . $photo_details['photo_filename'];
			$path_thumb_filename = '_assets/images/photos/' . $photo_details['photo_thumb_filename'];
			
			if( trim($photo_details['photo_filename']) != '' ){
				if( file_exists($path_filename) ){
					unlink($path_filename);
				}
			}
			if( trim($photo_details['photo_thumb_filename']) != '' ){
				if( file_exists($path_thumb_filename) ){
					unlink($path_thumb_filename);
				}
			}
		}else{
			$ajax_result['status'] = 'error';
			$ajax_result['msg'] = 'Oops, something went wrong. The photo may or may not have been deleted.';
		}
		
		echo json_encode($ajax_result);
	}
	
	public function edit_album($album_id = null){
		if (!$this->session->userdata('logged_in')) { redirect('admin/login'); } // logged in?
		
		if( $album_id == null ){ redirect($this->config->base_url() . 'admin/albums', 'refresh'); }
		
		$album_id = (int)$album_id;
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
		
		$this->load->view('admin/tpl_main', $_data);
	}
	
	public function upload_album_cover_image(){
		if (!$this->session->userdata('logged_in')) { redirect('admin/login'); } // logged in?
		
		if($_FILES['cover_image']['size'] != 0){
			$image_path 				= "_assets/images/photos/";
			$orig_image_name			= $_FILES["cover_image"]['name'];

			$config						= array();
			$config['upload_path'] 		= $image_path;
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
			$config['max_size']			= '9999';
			$config['file_name']		= $orig_image_name;
			
			$this->load->library('upload', $config);
			
			if(!$this->upload->do_upload("cover_image")){
				$msg = $this->upload->display_errors();
				$status = 'error-'.$_FILES['cover_image'].'-'.$orig_image_name.'--'.$msg;
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
				
					$msg = "Album cover successfully uploaded.";
					
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
	
	public function multiple_photos_upload(){
		$verifyToken = md5('unique_salt' . $this->input->post('timestamp'));
		$files = array();
		
		if (!empty($_FILES) && isset($_FILES['files']) && $this->input->post('token') == $verifyToken) {
			$this->load->library('upload');
			
			$image_path 				= '_assets/images/photos/';
			$orig_image_tmp_name		= $_FILES['files']['tmp_name'];
			$orig_image_name			= $_FILES['files']['name'];

			$config				 		= array();
			$config['upload_path'] 		= $image_path;
			$config['allowed_types'] 	= '*';
			$config['max_size']			= '9999';
			$config['file_name']		= $orig_image_name;
			
			$this->upload->initialize($config);
			
			if(!$this->upload->do_upload('files')){
				$files[] = array(
					"name" => "",
					"size" => 0,
					"url" => "",
					"thumbnailUrl" => "",
					"deleteUrl" => "",
					"deleteType" => "",
					"status" => "error",
					"msg" => "There has been an error uploading the file (" . $orig_image_name . ").",
					"id" => "file-" . time(),
					"origfilename" => 'orig_image_name', 
					"filename" => 'image_filename', 
					"thumbfilename" => 'thumb_filename'
				);

				$upload = array(
					'files' => $files
				);
				
				echo json_encode($upload);
				die();
			}else{
				$image_data = $this->upload->data();
				
				$image_filename = $image_data['file_name'];
				$image_path_with_filename = $image_path . $image_filename;
				$image_path_without_filename = str_replace($image_filename, '', $image_path_with_filename);
				
				$allowed_filetypes = array(0=>'jpg', 1=>'png', 2=>'gif', 3=>'jpeg', 4=>'JPG', 5=>'JPEG', 6=>'PNG', 7=>'GIF');
				$image_file_parts = pathinfo($image_path_with_filename);
				$image_ext = $image_file_parts['extension'];
				
				if( !in_array($image_ext, $allowed_filetypes) ){
					if( trim($image_filename) != '' ){
						unlink($image_path_with_filename);
					}
					$files[] = array(
						"name" => "",
						"size" => 0,
						"url" => "",
						"thumbnailUrl" => "",
						"deleteUrl" => "",
						"deleteType" => "",
						"status" => "error",
						"msg" => "The type of the file (" . $orig_image_name . ") is not valid.",
						"id" => "file-" . time(),
						"origfilename" => 'orig_image_name', 
						"filename" => 'image_filename', 
						"thumbfilename" => 'thumb_filename'
					);

					$upload = array(
						'files' => $files
					);
					
					echo json_encode($upload);
					die();
				}
				
				if( file_exists($image_path_with_filename) ){
					//file exists
					$fileParts = pathinfo($image_path_with_filename);
					$ext = $fileParts['extension'];
					$main_image_is_unique = false;
					
					//rename main image
					while( $main_image_is_unique == false ){
						$thumb_marker = '-thumb';
						$rand = date("Y-m-d_H-i-s_") . time() . '_' . rand();
						$new_filename =  $rand . '.' . $ext;
						$thumb_filename = $rand . $thumb_marker . '.' . $ext;
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
					$config_thumbs						= array();
					$config_thumbs['source_image']		= $image_path_with_filename;
					$config_thumbs['maintain_ratio']	= true;
					$config_thumbs['master_dim']		= 'auto';
					$config_thumbs['width']				= 1000;
					$config_thumbs['height']			= 1000;
					
					$this->image_lib->initialize($config_thumbs);
					$this->image_lib->resize();
					
					//create thumbnail
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
					
					$files[] = array(
						"name" => "",
						"size" => 0,
						"url" => "",
						"thumbnailUrl" => "",
						"deleteUrl" => "",
						"deleteType" => "",
						"status" => "success",
						"msg" => "The file (" . $orig_image_name . ") has been successfully uploaded and renamed.",
						"id" => "file-" . $rand,
						"origfilename" => $orig_image_name, 
						"filename" => $image_filename, 
						"thumbfilename" => $thumb_filename
					);
			
					$upload = array(
						'files' => $files,
						'count' => count($files)
					);
					
					echo json_encode($upload);
					die();
				}else{
					$files[] = array(
						"name" => "",
						"size" => 0,
						"url" => "",
						"thumbnailUrl" => "",
						"deleteUrl" => "",
						"deleteType" => "",
						"status" => "error",
						"msg" => "There has been an error uploading the file (" . $orig_image_name . ").",
						"id" => "file-" . time(),
						"origfilename" => 'orig_image_name', 
						"filename" => 'image_filename', 
						"thumbfilename" => 'thumb_filename'
					);

					$upload = array(
						'files' => $files
					);
					
					echo json_encode($upload);
					die();
				}
			}
		}
	}
	
	public function multiple_photos_upload_edit(){
		$verifyToken = md5('unique_salt' . $this->input->post('timestamp'));
		
		if (!empty($_FILES) && isset($_FILES['files']) && $this->input->post('albumid') && $this->input->post('token') == $verifyToken) {
			$this->load->library('upload');
			
			$image_path 				= '_assets/images/photos/';
			$orig_image_tmp_name		= $_FILES["files"]['tmp_name'];
			$orig_image_name			= $_FILES["files"]['name'];

			$config				 		= array();
			$config['upload_path'] 		= $image_path;
			$config['allowed_types'] 	= '*';
			$config['max_size']			= '9999';
			$config['file_name']		= $orig_image_name;
			
			$this->upload->initialize($config);
			
			if(!$this->upload->do_upload("files")){
				$files[] = array(
					"name" => "",
					"size" => 0,
					"url" => "",
					"thumbnailUrl" => "",
					"deleteUrl" => "",
					"deleteType" => "",
					"status" => "error",
					"msg" => "There has been an error uploading the file (" . $orig_image_name . ").",
					"id" => "file-" . time(),
					"origfilename" => 'orig_image_name', 
					"filename" => 'image_filename', 
					"thumbfilename" => 'thumb_filename'
				);

				$upload = array(
					'files' => $files
				);
				
				echo json_encode($upload);
				die();
			}else{
				$image_data = $this->upload->data();
				
				$image_filename = $image_data['file_name'];
				$image_path_with_filename = $image_path . $image_filename;
				$image_path_without_filename = str_replace($image_filename, '', $image_path_with_filename);
				
				$allowed_filetypes = array(0=>'jpg', 1=>'png', 2=>'gif', 3=>'jpeg', 4=>'JPG', 5=>'JPEG', 6=>'PNG', 7=>'GIF');
				$image_file_parts = pathinfo($image_path_with_filename);
				$image_ext = $image_file_parts['extension'];
				
				if( !in_array($image_ext, $allowed_filetypes) ){
					if( trim($image_filename) != '' ){
						unlink($image_path_with_filename);
					}
					$files[] = array(
						"name" => "",
						"size" => 0,
						"url" => "",
						"thumbnailUrl" => "",
						"deleteUrl" => "",
						"deleteType" => "",
						"status" => "error",
						"msg" => "The type of the file (" . $orig_image_name . ") is not valid.",
						"id" => "file-" . time(),
						"origfilename" => 'orig_image_name', 
						"filename" => 'image_filename', 
						"thumbfilename" => 'thumb_filename'
					);

					$upload = array(
						'files' => $files
					);
					
					echo json_encode($upload);
					die();
				}
				
				if( file_exists($image_path_with_filename) ){
					//file exists
					$fileParts = pathinfo($image_path_with_filename);
					$ext = $fileParts['extension'];
					$main_image_is_unique = false;
					
					//rename main image
					while( $main_image_is_unique == false ){
						$thumb_marker = '-thumb';
						$rand = date("Y-m-d_H-i-s_") . time() . '_' . rand();
						$new_filename =  $rand . '.' . $ext;
						$thumb_filename = $rand . $thumb_marker . '.' . $ext;
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
					$config_thumbs						= array();
					$config_thumbs['source_image']		= $image_path_with_filename;
					$config_thumbs['maintain_ratio']	= true;
					$config_thumbs['master_dim']		= 'auto';
					$config_thumbs['width']				= 1000;
					$config_thumbs['height']			= 1000;
					
					$this->image_lib->initialize($config_thumbs);
					$this->image_lib->resize();
					
					//create thumbnail
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
					
					//add to the album
					$album_id = $this->input->post('albumid');
					
					//get uploaded by
					$uploaded_by = '';
					if( $this->input->post('uploaded_by') ){
						$uploaded_by = $this->input->post('uploaded_by');
					}
					
					$photo_details = array();
					$photo_details['photo-filename'] = $image_filename;
					$photo_details['photo-thumb-filename'] = $thumb_filename;
					$photo_details['uploaded-by'] = $uploaded_by;
					
					$tmp_photo_details = $this->model_albums->addPhotoToAlbum($photo_details, $album_id);
					
					$files[] = array(
						"name" => "",
						"size" => 0,
						"url" => "",
						"thumbnailUrl" => "",
						"deleteUrl" => "",
						"deleteType" => "",
						"status" => "success",
						"msg" => "The file (" . $orig_image_name . ") has been successfully uploaded and renamed.",
						"id" => $tmp_photo_details['photoid'],
						"origfilename" => $orig_image_name, 
						"filename" => $image_filename, 
						"thumbfilename" => $thumb_filename,
						"sort" => $tmp_photo_details['sort'], 
						"uploadedby" => $tmp_photo_details['uploaded_by'], 
						"dateuploaded" => $tmp_photo_details['date_uploaded']
					);
			
					$upload = array(
						'files' => $files,
						'count' => count($files)
					);
					
					echo json_encode($upload);
					die();
				}else{
					$files[] = array(
						"name" => "",
						"size" => 0,
						"url" => "",
						"thumbnailUrl" => "",
						"deleteUrl" => "",
						"deleteType" => "",
						"status" => "error",
						"msg" => "There has been an error uploading the file (" . $orig_image_name . ").",
						"id" => "file-" . time(),
						"origfilename" => 'orig_image_name', 
						"filename" => 'image_filename', 
						"thumbfilename" => 'thumb_filename'
					);

					$upload = array(
						'files' => $files
					);
					
					echo json_encode($upload);
					die();
				}
			}
		}else{
			$upload = array("status" => "error", "msg" => "Oops, something went wrong. Your action may or may not have been completed.");
		}
		
		echo json_encode($upload);
	}
	
	public function delete_unsaved_uploaded_photos(){
		if( $this->input->post('photos') ){
			$photos = $this->input->post('photos');
			$structure = '_assets/images/photos/';
			$arr_photos = explode('|', $photos);
			
			foreach( $arr_photos as $photo ){
				if( $photo != '' && file_exists($structure . $photo) ){
					unlink($structure . $photo);
				}
			}
		}
	}
}

?>