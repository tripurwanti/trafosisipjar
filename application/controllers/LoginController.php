<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class LoginController extends CI_Controller {

    function __construct(){
        session_start(); //mengadakan session
        parent::__construct();
        
		$this->load->model('Pegawai');
        $this->load->model('Unit');
        $this->load->model('Akun');
        $this->load->library(array('template','form_validation','upload'));
    }

    public function index(){
        if ( isset($_SESSION['is_login']) ) 
			{ //cek apakah session ada
				redirect('LoginController/Home');
            }
            else if (!isset($_SESSION['is_login'])){
                if (isset($_SESSION['log'])){
                    $data['log'] = $_SESSION['log'];
                    $this->load->view('loginView',$data);    
                }
                else {
                    $this->load->view('loginView');
                }
                

            }
			
    }

    public function login() {       
        $this->load->library('form_validation'); //load library form_validation
        $this->form_validation->set_rules('username', 'Username', 'required'); //cek, validasi username
        $this->form_validation->set_rules('password', 'Password', 'required'); //cek, validasi password

        $m_unit = new Unit();
        if ($this->form_validation->run() == TRUE ) //apabila validasi true (benar semua)
        { 
            $user = new Akun();
            $pegawai = new Pegawai(); 
          	$user->setUsername($this->input->post('username'));
            $user->setPassword(md5($this->input->post('password')));
            $pegawai->setAkun($user);   
            $data = $pegawai->cekUsername()->row();
            if ($pegawai->cekUsername()->num_rows() == 0) {
                $_SESSION['log']="<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <b>Username</b> yang anda masukkan salah
                </div>";
                redirect('LoginController');
            }

            else if ($user->getPassword() != $data->PASSWORD)  {
                $_SESSION['log']="<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <b>Password</b> yang anda masukkan salah
                </div>";
                redirect('LoginController');
            }
            else {

                $_SESSION['is_login'] = TRUE;
                $_SESSION['nip']= $data->NIP;
                $_SESSION['nama']= $data->NAMA;
                $_SESSION['username']= $data->USERNAME;
                $_SESSION['akses_login']= $data->JABATAN;
                $_SESSION['unit_login']= $data->UNIT;
                $_SESSION['log']="";
                redirect('LoginController/home');
            }
         }
    }

    public function home(){

        $data['title']="Home";
		$data['side1']="active";
		$data['side2']="";
		$data['side3']="";
		$data['side4']="";
		
		$data['side2sub1']="";
		$data['side2sub2']="";
		$data['side2sub3']="";
        $data['side2sub4']="";
        
        $this->template->display('homeView',$data);
    }
  

}

?>