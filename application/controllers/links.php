<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Links extends GLB_Controller {

	public function index() {
		
		$_data 				= array();
		$_data['page'] 		= "links";
		$_data['testing'] 	= $this->linkouts();
		
		$this->load->view('tpl_links', $_data);
	}

	public function linkouts(){
		
		//$_data['data'] = $this->model_articles->get_articles();
		echo $this->load->view('tpl_linkouts');			

	}
	
	public function tools(){
		
		//$_data['data'] = $this->model_articles->get_articles();
		echo $this->load->view('tpl_tools');			

	}
}

/* End of file links.php */
/* Location: ./application/controllers/links.php */