<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends GLB_Controller 
{

	public function index()
	{
		$this->session->sess_destroy();
		redirect('admin/login', 'refresh');
		return;
	}
	
}
?>