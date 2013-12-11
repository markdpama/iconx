<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photos extends GLB_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('model_albums');
		$this->load->model('model_photos');
	}
	
	public function index() {
		
		$_data 				= array();
		$_data['page'] 		= "photos";
		
		$this->load->view('tpl_photos', $_data);
		
	}
	
	public function albumlist() {
	
		$_data['data'] 	= $this->model_albums->get_pub_album();
		echo $this->load->view('tpl_albumlist', $_data, TRUE);	
		
	}
	
	public function albumlist_second($latest_album_date) {
	
		$_data['data'] = $this->model_albums->get_pub_album_second($latest_album_date);
		echo $this->load->view('tpl_albumlist_second', $_data, TRUE);
		
	}
	
	public function get_photos($album_id) {
	
		$_data['data'] = $this->model_photos->get_photos_by_album($album_id);
		$_data['albumInfo'] = $this->model_albums->getAlbumDetails($album_id);
		echo $this->load->view('tpl_album_photos', $_data, TRUE);	
	}
	
	public function get_photo_info($photo_id) {

		$photos_info = $this->model_photos->get_photos_info($photo_id);
	  
		foreach( $photos_info as $key => $p_info ){
			foreach( $p_info as $p_k => $photo ){
				$_data[$p_k] = $photo;
			}
		}
		
		echo $this->load->view('tpl_photo_info', $_data, TRUE);	
	}
	
}

/* End of file photos.php */
/* Location: ./application/controllers/photos.php */