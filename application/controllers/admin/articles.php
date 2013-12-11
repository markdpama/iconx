<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends GLB_Controller {
	
	function __construct() {
		parent::__construct();
		if (!$this->session->userdata('logged_in')) { redirect('admin/login'); } // logged in?

	}
	
	public function index() {

		$_data 				= array();
		$_data['articles'] 	= $this->getArticles();
		$_data['category'] 	= $this->get_categories();
		$_data['page'] 		= "articles";
		$_data['content'] 	= $this->load->view('admin/tpl_articles', $_data, TRUE);
		
		$this->load->view('admin/tpl_main', $_data);
		
	}
	
	public function add_article() {
	
		$_data 					= array();
		$_data['page'] 			= "article";
		$_data['content'] 		= $this->load->view('admin/tpl_articles_add', $_data, TRUE);
		
		$this->load->view('admin/tpl_main', $_data);	
	}
	
	public function edit_article( $post_id ){
	
		$p_article = $this->getArticle($post_id);
		$_data 					= array();
		
		foreach( $p_article as $key => $p_art ){
			foreach( $p_art as $p_k => $post ){
				$_data[$p_k] = $post;
			}
		}
		
		$_data['page'] 			= "article";
		$_data['content'] 		= $this->load->view('admin/tpl_articles_edit', $_data, TRUE);
		
		$this->load->view('admin/tpl_main', $_data);		
		
	}
	
	public function process_add() {
		
		$title 				= addslashes($this->input->post('title', TRUE));
		$subtitle 			= addslashes($this->input->post('subtitle', TRUE));
		$alias 				= $this->clean($title);
		$this->config->set_item('global_xss_filtering', false);
		$content 			= mysql_real_escape_string($this->input->post('content'));
		$this->config->set_item('global_xss_filtering', true);
		$status 			= $this->input->post('status', TRUE);
		$catid 				= $this->input->post('category', TRUE);
		$created 			= date("Y-m-d H:i:s");
		$created_by 		= $this->input->post('author_name', TRUE); 
		$created_by_alias 	= $this->clean($this->input->post('author_name', TRUE));
		$modified 			= ""; // for now
		$publish_up 		= $this->input->post('published', TRUE);
		$image	 			= $this->input->post('featured_image_name', TRUE);
		$metakey 			= ""; // for now
		$metadesc 			= ""; // for now
		$hits 				= ""; // for now
		$featured 			= ""; // for now
			
		$this->model_articles->add_article( $title, $subtitle,$alias, $content, $status, $catid, 
											$created, $created_by, $created_by_alias, 
											$publish_up, $image, $metakey, 
											$metadesc, $hits , $featured );
											
		$_data 					= array();
		$_data['articles'] 		= $this->getArticles();
		$_data['category'] 		= $this->get_categories();
		$_data['page'] 			= "articles";
		$_data['content'] 		= $this->load->view('admin/tpl_articles', $_data, TRUE);
		
		$this->load->view('admin/tpl_articles', $_data);
		
		return;
		
	}
	
	public function process_edit() {
		
		$post_id			= $this->input->post('post_id', TRUE);
		$title 				= addslashes($this->input->post('title', TRUE));
		$subtitle 			= addslashes($this->input->post('subtitle', TRUE));
		$alias 				= $this->clean($title);
		$this->config->set_item('global_xss_filtering', false);
		$content 			= mysql_real_escape_string($this->input->post('content'));
		$this->config->set_item('global_xss_filtering', true);
		$status 			= $this->input->post('status', TRUE);
		$catid 				= $this->input->post('category', TRUE);
		$created 			= $this->input->post('created', TRUE);
		$created_by 		= $this->input->post('author_name', TRUE);  // for now
		$created_by_alias 	= $this->clean($this->input->post('author_name', TRUE));// for now
		$modified 			= date("Y-m-d H:i:s"); // for now
		$modified_by 		= $created_by_alias; // for now
		$publish_up 		= $this->input->post('published', TRUE);
		$image	 			= $this->input->post('featured_image_name', TRUE);
		$metakey 			= ""; // for now
		$metadesc 			= ""; // for now
		$hits 				= ""; // for now
		$featured 			= ""; // for now
			
		$this->model_articles->update_article( $post_id, $title,$subtitle, $alias, $content, $status, $catid, 
											$created, $created_by, $created_by_alias, $modified, $modified_by,
											$publish_up, $image, $metakey, $metadesc);								
		$_data 					= array();
		$_data['articles'] 		= $this->getArticles();
		$_data['category'] 		= $this->get_categories();
		$_data['page'] 			= "articles";
		$_data['content'] 		= $this->load->view('admin/tpl_articles', $_data, TRUE);
		
		$this->load->view('admin/tpl_articles', $_data);
		
		return;
		
	}
	
	public function process_delete(){
		
		$post_id = $this->input->post('post_id');
		$this->model_articles->delete_article($post_id);
		
		$_data 					= array();
		$_data['articles'] 		= $this->getArticles();
		$_data['category'] 		= $this->get_categories();
		$_data['page'] 			= "articles";
		$_data['content'] 		= $this->load->view('admin/tpl_articles', $_data, TRUE);
		
		$this->load->view('admin/tpl_articles', $_data);		
	}

	public function upload_image(){
		
		if($_FILES['article_image']['size'] != 0){
		
			$file_path 					= "_assets/images/articles/";
			$thumb_image_path 			= $file_path.'thumbnails/';	
			$thumb_image_medium_path 	= $file_path.'medium/';	
			$file_name					= $_FILES["article_image"]['name'];

			$config['upload_path'] 		= $file_path;
			$config['allowed_types'] 	= 'gif|jpg|png';
			$config['max_size']			= '9999';
			$config['file_name']		= $_FILES["article_image"]['name'];		
			
			$this->load->library('upload', $config);
			
			if (!$this->upload->do_upload("article_image")) {
			
				$msg = $this->upload->display_errors();
				$status = 'error-'.$_FILES['article_image'].'-'.$file_name.'--'.$msg;
				$upload = array("status" => "error", "msg" => $msg, "filename" => $file_name);

			} else {

				$image_data = $this->upload->data();
				$this->load->library('image_lib');
				
				/* First size */
				$configSize1['image_library']   = 'gd2';
				$configSize1["img_field"] 			= $image_data['file_name'];
				$configSize1['source_image']    = $image_data['full_path'];
				$configSize1['maintain_ratio']  = false;
				$configSize1['maintain_ratio']  = TRUE;
				$configSize1['width']           = 100;
				$configSize1['height']          = 70;
				$configSize1['x_axis']		= 20;
				$configSize1['y_axis']		= 20;
				$configSize1['new_image']  		= $thumb_image_path;

				$this->image_lib->initialize($configSize1);
				$this->image_lib->resize();
				$this->image_lib->clear();

				/* Second size */    
				$configSize2['image_library']   = 'gd2';
				$configSize2["img_field"] 		= $image_data['file_name'];
				$configSize2['source_image']    = $image_data['full_path'];
				$configSize2['maintain_ratio']  = false;
				$configSize1['maintain_ratio']  = TRUE;
				$configSize2['width']           = 175;
				$configSize2['height']          = 115;
				$configSize2['x_axis']		= 20;
				$configSize2['y_axis']		= 20;
				$configSize2['new_image']   	= $thumb_image_medium_path;

				$this->image_lib->initialize($configSize2);
				$this->image_lib->resize();
				$this->image_lib->clear();
	
				
				$status = "success";
			
				$msg = "File successfully uploaded";
				
				$upload = array("status" => $status, "msg" => $msg, "filename" => $image_data['file_name']);
				//$upload = base_url()."admin/articles/preview_featured_image/".$file_name;
				
			}
			
		} else {
		
			$upload = array("status" => "error", "msg" => "Oops, something went wrong. Your action may or may not have been completed.");;
			
		}
		
		echo json_encode($upload);
	}

	public function preview_featured_image($filename){
		echo '<img src="'.base_url().'_assets/images/article/'.$filename.'" height="100"/>';
	}

	public function get_categories(){

		$categories	= $this->model_categories->get_categories();
		
		foreach( $categories as $key => $category ){
			$c_key = $category['id'];
			foreach( $category as $p_k => $cat ){
				$_cat[$c_key][$p_k] = $cat;
			}
		}
		
		return $_cat;
	}

	public function insert_image(){
	
		if($_FILES['insert_image']['size'] != 0){
		
			$file_path 					= "_assets/images/articles/";
			$thumb_image_path 			= $file_path.'thumbnails/';	
			$file_name					= $_FILES["insert_image"]['name'];

			$config['upload_path'] 		= $file_path;
			$config['allowed_types'] 	= 'gif|jpg|png';
			$config['max_size']			= '9999';
			$config['file_name']		= $_FILES["insert_image"]['name'];		
			
			$this->load->library('upload', $config);
			
			if (!$this->upload->do_upload("insert_image")) {
			
				$msg = $this->upload->display_errors();
				$status = 'error-'.$_FILES['insert_image'].'-'.$file_name.'--'.$msg;
				$upload = array("status" => "error", "msg" => $msg, "filename" => $file_name);

			} else {

				$image_data = $this->upload->data();
				 
				$upload_data["img_field"] 			= $image_data['file_name'];
				$config_thumbs['source_image']		= $image_data['full_path'];
				$config_thumbs['new_image']			= $thumb_image_path;
				$config_thumbs['maintain_ration']	= true;
				//$config_thumbs['width']			= 100;
				//$config_thumbs['height']			= 70;
				//$config_thumbs['x_axis']			= 20;
				//$config_thumbs['y_axis']			= 20;
				
				$this->load->library('image_lib', $config_thumbs);
				$this->image_lib->resize();

				$status = "success";
			
				$msg = "File successfully uploaded";
				
				$upload = array("status" => $status, "msg" => $msg, "filename" => "../../_assets/images/articles/".$image_data['file_name']);
				//$upload = base_url()."admin/articles/preview_featured_image/".$file_name;
				
			}
			
		} else {
		
			$upload = array("status" => "error", "msg" => "Oops, something went wrong. Your action may or may not have been completed.");;
			
		}
		
		echo json_encode($upload);
	}	
}

?>