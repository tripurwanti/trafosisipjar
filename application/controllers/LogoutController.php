<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class LogoutController extends CI_Controller
	{
	 	function __construct()
        {
            session_start();
            parent::__construct();
            $this->load->library(array('template','pagination','form_validation','upload'));
            if ( !isset($_SESSION['is_login']) ) {
                   redirect('LoginController');
            }
        }
        
        public function index(){
            
        }
        
        public function logout() {
        	session_unset(['unit_login']);
		    session_unset(['akses_login']);              		
            session_destroy(); //session destroy
            redirect("LoginController");//buka halaman login/v_form
        }
}