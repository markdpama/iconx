<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plus extends GLB_Controller {
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	public function index()
	{

		$this->load->library('GooglePlus','googleplus');
		
	}
	

	
}
?>
