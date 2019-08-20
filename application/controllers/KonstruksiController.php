<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class KonstruksiController extends CI_Controller
{
    function __construct() {
      session_start();
      parent::__construct();
      $this->load->library(array('template','pagination','form_validation','upload'));
      $this->load->model('Konstruksi');
      $this->load->model('Usulan');
      $this->load->model('Pekerjaan');
      $this->load->model('DaftarKonstruksi');
      $this->load->model('DaftarPekerjaan');

      if ( !isset($_SESSION['is_login']) ) {
        redirect('LoginController');
      }
    }

    public function index() {
        $data['title']="Konstruksi";
        $data['side1']="";
        $data['side2']="";
        $data['side3']="active";
        $data['side4']="";
        $data['side2sub1']="";
        $data['side2sub2']="";
        $data['side2sub3']="";
        $data['side2sub4']="";
        $daftarkonstruksi = new DaftarKonstruksi();
        $data['konstruksi']= $daftarkonstruksi->getAll();
        $this->template->display('KonstruksiViews/daftarKonstruksiView',$data);

    }

    public function tambahKonstruksi() {
        $konstruksi = new Konstruksi();
        $konstruksi->setNama_konstruksi($this->input->post('nama'));
        $konstruksi->setHarga($this->input->post('harga'));
        $konstruksi->add();
        $_SESSION['log']="<div class='alert alert-success alert-dismissable'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <strong>Data Konstruksi berhasil ditambahkan.</strong>
        </div>";
        redirect('KonstruksiController');
        
        // PENGUJIAN INTEGRASI
        // $konstruksi = new Konstruksi();
        // $konstruksi->setNama_konstruksi("konstruksi01");
        // $konstruksi->setHarga('60900');
        // $konstruksi->add();
        // $_SESSION['log']="<div class='alert alert-success alert-dismissable'>
        // <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        // <strong>Data Konstruksi berhasil ditambahkan.</strong>
        // </div>";
        // echo $_SESSION['log'];
    
    }

    public function editKonstruksi($idkons){

          $data['title']="Konstruksi";
          $data['side1']="";
          $data['side2']="";
          $data['side3']="active";
          $data['side4']="";          
          $data['side2sub1']="";
          $data['side2sub2']="";
          $data['side2sub3']="";
          $data['side2sub4']="";

          $konstruksi = new Konstruksi();
          $pekerjaan = new Pekerjaan();
          $daftarpekerjaan = new DaftarPekerjaan();
          $daftarkonstruksi = new DaftarKonstruksi();
          
          $konstruksi->setId_konstruksi($idkons);
          $daftarkonstruksi->setKonstruksi($konstruksi);
          $pekerjaan->setKonstruksi($konstruksi);
          $data['konstruksi'] = $daftarkonstruksi->getDataKonstruksi()->row();
          $data['kons_pekerjaan'] = $pekerjaan->get_konstruksi_dlm_pekerjaan()->result();
          $data['pekerjaan'] = $daftarpekerjaan->getAll(); 
          $this->template->display('KonstruksiViews/editKonstruksiView',$data);

    }

    public function updateKonstruksi($idkons){
          $m_konstruksi = new Konstruksi();
          $daftarkonstruksi = new DaftarKonstruksi();
          $m_usulan = new Usulan();
          $pekerjaan = new Pekerjaan();
          $m_konstruksi->setId_konstruksi($idkons);
          $m_konstruksi->setNama_konstruksi($this->input->post('nama'));
          $m_konstruksi->setHarga($this->input->post('harga'));         
          $m_konstruksi->update();
          $daftarkonstruksi->setKonstruksi($m_konstruksi);
          $data['konstruksi_usulan'] = $daftarkonstruksi->getAllTahap12();          
          foreach ($data['konstruksi_usulan'] as $key) {
            $temp_hargatotal = intval($key->VOLUME_KONSTRUKSI * $m_konstruksi->getHarga());
            $pekerjaan->setId_pekerjaan($key->ID_PEKERJAAN);
            $m_usulan->setId_usulan($key->ID_USULAN);
            $m_konstruksi->setTotalHarga($temp_hargatotal);
            $pekerjaan->setKonstruksi($m_konstruksi);
            $m_usulan->setPekerjaan($pekerjaan);
            $m_usulan->countTotalHarga();

          }

          $_SESSION['log']="<div class='alert alert-success alert-dismissable'>
          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
          <strong>Data konstruksi berhasil diperbarui.</strong>
          </div>";
          redirect('KonstruksiController/editKonstruksi/'.$m_konstruksi->getID_konstruksi());

    }

    public function hapusKonstruksi($idkons){
        $konstruksi = new Konstruksi();
        $konstruksi->setId_konstruksi($idkons);
        $konstruksi->delete();
        $_SESSION['log']="<div class='alert alert-success alert-dismissable'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <b>Konstruksi berhasil dihapus.</b>
        </div>";
        
		redirect('KonstruksiController');
    }

    public function tambah_konstruksi_dlm_pekerjaan($idkons){
        $konstruksi = new Konstruksi();
        $pekerjaan = new Pekerjaan();
        $konstruksi->setId_konstruksi($idkons);
        $pekerjaan->setId_pekerjaan($this->input->post('pekerjaan'));
        $pekerjaan->setKonstruksi($konstruksi);
        $cek = $pekerjaan->cek_konstruksi_dlm_pekerjaan()->num_rows();
        if ( $cek <= 0) {
            $add = $pekerjaan->add_konstruksi_dlm_pekerjaan();
            if ($add == TRUE){
                $_SESSION['log']="<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <b>Konstruksi berhasil di tambahkan dalam Pekerjaan.</b>
                </div>";
            }
            else {
                $_SESSION['log']="<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <b>Tidak dapat menyimpan data!</b> Silakan pilih Pekerjaan.
                </div>";
            }  
        }
        else {
            $_SESSION['log']="<div class='alert alert-danger alert-dismissable'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <b>Konstruksi sudah ada dalam Pekerjaan.</b>
            </div>";
        }
        redirect('KonstruksiController/editKonstruksi/'. $konstruksi->getId_konstruksi());

        // PENGUJIAN INTEGRASI

        // $konstruksi = new Konstruksi();
        // $pekerjaan = new Pekerjaan();
        // $konstruksi->setId_konstruksi('KONS341');
        // // sudah ada dalam pekerjaan
        // // $pekerjaan->setId_pekerjaan('SUBPRK002');

        // // berhasil dimasukkan dalam pekerjaan
        // $pekerjaan->setId_pekerjaan('SUBPRK002');


        // // tidak memilih pekerjaan
        // // $pekerjaan->setId_pekerjaan(NULL);

        // $pekerjaan->setKonstruksi($konstruksi);
        // $cek = $pekerjaan->cek_konstruksi_dlm_pekerjaan()->num_rows();
        // if ( $cek <= 0) {
        //     $add = $pekerjaan->add_konstruksi_dlm_pekerjaan();
        //     if ($add == TRUE){
        //         $_SESSION['log']="<div class='alert alert-success alert-dismissable'>
        //         <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        //         <b>Konstruksi berhasil di tambahkan dalam Pekerjaan.</b>
        //         </div>";
        //     }
        //     else {
        //         $_SESSION['log']="<div class='alert alert-danger alert-dismissable'>
        //         <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        //         <b>Tidak dapat menyimpan data!</b> Silakan pilih Pekerjaan.
        //         </div>";
        //     }  
        // }
        // else {
        //     $_SESSION['log']="<div class='alert alert-danger alert-dismissable'>
        //     <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        //     <b>Konstruksi sudah ada dalam Pekerjaan.</b>
        //     </div>";
        // }
        // echo $_SESSION['log'];
    }
         
    public function hapus_konstruksi_dlm_pekerjaan($idpekerjaan,$idkons){
        $pekerjaan = new Pekerjaan();
        $konstruksi = new Konstruksi();
        $konstruksi->setId_konstruksi($idkons);
        $pekerjaan->setId_pekerjaan($idpekerjaan);
        $pekerjaan->setKonstruksi($konstruksi);
        $pekerjaan->delete_konstruksi_dlm_pekerjaan();

        $_SESSION['log']="<div class='alert alert-success alert-dismissable'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <b>Konstruksi berhasil dihapus dalam Pekerjaan.</b>
        </div>";
        
		redirect('KonstruksiController/editKonstruksi/'.$konstruksi->getId_konstruksi());
    }
      
}
