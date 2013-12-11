<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Videos extends GLB_Controller {

	public function index() {
		
		$_data 				= array();
		$_data['page'] 		= "videos";
		//$_data['data'] 		= $this->model_videos->get_published_videos();
		$_data['data'] 		= $this->model_videos->get_pub_videos();
		
		$this->load->view('tpl_videos', $_data);
	}
	
	public function get_videos_second($latest_video_id){
		
		$_data['data'] = $this->model_videos->get_pub_videos_second($latest_video_id);
		echo $this->load->view('tpl_videos_second', $_data, TRUE);		
	}
	
	public function get_video($video_id){
		
		$p_video = $this->model_videos->get_video_byid($video_id);
		
		foreach( $p_video as $key => $p_vid ){ 
			foreach( $p_vid as $p_v => $video ){
				$_data[$p_v] = $video;
			}
		}		
		echo $this->load->view('tpl_video', $_data, TRUE);		
	}
}

/* End of file videos.php */
/* Location: ./application/controllers/videos.php */