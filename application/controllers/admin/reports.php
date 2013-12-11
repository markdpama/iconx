<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends GLB_Controller {
	
	function __construct() {
		parent::__construct();
		if (!$this->session->userdata('logged_in')) { redirect('admin/login'); } // logged in?

	}
	
	function server_statistics(){
		
		$_data['page'] 	= "server_statistics";
		$_data['content'] 	= $this->load->view('admin/tpl_server_statistics', $_data, TRUE);
		$this->load->view('admin/tpl_main', $_data);		
	}
}

?>