<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * GooglePlus CI Implementation
 * @author   Mark - markdpama@gmail.com
 */

require_once BASEPATH.'../google-api-php-client/src/Google_Client.php';
require_once BASEPATH.'../google-api-php-client/src/contrib/Google_PlusService.php';

class GooglePlus
{
	
	function __construct(){
		global $apiConfig;
		
		$this->client = new Google_Client();
		$this->client->setApplicationName("IconX - GooglePlus Integration");
		
		$this->plus = new Google_PlusService($this->client);
		
		//--LOGOUT
		if (isset($_REQUEST['logout'])) {
		   $this->session->unset_userdata('access_token');
		   redirect('?userloggedout=true');
		}
		
		//--USER AUTHENTICATED
		if (isset($_GET['code'])) {
		  
		  $this->client->authenticate($_GET['code']);
		  $this->session->userdata('access_token', $this->client->getAccessToken() );
		  
		  redirect('plus/?userloggedin=true');
		
		}
		
		//--USER IS NOT LOGGED-IN
		if ( !$this->client->getAccessToken() ) {
			redirect( $this->client->createAuthUrl() );
			//echo( $this->client->createAuthUrl() );
		}
		
		
	}
	
	function getPlusObject(){
		return $this->plus;
	}
	
	function getClientObject(){
		return $this->client;
	}
	

}


?>
