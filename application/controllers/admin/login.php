<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends GLB_Controller {
	
	function __construct()
	{
		parent::__construct();
		if ( $this->session->userdata('logged_in') ) { redirect('admin/dashboard'); } // logged in?
	}
	
	public function index()
	{

		$_data 				= array();
		$_data['page'] 		= "login";
		
		$this->load->view('admin/tpl_login', $_data);

	}
	
	public function process_login() {	
	
		$username 	= $this->input->post('username');
		$password 	= md5($this->input->post('password'));
		$timestamp 	= date("Y-m-d H:i:s");
		
		// retrieve browser
		$browser = $this->detectBrowser();		
		
		$user_details = $this->model_users->login( $username, $password );
		
		if ( $user_details['account_status'] == 1 ) {
		
			ob_start();
			session_start();
			$newdata = array( 	'user_id' => $user_details['user_id'],
								'username'  => $user_details['username'],
								'user_type'  => $user_details['user_type'],
								'last_login'  => $user_details['last_login'],
								'last_login_ip'  => $user_details['last_login_ip'],
								'first_name'  => $user_details['first_name'],
								'last_name'  => $user_details['last_name'],
								'browser'  => $browser,
								'logged_in' => TRUE);
								
			$this->session->set_userdata($newdata);
			
			echo "1";
			
		} else {
			echo "0";
		}
 		
	}
	
	public function process_login_ldap() {	
		
		$username 	= $this->input->post('username');
		$password 	= $this->input->post('password');
		$timestamp 	= date("Y-m-d H:i:s");		
		$browser 	= $this->detectBrowser();		
		
		$user_details = $this-> loginAuthentication( $username , $password );

		if ( $user_details ) {
		
			ob_start();
			session_start();
			$newdata = array( 	'user_id' => $user_details['uid'],
								'username'  => $user_details['uid'],
								'first_name'  => $user_details['givenname'],
								'last_name'  => $user_details['surname'],
								'browser'  => $browser,
								'logged_in' => TRUE);						
			$this->session->set_userdata($newdata);
			
			echo "1";
			
		} else {
			echo "0";
		}
 		
	}
	
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
	
}
?>