<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends GLB_Controller {
	
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')) { redirect('admin/login'); } // logged in?
	}
	
	public function index()
	{		
		$_data 				= array();
		$_data['page'] 		= "dashboard";
		$_data['articles'] 	= $this->model_articles->dash_latest_articles();
		$_data['content'] 	= $this->load->view('admin/tpl_dashboard', $_data, TRUE);
		
		$this->load->view('admin/tpl_main', $_data);

	}
}
?>