<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Videos extends GLB_Controller {
	
	function __construct() {
		parent::__construct();
		if (!$this->session->userdata('logged_in')) { redirect(site_url('admin/login')); } // logged in?

	}
	
	public function index() {
	
		$_data 					= array();
		$_data['videos'] 		= $this->getVideos();
		$_data['page'] 			= "videos";
		$_data['content'] 		= $this->load->view('admin/tpl_videos', $_data, TRUE);
		
		$this->load->view('admin/tpl_main', $_data);

	}
	
	public function add_video() {
	
		$_data 					= array();
		$_data['page'] 			= "videos";
		$_data['content'] 		= $this->load->view('admin/tpl_videos_add', $_data, TRUE);
		
		$this->load->view('admin/tpl_main', $_data);	
	}
	
	public function edit_video( $video_id ){
	
		$p_video 	= $this->getVideo($video_id);
		$_data 		= array();
		
		foreach( $p_video as $key => $video ){
			foreach( $video as $v_k => $v ){
				$_data[$v_k] = $v;
			}
		}
		
		$_data['page'] 			= "article";
		$_data['content'] 		= $this->load->view('admin/tpl_videos_edit', $_data, TRUE);
		
		$this->load->view('admin/tpl_main', $_data);		
		
	}
	
	public function process_add() {
	
		$title 			= addslashes($this->input->post('title', TRUE));
		$alias 			= $this->clean($this->input->post('title', TRUE));
		$type 			= $this->input->post('type', TRUE);
		$mime_type 		= $this->input->post('mime_type', TRUE);
		$token 			= '';
		$video 			= $this->input->post('video_upload_name', TRUE);
		$thumb 			= $this->input->post('thumb_image_name', TRUE);
		$category		= '';
		$description 	= addslashes($this->input->post('description', TRUE));
		$status 		= $this->input->post('status', TRUE);
		$likes			= "";
		$dislikes		= "";
		$uploaded_by	= $this->input->post('uploaded_by', TRUE);
		$published		= date('Y-m-d H:i:s', strtotime($this->input->post('published', TRUE)));
		$sorting		= '';
			
		$this->model_videos->add_videos( $title,$alias,$type,$mime_type,$token,$video,$thumb,$category,
										$description,$status,$likes,$dislikes,$uploaded_by,$published,$sorting );
											
		$_data 					= array();
		$_data['videos'] 		= $this->getVideos();
		$_data['page'] 			= "videos";
		$_data['content'] 		= $this->load->view('admin/tpl_videos', $_data, TRUE);
		
		$this->load->view('admin/tpl_videos', $_data);
		
		return;		
	}
	
	public function process_edit() {
	
		$video_id 		= $this->input->post('video_id', TRUE);
		$title 			= addslashes($this->input->post('title', TRUE));
		$alias 			= $this->clean($this->input->post('title', TRUE));
		$type 			= $this->input->post('type', TRUE);
		$mime_type 		= $this->input->post('mime_type', TRUE);
		$token 			= '';
		$video 			= $this->input->post('video_upload_name', TRUE);
		$thumb 			= $this->input->post('thumb_image_name', TRUE);
		$category		= '';
		$description 	= addslashes($this->input->post('description', TRUE));
		$status 		= $this->input->post('status', TRUE);
		$likes			= "";
		$dislikes		= "";
		$uploaded_by	= $this->input->post('uploaded_by', TRUE);
		$published		= date('Y-m-d H:i:s', strtotime($this->input->post('published', TRUE)));
		$sorting		= '';
		
		$this->model_videos->update_videos( $video_id, $title,$alias,$type,$mime_type,$token,$video,$thumb,$category,
										$description,$status,$likes,$dislikes,$uploaded_by,$published, $sorting );
										
		$_data 					= array();
		$_data['videos'] 		= $this->getVideos();
		$_data['page'] 			= "videos";
		$_data['content'] 		= $this->load->view('admin/tpl_videos', $_data, TRUE);
		
		$this->load->view('admin/tpl_videos', $_data);
		
		return;		
		
		
	}
	
	public function process_delete(){
		
		$file_path	= "../../_assets/videos/";
		$video_id	= $this->input->post('video_id');
		$video_file = $this->input->post('video_file');
		$thumb 		= $this->input->post('video_thumb');
		$this->model_videos->delete_video($video_id);
		//unlink($file_path.$video_file);
		//unlink($file_path."thumb/".$thumb);
		/*
		unlink($_SERVER['DOCUMENT_ROOT']."/filament/barako/iconx-barako/_assets/videos/thumb/mqdefault.jpg");
		$this->load->helper("file");
			
		if(delete_files($file_path."thumb/".$thumb)) {
		 die('deleted successfully');
		// $this->model_videos->delete_video($video_id);
		} else {
		 die( 'errors occured');
		}		
		*/		
		$_data 					= array();
		$_data['videos'] 		= $this->getVideos();
		$_data['page'] 			= "videos";
		$_data['content'] 		= $this->load->view('admin/tpl_videos', $_data, TRUE);
		
		$this->load->view('admin/tpl_videos', $_data);		
	}

	public function upload_thumb_image(){
		
		if($_FILES['thumb_image']['size'] != 0){
		
			$file_path 					= "_assets/videos/thumb";
			$file_name					= $_FILES["thumb_image"]['name'];

			$config['upload_path'] 		= $file_path;
			//$config['allowed_types'] 	= 'mp4|mov|avi|flv|mpg|3gp|rm|wmv';
			$config['allowed_types'] 	= 'gif|jpg|png';
			$config['max_size']			= '9999';
			$config['file_name']		= $_FILES["thumb_image"]['name'];		
			
			$this->load->library('upload', $config);
			
			if (!$this->upload->do_upload("thumb_image")) {
			
				$msg = $this->upload->display_errors();
				$msg_status = 'error-'.$_FILES[$file_name].'-'.$file_name.'--'.$msg;	
				$upload = array("status" => "error", "msg" => strip_tags($msg_status));

			} else {

				$image_data = $this->upload->data();
				 
				$upload_data["img_field"] 			= "thumb_".$image_data['file_name'];
				$config_thumbs['source_image']		= $image_data['full_path'];
				$config_thumbs['new_image']			= $file_path;
				$config_thumbs['maintain_ration']	= true;
				$config_thumbs['width']				= 320;
				$config_thumbs['height']			= 140;
				$config_thumbs['x_axis']			= 20;
				$config_thumbs['y_axis']			= 20;
				
				$this->load->library('image_lib', $config_thumbs);
				$this->image_lib->resize();

				$status = "success";
			
				$msg = "File successfully uploaded";
				
				$upload = array("status" => $status, "msg" => $msg, "filename" => $image_data['file_name']);
				//$upload = base_url()."admin/articles/preview_featured_image/".$file_name;
				
			}
			
		} else {
		
			$upload = array("status" => "error", "msg" => "Oops, something went wrong. Your action may or may not have been completed.");
			
		}
		
		echo json_encode($upload);
	}

	public function upload_video(){
	
		ini_set('memory_limit', '1024M' );
		ini_set('upload_max_filesize', '1024M');  
		ini_set('post_max_size', '1024M');  
		ini_set('max_input_time', 3600);  
		ini_set('max_execution_time', 3600);	
		
		if($_FILES['video_file']['size'] != 0){
		
			$file_path 					= "_assets/videos/";
			$file_name					= $_FILES["video_file"]['name'];
			$file_type					= $_FILES["video_file"]['type'];

			$config['upload_path'] 		= $file_path;
			$config['allowed_types'] 	= 'mp4|mov|avi|flv|mpg|3gp|rm|wmv';
			$config['max_size']			= '1073741824';
			$config['file_name']		= $_FILES["video_file"]['name'];		
			
			$this->load->library('upload', $config);
			
			if (!$this->upload->do_upload("video_file")) {
			
				$msg = $this->upload->display_errors();
				$msg_status = 'error-'.'-'.$file_name.'--'.$msg;	
				$upload = array("status" => "error", "msg" => strip_tags($msg_status));

			} else {
				
				$video_data 	= $this->upload->data();
				$v_file_name 	= $video_data['file_name'];
				
				$upload = array("status" => "success", "msg" => "Video successfully uploaded", "filename" => $v_file_name, "file_type" => $file_type);
				
			}
			
		} else {
		
			$upload = array("status" => "error", "msg" => "Oops, something went wrong. Your action may or may not have been completed.");
			
		}
		
		echo json_encode($upload);
	}
	
	public function preview_featured_image($filename){
		echo '<img src="'.base_url().'_assets/images/article/'.$filename.'" height="100"/>';
	}
}

?>