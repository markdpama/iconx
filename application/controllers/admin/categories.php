<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends GLB_Controller {
	
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')) { redirect(site_url('admin/login')); } // logged in?
	}
	
	public function index()
	{
	
		$_data 							= array();
		$_data['categories'] 			= $this->getCategories();
		$_data['parent_categories'] 	= $this->getParentCategories();
		$_data['sub_categories'] 		= $this->getSubCategories();
		$_data['page'] 					= "categories";
		$_data['content'] 				= $this->load->view('admin/tpl_categories', $_data, TRUE);
		
		$this->load->view('admin/tpl_main', $_data);

	}
}
?>