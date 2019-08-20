<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TestUnit extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        $this->load->library('unit_test');
        $this->load->model('Usulan');
        $this->load->model('DaftarUsulan');
        $this->load->model('Status');
        $this->usulan = new Usulan();
        $this->daftarusulan = new DaftarUsulan();
        
	}

    public function index()
	{
        // $this->test();
     
        
        echo "Pengujian Unit Method add() klas Usulan"."<br/><br/>";
        $test =  $this->usulan->add();
        $expected_result = true;
        $test_name = "Method add() Klas Usulan";
        echo $this->unit->run($test,$expected_result,$test_name);

        // echo "Pengujian Unit Method addStatus() klas Usulan (ID_USULAN TIDAK NULL)"."<br/><br/>";
        // $test =  $this->usulan->addstatus();
        // $expected_result = true;
        // $test_name = "Method addStatus id_usulan tidak NULL";
        // echo $this->unit->run($test,$expected_result,$test_name);

        // echo "Pengujian Unit Method addStatus() klas Usulan (ID_USULAN NULL)"."<br/><br/>";        
        // $test =  $this->usulan->addstatus();
        // $expected_result = false;
        // $test_name = "Method addStatus id_usulan NULL";
        // echo $this->unit->run($test,$expected_result,$test_name);

        // echo "Pengujian Unit Method getDataUsulan() klas DaftarUsulan"."<br/><br/>";
        // $test =  $this->daftarusulan->getDataUsulan();
        // $expected_result = true;
        // $test_name = "Method getDataUsulan";
        // echo $this->unit->run($test,$expected_result,$test_name);


         // $test =  $this->driver_insert_konstruksi();
        // $expected_result = true;
        // $test_name = "Method insert() Klas Konstruksi";
        // echo $this->unit->run($test,$expected_result,$test_name);

        // $test =  $this->driver_insert_konstruksi_pekerjaan();
        // $expected_result = false;
        // $test_name = "Method insert_konstruksi_on_pekerjaan() Klas Pekerjaan id_pekerjaan NULL";
        // echo $this->unit->run($test,$expected_result,$test_name);

        // $test =  $this->driver_insert_konstruksi_pekerjaan2();
        // $expected_result = true;
        // $test_name = "Method insert_konstruksi_on_pekerjaan() Klas Pekerjaan id_pekerjaan tidak NULL";
        // echo $this->unit->run($test,$expected_result,$test_name);
      
    }


}
