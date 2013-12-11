<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends GLB_Controller {

	public function index() {
		
		$_data 					= array();
		$_data['page'] 			= "home";
		$_data['news']      	= $this->model_articles->get_latest_news();
		$_data['latest_video']  = $this->model_videos->get_latest_video();
		$_data['content'] 		= $this->load->view('tpl_home', $_data, TRUE);
		
		$this->load->view('tpl_main', $_data);
	}

	public function get_latest_news(){
		$_data['ctr'] = "first";
		$_data['data'] = $this->model_articles->get_latest_news();
		return $this->load->view('tpl_articles_latest_news', $_data,TRUE);
	}	
	
	public function get_latest_news_second($last_post_id){
		$_data['ctr'] = "second";
		$_data['data'] = $this->model_articles->get_latest_news_second($last_post_id);
		echo $this->load->view('tpl_articles_latest_news', $_data, TRUE);			

	}	
	public function flip_news(){
		
		$_data['data'] = $this->model_articles->get_articles();
		echo $this->load->view('tpl_flip_news', $_data, TRUE);			

	}
	
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */