<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Flippage extends GLB_Controller {

	public function index() {
		
		$_data 			= array();
		$_data['page'] 	= "flippage";
		//create a error file class
		$this->load->view('tpl_articles', $_data);
	}
	
	public function news(){
	
		$_data 			= array();
		$_data['page'] 	= "flippage";
		$_data['data'] 	= $this->model_articles->get_20latest_news();
		$this->load->view('tpl_flip_page', $_data);
	
	}
	
	public function product_and_promos(){
	
		$_data 			= array();
		$_data['page'] 	= "flippage";
		$_data['data'] 	= $this->model_articles->get_20latest_prods_proms();
		$this->load->view('tpl_flip_page', $_data);
	
	}
}

/* End of file articles.php */
/* Location: ./application/controllers/articles.php */