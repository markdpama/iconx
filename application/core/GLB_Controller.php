<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GLB_Controller extends CI_Controller {

	
	public function loginAuthentication( $username , $password ) {
	
		$ldap_conn = ldap_connect("filament.dyndns.info", "389");
		ldap_set_option($ldap_conn,LDAP_OPT_PROTOCOL_VERSION,3) or die("Could not connect to LDAP server.");
		
		if ( $ldap_conn ) {
		
			$rdn = "uid=".$username.",ou=People,dc=dyndns,dc=info";
			$ldapbind = @ldap_bind($ldap_conn, $rdn, $password);
		
			if ( $ldapbind ) {
			
				$sr = ldap_search($ldap_conn, "ou=People,dc=dyndns,dc=info", "uid=".$username."");  
				$info = ldap_get_entries($ldap_conn, $sr);
				
				$user_info = array();
				$user_info['uid'] 		= $info[0]["uid"][0];
				$user_info['name'] 		= $info[0]["cn"][0];
				$user_info['givenname'] = $info[0]["givenname"][0];
				$user_info['surname'] 	= $info[0]["sn"][0];

				return $user_info;
				
			} else {
				return NULL;
			}	
		} else {
			return NULL;
		}	
	}
		
	function detectBrowser() {
		$u_agent = $_SERVER['HTTP_USER_AGENT'];
		$ub = '';
		if(preg_match('/MSIE/i',$u_agent)) { $ub = "ie"; }
		if(preg_match('/Firefox/i',$u_agent)) { $ub = "firefox"; }
		if(preg_match('/Safari/i',$u_agent)) { $ub = "safari"; }
		if(preg_match('/Chrome/i',$u_agent)) { $ub = "chrome"; }
		if(preg_match('/Flock/i',$u_agent)) { $ub = "flock"; }
		if(preg_match('/Opera/i',$u_agent)) { $ub = "opera"; }
		return $ub;
	}
	
	public function clean($string) {
	   $string = str_replace(' ', '-', strtolower($string)); // Replaces all spaces with hyphens.
	   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}

	public function getCategories(){
	
		return $this->model_categories->get_categories();
	
	}
	
	public function getParentCategories(){
	
		return $this->model_categories->get_parent_categories();
	
	}
	public function getSubCategories(){
	
		return $this->model_categories->get_sub_categories();
	
	}

	public function getArticles(){
	
		return $this->model_articles->get_articles();
	
	}	
	
	public function getArticle($post_id){
	
		return $this->model_articles->select_article($post_id)	;
	}

	public function getVideos(){
	
		return $this->model_videos->get_videos();
	
	}		

	public function getVideo($video_id){
	
		return $this->model_videos->select_video($video_id)	;
	
	}

	public function uploadImage() {
	
	
	}
	
}

?>