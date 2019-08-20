<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TestIntegrasi extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        $this->load->library('unit_test');
        $this->load->model('Usulan');
		$this->load->model('Status');
		$this->load->model('Pekerjaan');
		$this->load->model('Konstruksi');
		$this->load->model('Unit');
		$this->load->model('DaftarUsulan');
		$this->load->model('DaftarKonstruksi');
		$this->load->model('DaftarPekerjaan');
		$this->load->library('../controllers/UsulanController');
		$this->load->library('../controllers/KonstruksiController');
        
	}
 


     public function index()
     {
       
		// $tambah_usulan = new UsulanController();
		// $tambah_usulan->tambahUsulan2();

		$tambahkonstruksi = new KonstruksiController();
		// $tambahkonstruksi->tambahKonstruksi2();
		$tambahkonstruksi->tambah_konstruksi_dlm_pekerjaan2();
       
        
     }

	
	


}
