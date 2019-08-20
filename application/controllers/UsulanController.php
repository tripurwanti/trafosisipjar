<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Load library phpspreadsheet
require('./excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
// End load library phpspreadsheet

class UsulanController extends CI_Controller
{
	function __construct()
	{
		session_start();
		parent::__construct();
		$this->load->library(array('template','pagination','form_validation','upload'));
		$this->load->model('Usulan');
		$this->load->model('Status');
		$this->load->model('Pekerjaan');
		$this->load->model('Konstruksi');
		$this->load->model('Unit');
		$this->load->model('Gambar');
		$this->load->model('DaftarUsulan');
		$this->load->model('DaftarKonstruksi');
		$this->load->model('DaftarPekerjaan');
		if ( !isset($_SESSION['is_login']) ) {
			redirect('LoginController');
		}
	}

	public function index(){
		
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

	public function daftarUsulan(){
		$daftarusulan = new DaftarUsulan();
		$usulan = new Usulan();
		$unit = new Unit();

		$data['side1']="";
		$data['side2']="active";
		$data['side3']="";
		$data['side4']="";
		$data['side2sub1']="";
		$data['side2sub2']="";
		$data['side2sub3']="";
		$data['side2sub4']="";
		$data['tab1'] ="active";
		$data['tab2'] ="";
		$data['tab3'] ="";

		if($_SESSION['unit_login'] != 'UP3'){
			$unit->setNama_unit($_SESSION['unit_login']);
			$usulan->setUnit($unit);
			$daftarusulan->setUsulan($usulan);
			$data['usulan'] = $daftarusulan->getAllUnit($daftarusulan->getUsulan()->getUnit()->getNama_unit()); // parameter objek ulp diakses dr m_usulan
		}
		else if ($_SESSION['akses_login'] == 'PENGAWAS' OR $_SESSION['akses_login'] == 'PEJABAT PENGADAAN' ){
			$data['usulan'] = $daftarusulan->getAllTahap4();
		}
		else {
			$data['usulan'] = $daftarusulan->getAllUp3();
		}
		$this->template->display('UsulanViews/daftarUsulanView',$data);
	}

	public function tambahUsulan() {
		date_default_timezone_set('Asia/Jakarta');
		$daftarusulan = new DaftarUsulan();
		$usulan = new Usulan();
		$unit = new Unit();
		$status = new Status();
		$gambar = new Gambar();

		$usulan->setLokasi($this->input->post('lokasi'));
		$usulan->setExist($this->input->post('exist'));
		$usulan->setKoordinat_exist($this->input->post('koordinatexist'));
		$usulan->setTgl_usulan(date('d-m-Y H:i:s'));
		$usulan->setJml_gangguan($this->input->post('jml_gangguan'));
		$usulan->setDeskripsi_gangguan($this->input->post('deskripsigangguan'));
		$usulan->setTahapan('TAHAP1');
			
		$unit->setId_unit($this->input->post('unit'));
		$usulan->setUnit($unit);
		$status->setStatus('Persetujuan Manajer ULP');
		$usulan->setStatus($status);

		//UPLOAD GAMBAR SURVEY
		$con['upload_path'] = './assets/data_upload/Gambar_Survey/'.$usulan->getLokasi().'';
		$con['allowed_types'] = 'jpg|png|jpeg';
		$this->upload->initialize($con);

		// JIKA DIREKTORI TIDAK ADA
		if (!is_dir('/assets/data_upload/Gambar_Survey/'.$usulan->getLokasi())) {
			mkdir('./assets/data_upload/Gambar_Survey/'.$usulan->getLokasi(),0777,true);
		}

		//JIKA GAMBAR SURVEY TIDAK KOSONG
		if ($this->upload->do_upload('gambarsurvey') == TRUE) {
			$gambar->setNama_file($this->upload->file_name);
			$file_parts = pathinfo($gambar->getNama_file());
			$gambar->setTipe($file_parts['extension']);
			$usulan->setGambar($gambar);
			$usulan->add();

			$daftarusulan->setUsulan($usulan);
			$datausulan = $daftarusulan->getDataUsulan()->row();
			$usulan->setId_usulan($datausulan->ID_USULAN);
			$status->setTgl_status(date('d-m-Y H:i:s'));
			$status->setKeterangan("");
			$usulan->setStatus($status);
			$usulan->addStatus();
			$_SESSION['log']="<div class='alert alert-success alert-dismissable'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
			<strong>Data usulan berhasil ditambah.</strong>
			</div>";	
		}
		else 
		{
			$_SESSION['log']='<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Maaf!</strong> Tidak dapat menyimpan data, Gambar survei harus berekstensi .jpg, .png, atau .jpeg.
			</div>';

		}
		redirect('UsulanController/daftarusulan');


		// PENGUJIAN INTEGRASI

		// date_default_timezone_set('Asia/Jakarta');
		// $daftarusulan = new DaftarUsulan();
		// $usulan = new Usulan();
		// $unit = new Unit();
		// $status = new Status();
		// $gambar = new Gambar();

		// $usulan->setLokasi('Jl. Merbabu2');
		// $usulan->setExist('Dinoyo');
		// $usulan->setKoordinat_exist('S - 07.19.516 E-11247578');
		// $usulan->setTgl_usulan(date('d-m-Y H:i:s'));
		// $usulan->setJml_gangguan('3');
		// $usulan->setDeskripsi_gangguan('1. Lampu ditempat pelanggan X redup 2. Lampu ditempat pelanggan Y padam 3. Trafo di jaringan Y cepat panas');
		// $usulan->setTahapan('TAHAP1');

		
		// $unit->setId_unit('51303');
		// $usulan->setUnit($unit);
		// $status->setStatus('Persetujuan Manajer ULP');
		// $usulan->setStatus($status);

		// //UPLOAD GAMBAR SURVEY
		// $con['upload_path'] = './assets/data_upload/Gambar_Survey/'.$usulan->getLokasi().'';
		// $con['allowed_types'] = 'jpg|png|jpeg';
		// $this->upload->initialize($con);


		// //JIKA GAMBAR SURVEY TIDAK KOSONG
		// $upload = FALSE;
		// if ($upload == TRUE) {
		// 	$gambar->setNama_file('Gambarsurvey.jpg');
		// 	$gambar->setTipe('jpg');
		// 	$usulan->setGambar($gambar);
		// 	$usulan->add();

		// 	$daftarusulan->setUsulan($usulan);
		// 	$datausulan = $daftarusulan->getDataUsulan()->row();
		// 	$usulan->setId_usulan($datausulan->ID_USULAN);
		// 	$status->setTgl_status(date('d-m-Y H:i:s'));
		// 	$status->setKeterangan("");
		// 	$usulan->setStatus($status);
		// 	$usulan->addStatus();
		// 	$_SESSION['log']="<div class='alert alert-success alert-dismissable'>
		// 	<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		// 	<strong>Data usulan berhasil ditambah.</strong>
		// 	</div>";	
		// 	echo $_SESSION['log'];
		// }
		// else 
		// {
		// 	$_SESSION['log']='<div class="alert alert-danger alert-dismissable">
		// 	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		// 	<strong>Maaf!</strong> Tidak dapat menyimpan data, Gambar survey harus berekstensi .jpg, .png, atau .jpeg.
		// 	</div>';
		// 	echo $_SESSION['log'];

		// }
	}

	public function editUsulan($id_usulan){
		$pekerjaan = new Pekerjaan();
		$m_usulan = new Usulan();
		$daftarusulan = new DaftarUsulan();
		$m_konstruksi = new Konstruksi();
		$daftarpekerjaan = new DaftarPekerjaan();
		$data['side1']="";
		$data['side2']="active";
		$data['side3']="";
		$data['side4']="";
		$data['side2sub1']="";
		$data['side2sub2']="";
		$data['side2sub3']="active";
		$data['side2sub4']="";
		$m_usulan->setId_usulan($id_usulan);
		$daftarusulan->setUsulan($m_usulan);
		$data['pekerjaan'] = $daftarpekerjaan->getAll();
		$data['uraian_usulan'] = $daftarusulan->getDataUsulan2();
		$data['unggah_gmbr_survey'] = 
			"<form method='POST' enctype='multipart/form-data' action='".base_url()."UsulanController/updateGambarSurvey/".$m_usulan->getId_usulan()."' class='form-horizontal' role=,'form'>
				<table>
					<tr>
						<td><label>Gambar Survey : &nbsp;&nbsp;</label></td>
						<td><input type='file' class='form-control' name='gambar_survey'></td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
					
						<td><button class='btn btn-primary' type='submit' name='sumbit'>Unggah</button> 
						<a class ='btn btn-danger' href='".base_url()."UsulanController/daftarUsulan'>Batal Unggah</a></td>
						
					</tr>
				</table>
			</form>";

			$data['unggah_gmbr_survey_disabled'] = 
			"<form method='POST' enctype='multipart/form-data' action='".base_url()."UsulanController/updateGambarSurvey/".$m_usulan->getId_usulan()."' class='form-horizontal' role=,'form'>
				<table>
					<tr>
						<td><label>Gambar Survey : &nbsp;&nbsp;</label></td>
						<td><input type='file' class='form-control' name='gambar_survey'></td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
					
						<td><button class='btn btn-primary' type='submit' name='sumbit' disabled >Unggah</button> 
						<a class ='btn btn-danger' href='".base_url()."UsulanController/daftarUsulan'>Batal Unggah</a></td>
						
					</tr>
				</table>
			</form>";
			// <td><button class='btn btn-primary' type='submit' name='sumbit' onclick='return confirm(\"Anda yakin akan memperbarui gambar survei ?\")'>Unggah</button> <a class ='btn btn-danger' href='".base_url()."'UsulanController/daftarUsulan'>Batal Unggah</a></td>


		if (!$m_usulan->getDataKonstruksiUsulan()){
			foreach ($data['pekerjaan'] as $list_pekerjaan) {
				$pekerjaan->setId_pekerjaan($list_pekerjaan->ID_PEKERJAAN);
				$konstruksi = $pekerjaan->get_konstruksi_by_pekerjaan();
				foreach ($konstruksi as $list_konstruksi) {
					$m_konstruksi->setId_konstruksi($list_konstruksi->ID_KONSTRUKSI);
					$m_konstruksi->setVolume_konstruksi(0);
					$m_konstruksi->setTotalHarga(0);
					$pekerjaan->setKonstruksi($m_konstruksi);
					$m_usulan->setPekerjaan($pekerjaan);
					if($m_konstruksi->getId_konstruksi() == NULL){
						continue;
					}
					$m_usulan->add_konstruksi();
				}
					
			}
			$data['konstruksi_usulan'] = $m_usulan->getDataKonstruksiUsulan();	
			$this->template->display('UsulanViews/editUsulanView',$data);
		}
		else {
			$data['konstruksi_usulan'] = $m_usulan->getDataKonstruksiUsulan();
			$this->template->display('UsulanViews/editUsulanView',$data);
		}
	}

	public function updateUraianUsulan($id_usulan){
		date_default_timezone_set('Asia/Jakarta');
		$m_usulan = new Usulan();
		$status = new Status();

		$m_usulan->setId_usulan($id_usulan);	
		$m_usulan->setExist($this->input->post('exist'));
		$m_usulan->setKoordinat_exist($this->input->post('koordinatexist'));
		$m_usulan->setJml_gangguan($this->input->post('jml_gangguan'));
		$m_usulan->setDeskripsi_gangguan($this->input->post('deskripsigangguan'));
		$m_usulan->update_uraian();
		
		$m_usulan->setTahapan('TAHAP1');
		$status->setTgl_status(date('d-m-Y H:i:s'));
		$status->setStatus('Persetujuan Manajer ULP');
		$status->setKeterangan('Data Uraian Telah Di Perbarui SPV Teknik ULP');
		$m_usulan->setStatus($status);
		$m_usulan->addStatus();
		$m_usulan->ubahStatus();

		$_SESSION['log']="<div class='alert alert-success alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		<strong>Data uraian usulan berhasil diperbarui.</strong></div>";
		redirect('UsulanController/editUsulan/'.$m_usulan->getId_usulan());
	
	}

	public function hapusUsulan($id_usulan){
		define('PUBPATH',str_replace(SELF,'',FCPATH));
		$usulan = new Usulan();
		$daftarusulan = new DaftarUsulan();

		$usulan->setId_usulan($id_usulan);
		$daftarusulan->setUsulan($usulan);
		$datausulan = $daftarusulan->getDataUsulan2();
		$lokasigambarsurvey = PUBPATH.'/assets/data_upload/Gambar_Survey/'.$datausulan->LOKASI.'/'.$datausulan->GAMBAR;
		$dirpathgmbrsurvey = PUBPATH.'/assets/data_upload/Gambar_Survey/'.$datausulan->LOKASI;
		unlink($lokasigambarsurvey);
		rmdir($dirpathgmbrsurvey);
		$usulan->delete();
		$_SESSION['log']="<div class='alert alert-success alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		<strong>Data usulan berhasil dihapus.</strong>
		</div>";
		redirect('UsulanController/daftarUsulan');
	}

	public function RincianUsulan($id_usulan){ 
		$pekerjaan = new Pekerjaan();
		$m_usulan = new Usulan();
		$m_konstruksi = new Konstruksi();
		$daftarusulan = new DaftarUsulan();
		$daftarpekerjaan = new DaftarPekerjaan();

		$data['side1']="";
		$data['side2']="active";
		$data['side3']="";
		$data['side4']="";
		$data['side2sub1']="";
		$data['side2sub2']="";
		$data['side2sub3']="active";
		$data['side2sub4']="";

		$m_usulan->setId_usulan($id_usulan); 
		$pekerjaan_temp = $daftarpekerjaan->getAll();
		foreach ($pekerjaan_temp as $list_pekerjaan) {
			$pekerjaan->setId_pekerjaan($list_pekerjaan->ID_PEKERJAAN);
			$konstruksibypekerjaan = $pekerjaan->get_konstruksi_by_pekerjaan();
			foreach ($konstruksibypekerjaan as $list_konstruksi) {
				$m_konstruksi->setId_konstruksi($list_konstruksi->ID_KONSTRUKSI);
				$pekerjaan->setKonstruksi($m_konstruksi);
				$m_usulan->setPekerjaan($pekerjaan);
				$cek = $m_usulan->cekKonstruksi();
				if ($cek <= 0) {
					$m_konstruksi->setVolume_konstruksi(0);
					$m_konstruksi->setTotalHarga(0);
					$m_usulan->add_konstruksi();
				}
			}
		}

		$daftarusulan->setUsulan($m_usulan);
		$data['uraian_usulan'] = $daftarusulan->getDataUsulan2();
		$data['subprk'] = $daftarpekerjaan->getAll();
		$data['konstruksi_usulan'] = $m_usulan->getDataKonstruksiUsulan();

		return $data;

	}

	public function viewRincianUsulanSpvTeknik($id_usulan){ 
		$m_usulan = new Usulan();
		$m_usulan->setId_usulan($id_usulan);
		$data = $this->RincianUsulan($m_usulan->getId_usulan()); 
		$this->template->display('UsulanViews/rincianView',$data);
	}

	public function viewRincianUsulanMUlp($id_usulan){
		$m_usulan = new Usulan();
		$m_usulan->setId_usulan($id_usulan);
		$data = $this->RincianUsulan($m_usulan->getId_usulan()); 
		$data['persetujuanMUlp'] = "
		<button data-toggle='modal' data-target='#revisimodal' class='btn btn-danger'>Revisi</button>			
		<a class='btn green' href=".base_url()."UsulanController/persetujuanMUlp/".$m_usulan->getId_usulan()." onclick='return confirm(\"Anda yakin akan menyetujui usulan ?\")'> Usulan Disetujui </a>
		";

		$this->template->display('UsulanViews/rincianView',$data);
	}

	public function viewRincianUsulanStaffRenUp3($id_usulan){ 
		$m_usulan = new Usulan();
		$m_usulan->setId_usulan($id_usulan);
		$data = $this->RincianUsulan($m_usulan->getId_usulan());
	
		$data['persetujuanRenUp3'] = 
		"
		<button data-toggle='modal' data-target='#revisimodal' class='btn btn-danger'>Revisi</button>			
		<a class='btn green' href=".base_url()."UsulanController/persetujuanRenUp3/".$m_usulan->getId_usulan()." onclick='return confirm(\"Anda yakin akan menyetujui usulan ?\")'> Usulan Disetujui </a>

		";


		$data['formBuktiUID'] = 
		"<form method='POST' enctype='multipart/form-data' action='".base_url()."UsulanController/unggahBuktiUid/".$m_usulan->getId_usulan()."' class='form-horizontal' role=,'form'>
			<div style='height: 60px;'>
				<table>
					<tr>
						<td><label>Bukti UID &nbsp;&nbsp;</label></td>
						<td><input type='file' class='form-control' name='bukti_kd'></td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td><button class='btn btn-primary' type='submit' name='gmb' onclick='return confirm(\"Anda yakin akan mengunggah bukti UID ?\")'>Unggah</button></td>
					</tr>
				</table>
			</div>
		</form>";

		$this->template->display('UsulanViews/rincianView',$data);
	}

	public function viewRincianUsulanMBRenUp3($id_usulan){ 
		$m_usulan = new Usulan();
		$m_usulan->setId_usulan($id_usulan);
		$data = $this->RincianUsulan($m_usulan->getId_usulan()); 
		$data['persetujuanMBRenUp3'] = 
		"
			<button data-toggle='modal' data-target='#revisimodal' class='btn btn-danger'>Revisi</button>	
			<a class='btn green' href=".base_url()."UsulanController/persetujuanMBRenUp3/".$m_usulan->getId_usulan()." onclick='return confirm(\"Anda yakin akan menyetujui usulan ?\")'> Usulan Disetujui </a>

		";


		$this->template->display('UsulanViews/rincianView',$data);
	}

	public function viewRincianUsulanMUp3($id_usulan){ 
		$m_usulan = new Usulan();
		$m_usulan->setId_usulan($id_usulan);
		$data = $this->RincianUsulan($m_usulan->getId_usulan()); 
		$data['persetujuanMUp3'] = 
		"
			<button data-toggle='modal' data-target='#revisimodal' class='btn btn-danger'>Revisi</button>	
			<a class='btn green' href=".base_url()."UsulanController/persetujuanMUp3/".$m_usulan->getId_usulan()." onclick='return confirm(\"Anda yakin akan menyetujui usulan ?\")'> Usulan Disetujui </a>
			
		";


		$this->template->display('UsulanViews/rincianView',$data);
	}

	public function viewRincianUsulanPengadaan($id_usulan){
		$m_usulan = new Usulan();
		$m_usulan->setId_usulan($id_usulan);
		$data = $this->RincianUsulan($m_usulan->getId_usulan()); 
		
		$data['formUnggahKontrak'] = 
		"<form method='POST' enctype='multipart/form-data' action='".base_url()."UsulanController/unggahBuktiKontrak/".$m_usulan->getId_usulan()."' class='form-horizontal' role=,'form'>
			<div style='height: 60px;'>
				<table>
					<tr>
						<td style='vertical-align: middle;' >Bukti Kontrak &nbsp;&nbsp;</td>
						<td>
							<input type='file' name='bukti_kontrak' class='form-control'>	
						</td>	
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td><button  type='submit' class='btn btn-primary' onclick='return confirm(\"Anda yakin akan mengunggah bukti kontrak ?\")'>Unggah</button>&nbsp;&nbsp;<td/>
					</tr>
				</table>
			</div>
		</form>";

		$this->template->display('UsulanViews/rincianView',$data);
	}

	public function viewRincianUsulanPengawas($id_usulan){
		$m_usulan = new Usulan();
		$m_usulan->setId_usulan($id_usulan);
		$data = $this->RincianUsulan($m_usulan->getId_usulan()); 
		$this->template->display('UsulanViews/rincianView',$data);
	}

	public function updateVolumeKonstruksi($id_usulan){
		date_default_timezone_set('Asia/Jakarta');
		$daftarpekerjaan = new DaftarPekerjaan();
		$daftarkonstruksi = new DaftarKonstruksi();
		$pekerjaan = new Pekerjaan();
		$m_usulan = new Usulan();
		$m_konstruksi = new Konstruksi();
		$status = new Status();
		
		$m_usulan->setId_usulan($id_usulan);
		$pekerjaan_temp = $daftarpekerjaan->getAll();
		$konstruksi_usulan = $m_usulan->getDataKonstruksiUsulan(); // ini kasih object konstruksi di sub pek kemudia di usulan
		foreach ($pekerjaan_temp as $list_pekerjaan ) {
			foreach ($konstruksi_usulan as $list_konstruksi) {
				if ($list_pekerjaan->ID_PEKERJAAN == $list_konstruksi->ID_PEKERJAAN) {
					$pekerjaan->setId_pekerjaan($list_pekerjaan->ID_PEKERJAAN);
					$m_konstruksi->setId_konstruksi($list_konstruksi->ID_KONSTRUKSI);
					$daftarkonstruksi->setKonstruksi($m_konstruksi);
					$m_konstruksi->setVolume_konstruksi(intval($this->input->post($pekerjaan->getId_pekerjaan().'-'.$m_konstruksi->getId_konstruksi())));				
					$m_konstruksi->setTotalHarga(intval($m_konstruksi->getVolume_konstruksi() * $daftarkonstruksi->getDataKonstruksi()->row()->HARGA));
					$pekerjaan->setKonstruksi($m_konstruksi);
					$m_usulan->setPekerjaan($pekerjaan);
					$m_usulan->update_konstruksi();
				}	
			}	
		}

		$status->setTgl_status(date('d-m-Y H:i:s'));
		$status->setStatus('Persetujuan Manajer ULP');
		$status->setKeterangan('Data Konstruksi Telah Di Perbarui SPV Teknik ULP');
		$m_usulan->setStatus($status);
		$m_usulan->addStatus();
		$m_usulan->setTahapan('TAHAP1');
		$m_usulan->ubahStatus();
		$_SESSION['log']="<div class='alert alert-success alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		<strong>Volume konstruksi berhasil diperbarui.</strong>
		</div>";
		redirect('UsulanController/editUsulan/'.$m_usulan->getId_usulan());
	
	}
		
	public function updatePelaksanaan($id_usulan){
		date_default_timezone_set('Asia/Jakarta'); 
		
		$usulan = new Usulan();
        $daftarusulan = new DaftarUsulan();		
        $status = new Status();
		$usulan->setId_usulan($id_usulan);
		$daftarusulan->setUsulan($usulan);
		$datausulan = $daftarusulan->getDataUsulan2();
		if ($datausulan->BUKTI_KONTRAK == NULL && $datausulan->STATUS == 'Proses Pelaksanaan Usulan'){
			$_SESSION['log']='<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Maaf! Bukti kontrak belum diunggah.</strong>
			</div>';
		}
		else {
		$usulan->setTgl_pelaksanaan(date('d-m-Y H:i:s'));
		$usulan->mulai_pelaksanaan();
        $status->setTgl_status($usulan->getTgl_pelaksanaan());
        $status->setStatus('Mulai Proses Pelaksanaan Usulan');
        $status->setKeterangan("");
		$usulan->setStatus($status);
		$usulan->addStatus();
        $usulan->setTahapan('TAHAP4');
		$usulan->ubahStatus();
        $_SESSION['log']='<div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Konfirmasi mulai pelaksanan berhasil dilakukan.</strong>
			</div>';
		}
         redirect('UsulanController/daftarUsulan');
	}

	
	public function unduhUsulan(){
		date_default_timezone_set('Asia/Jakarta');
		$m_usulan = new Usulan();
		$daftarusulan = new DaftarUsulan();
		$daftarpekerjaan = new DaftarPekerjaan();
		$pekerjaan = new Pekerjaan();
		$konstruksi2 = new Konstruksi();
		$daftarkonstruksi = new DaftarKonstruksi();

		$data['usulan']= $daftarusulan->getAllEksport();
		$spreadsheet = new Spreadsheet();
		$Excel_writer = new Xls($spreadsheet);  /*----- Excel (Xls) Object*/

		$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
		$drawing->setName('Logo');
		$drawing->setDescription('Logo');
		$drawing->setPath('./assets/img/pln.png');
		$drawing->setHeight(60);
		$drawing->setWorksheet($spreadsheet->getActiveSheet());

		// Add some data

		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('B1', 'PT.PLN(PERSERO) UP3 MALANG')
		->setCellValue('B2', 'LEMBAR KERJA ANGGARAN INVESTASI')
		->setCellValue('B3','PROGRAM RENCANA KERJA TRAFO SISIPAN DAN JARINGAN PENUNJANG');

		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('B5', 'NO.')
		->setCellValue('C5', 'LOKASI')
		->setCellValue('D5', 'NAMA UNIT
		(UNIT LAYANAN PELANGGAN)')
		->setCellValue('E5', 'PENYULANG')
		->setCellValue('F5', 'KOORDINATOR PENYULANG')
		->setCellValue('G5', 'GAMBAR');

		$i=7;
		$j=1;
		$k=6;

		$worksheet = $spreadsheet->getActiveSheet();
		$row = 1;
		$lastColumn = $worksheet->getHighestColumn();
		$column = 'H';
		$begin_column = $column;
		$columntemp='';
			
			$data['pekerjaan'] = $daftarpekerjaan->getAll();
			foreach ($data['pekerjaan'] as $list) {
				$spreadsheet->setActiveSheetIndex(0)
				->setCellValue($column."5", $list->NAMA_PEKERJAAN);
				$begin_column = $column;
				$spreadsheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(15);
				$pekerjaan->setId_pekerjaan($list->ID_PEKERJAAN);
				$data['konstruksi'] = $pekerjaan->get_konstruksi_by_pekerjaan();
					foreach ($data['konstruksi'] as $konstruksi) {
						$spreadsheet->setActiveSheetIndex(0)->setCellValue($column.$k, $konstruksi->NAMA_KONSTRUKSI);
						$columntemp = $column;
						$column++;
				}
				$spreadsheet->getActiveSheet()->mergeCells($begin_column.'5:'.$columntemp.'5');
				$spreadsheet->getActiveSheet()->getStyle($begin_column.'5:'.$columntemp.'5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
				
			}

		
		$column = 'H';
		foreach($data['usulan'] as $usulan) {
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('B'.$i,$j)
			->setCellValue('C'.$i, $usulan->LOKASI)
			->setCellValue('D'.$i, $usulan->NAMA_UNIT)
			->setCellValue('E'.$i, $usulan->EXIST)
			->setCellValue('F'.$i, $usulan->KOORDINAT_EXIST)
			->setCellValue('G'.$i, $usulan->GAMBAR)
			->setCellValue('DC1'," X");
			$m_usulan->setId_usulan($usulan->ID_USULAN);
			

			$pekerjaan_temp = $daftarpekerjaan->getAll();
			foreach ($pekerjaan_temp as $list_pekerjaan) {
				$pekerjaan->setId_pekerjaan($list_pekerjaan->ID_PEKERJAAN);
				$konstruksibypekerjaan = $pekerjaan->get_konstruksi_by_pekerjaan();
				foreach ($konstruksibypekerjaan as $list_konstruksi) {
					$konstruksi2->setId_konstruksi($list_konstruksi->ID_KONSTRUKSI);
					$pekerjaan->setKonstruksi($konstruksi2);
					$m_usulan->setPekerjaan($pekerjaan);
					$cek = $m_usulan->cekKonstruksi();
					if ($cek <= 0) {
						$konstruksi2->setVolume_konstruksi(0);
						$konstruksi2->setTotalHarga(0);
						$m_usulan->add_konstruksi();
					}
				}
			}

			$data2['pekerjaan'] = $daftarpekerjaan->getAll();
			foreach ($data2['pekerjaan'] as $list) {
				$pekerjaan->setId_pekerjaan($list->ID_PEKERJAAN);
				$data2['konstruksi'] = $pekerjaan->get_konstruksi_by_pekerjaan();
				foreach ($data2['konstruksi'] as $konstruksi) {
					$data = $m_usulan->getDataKonstruksiUsulanEksport();
					foreach ($data as $key) {
						if( $key->NAMA_PEKERJAAN == $list->NAMA_PEKERJAAN && $key->NAMA_KONSTRUKSI == $konstruksi->NAMA_KONSTRUKSI)
						{				
							if ($key->VOLUME_KONSTRUKSI == NULL || $key->VOLUME_KONSTRUKSI == 0){
								$spreadsheet->setActiveSheetIndex(0)->setCellValue($column.$i,'-');
												
							}
							else 
							{
								$spreadsheet->setActiveSheetIndex(0)->setCellValue($column.$i, $key->VOLUME_KONSTRUKSI );	
							}
							$spreadsheet->getActiveSheet()->getStyle($column.$k.':'.$column.$k)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('92a8d1');									
							$spreadsheet->getActiveSheet()->getStyle($column.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
							$column++;
						}						
					}	
				}
			}
			$column ="H";
			$i++;
			$j++;
		}
		
		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle('Usulan');
		$spreadsheet->getActiveSheet()->mergeCells('B1:F1');
		$spreadsheet->getActiveSheet()->mergeCells('B2:F2');
		$spreadsheet->getActiveSheet()->mergeCells('B3:F3');

		$spreadsheet->getActiveSheet()->mergeCells('B5:B6');
		$spreadsheet->getActiveSheet()->mergeCells('C5:C6');
		$spreadsheet->getActiveSheet()->mergeCells('D5:D6');
		$spreadsheet->getActiveSheet()->mergeCells('E5:E6');
		$spreadsheet->getActiveSheet()->mergeCells('F5:F6');
		$spreadsheet->getActiveSheet()->mergeCells('G5:G6');

		
		$spreadsheet->getActiveSheet()->getStyle('B5:G5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
		$spreadsheet->getActiveSheet()->getStyle('B5:'.$columntemp.'5')->getFont()->setBold(true);
		$spreadsheet->getActiveSheet()->getStyle('B5:'.$columntemp.'5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$spreadsheet->getActiveSheet()->getStyle('H6:'.$columntemp.'6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$spreadsheet->getActiveSheet()->getStyle('H7:'.$columntemp.'7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$spreadsheet->getActiveSheet()->getStyle('B5:'.$columntemp.'5')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
		
		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(6);		
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);

		
		$styleArray = [
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
					'color' => ['argb' => '140000'],
				],
			],
		];
		$worksheet->getStyle('B5:'.$columntemp.$i)->applyFromArray($styleArray);

		// Create a new worksheet called "My Data"
		$myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Rekap Konstruksi');

		// Attach the "My Data" worksheet as the first worksheet in the Spreadsheet object
		$spreadsheet->addSheet($myWorkSheet, 0);
		
		$drawing2 = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
		$drawing2->setName('Logo');
		$drawing2->setDescription('Logo');
		$drawing2->setPath('./assets/img/pln.png');
		$drawing2->setHeight(60);
		$drawing2->setWorksheet($myWorkSheet);

		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('B1', 'PT.PLN(PERSERO) UP3 MALANG')
		->setCellValue('B2', 'LEMBAR KERJA ANGGARAN INVESTASI')
		->setCellValue('B3','PROGRAM RENCANA KERJA TRAFO SISIPAN DAN JARINGAN PENUNJANG');

		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('B5', 'NO.')
		->setCellValue('C5', 'NAMA KONSTRUKSI')
		->setCellValue('D5', 'HARGA SATUAN')
		->setCellValue('E5', 'VOLUME')
		->setCellValue('F5', 'JUMLAH HARGA');
		$spreadsheet->getActiveSheet()->getStyle('B5:F5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
		$spreadsheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(15);

		$konstruksi = $daftarkonstruksi->getAll();

		$l=7;
		$m=1;
		$jml_volume=0;
		foreach($konstruksi as $list) {
			$konstruksi2->setId_konstruksi($list->ID_KONSTRUKSI);
			$daftarkonstruksi->setKonstruksi($konstruksi2);
			$TOTAL_VOLUME = $daftarkonstruksi->getDataKonstruksi2()->TOTAL_VOLUME;
			if( $TOTAL_VOLUME == NULL || $TOTAL_VOLUME == 0){
				$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('B'.$l,$m)
				->setCellValue('C'.$l, $list->NAMA_KONSTRUKSI)
				->setCellValue('D'.$l, $list->HARGA)
				->setCellValue('E'.$l, '-')
				->setCellValue('F'.$l, '0');
			

			}
			else {
				$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('B'.$l,$m)
				->setCellValue('C'.$l, $list->NAMA_KONSTRUKSI)
				->setCellValue('D'.$l, $list->HARGA)
				->setCellValue('E'.$l, $TOTAL_VOLUME)
				->setCellValue('F'.$l,$list->HARGA * $TOTAL_VOLUME);
			}	
		
		$l++;
		$m++;
		}
		$n = $l;
		$o = $n-1;
		$spreadsheet->getActiveSheet()->mergeCells('B'.$l.':E'.$l);
		$spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$l,'TOTAL HARGA');
		$spreadsheet->getActiveSheet()->setCellValue('F'.$l,'=SUM(F6:F'.$o.')');
		
		$spreadsheet->getActiveSheet()->mergeCells('B1:G1');
		$spreadsheet->getActiveSheet()->mergeCells('B2:G2');
		$spreadsheet->getActiveSheet()->mergeCells('B3:G3');

		$spreadsheet->getActiveSheet()->mergeCells('B5:B6');
		$spreadsheet->getActiveSheet()->mergeCells('C5:C6');
		$spreadsheet->getActiveSheet()->mergeCells('D5:D6');
		$spreadsheet->getActiveSheet()->mergeCells('E5:E6');
		$spreadsheet->getActiveSheet()->mergeCells('F5:F6');
		

		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(6);
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		

		$spreadsheet->getActiveSheet()->getStyle('B5:G5')->getFont()->setBold(true);
		$spreadsheet->getActiveSheet()->getStyle('B'.$l.':F'.$l)->getFont()->setBold(true);

		$spreadsheet->getActiveSheet()->getStyle('B5:F5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$spreadsheet->getActiveSheet()->getStyle('B5:F5')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
		
		$styleArray = [
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
					'color' => ['argb' => '140000'],
				],
			],
		];
		$myWorkSheet->getStyle('B5:'.'F'.$l)->applyFromArray($styleArray);

		// // Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(1);

		// $spreadsheet->getActiveSheet();
		// // Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Report Excel.xls"');
		header('Cache-Control: max-age=0');
		$Excel_writer->save('php://output');
		exit;
	}

	public function updateGambarSurvey($id_usulan){
		date_default_timezone_set('Asia/Jakarta');
		define('PUBPATH',str_replace(SELF,'',FCPATH));
		$usulan = new Usulan();
		$status = new Status();
		$gambar = new Gambar();
		$daftarusulan = new DaftarUsulan();
		$usulan->setId_usulan($id_usulan);
		$daftarusulan->setUsulan($usulan);
		$datausulan = $daftarusulan->getDataUsulan2();
		$usulan->setLokasi($datausulan->LOKASI);
		$gambar->setNama_file($datausulan->GAMBAR);
		$usulan->setGambar($gambar);
		$con['upload_path'] = './assets/data_upload/Gambar_Survey/'.$usulan->getLokasi().'';
		$con['allowed_types'] = '*';
		$this->upload->initialize($con);
				$nama_file = $_FILES['gambar_survey']['name'];
				$file_parts = pathinfo($nama_file);
				if($file_parts['extension'] == "jpg" || $file_parts['extension'] == "png" || $file_parts['extension'] == "jpeg"){
					if ($datausulan->GAMBAR != NULL) {
						$this->upload->do_upload('gambar_survey');
						$lokasigambar = PUBPATH.'/assets/data_upload/Gambar_Survey/'.$usulan->getLokasi().'/'.$gambar->getNama_file();
						unlink($lokasigambar);
						$gambar->setNama_file($this->upload->file_name);
						$gambar->setTipe($file_parts['extension']);
						$usulan->setGambar($gambar);
						$_SESSION['log']="<div class='alert alert-success alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<strong>Gambar survei berhasil diperbarui.</strong>
						</div>";
						$usulan->update_gambar('GambarSurvey');

						$usulan->setTahapan('TAHAP1');
						$status->setTgl_status(date('d-m-Y H:i:s'));
						$status->setStatus('Persetujuan Manajer ULP');
						$status->setKeterangan('Gambar Survei Telah Di Perbarui SPV Teknik ULP');
						$usulan->setStatus($status);
						$usulan->addStatus();
						$usulan->ubahStatus();	
						}					
					}
				else {
					$_SESSION['log']="<div class='alert alert-danger alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<strong>Maaf!</strong> Tidak Dapat Menyimpan Data, Cek lagi file yang dicantumkan.
					Gambar survei harus berekstensi .jpg, .png, atau .jpeg.
					</div>";				
				}
			redirect('UsulanController/editUsulan/'.$usulan->getId_usulan());
	}

	public function unggahBuktiUid($idusulan){
		date_default_timezone_set('Asia/Jakarta');
		$daftarusulan = new DaftarUsulan();
		$usulan = new Usulan();
		$status = new Status();
		$buktiuid = new Gambar();
		$usulan->setId_usulan($idusulan);
		$daftarusulan->setUsulan($usulan);
		$datausulan = $daftarusulan->getDataUsulan2();
		$usulan->setLokasi($datausulan->LOKASI);

		if ($datausulan->TAHAPAN == 'TAHAP2' || $datausulan->TAHAPAN == 'TAHAP1' ){
			$_SESSION['log']='<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Maaf!</strong> Usulan belum disetujui olah Manajer UP3.
			</div>';
			redirect('UsulanController/viewRincianUsulanStaffRenUp3/'.$usulan->getId_usulan());

		}
		else if ($datausulan->TAHAPAN == 'TAHAP4'){
			$_SESSION['log']='<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Maaf!</strong>Bukti persetujuan UID sudah diunggah dan masuk proses pelaksanaan.
			</div>';
			redirect('UsulanController/viewRincianUsulanStaffRenUp3/'.$usulan->getId_usulan());
		}
		else {
		//UPLOAD BUKTI UID
		$con['upload_path'] = './assets/data_upload/Bukti_UID/'.$usulan->getLokasi().'';
		$con['allowed_types'] = 'jpg|png|jpeg';
		$this->upload->initialize($con);
		
		// JIKA DIREKTORI TIDAK ADA
		if (!is_dir('/assets/data_upload/Bukti_UID/'.$usulan->getLokasi())) {
			mkdir('./assets/data_upload/Bukti_UID/'.$usulan->getLokasi(),0777,true);
		}

		// JIKA FORM BUKTI KD KOSONG
		if (!$this->upload->do_upload('bukti_kd')) {
			$_SESSION['log']='<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Maaf!</strong> Tidak dapat menyimpan data, Bukti UID harus berekstensi .jpg, .png, atau .jpeg.
			</div>';
			// $error = array('error' => $this->upload->display_errors());
			// echo $this->upload->display_errors();

			redirect('UsulanController/viewRincianUsulanStaffRenUp3/'.$usulan->getId_usulan());
		}
		
		// JIKA FORM BUKTI KD TIDAK KOSONG
		else 
		{
			$buktiuid->setNama_file($this->upload->file_name);
			
			$file_parts = pathinfo($buktiuid->getNama_file());
			
			$buktiuid->setTipe($file_parts['extension']);
			$usulan->setBukti_uid($buktiuid);
			
			$_SESSION['log']="<div class='alert alert-success alert-dismissable'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
			<strong>Bukti UID berhasil diunggah.</strong>
			</div>";

			$usulan->update_gambar('BuktiUid');

			$status->setTgl_status(date('d-m-Y H:i:s'));
			$status->setStatus('Disetujui Diajukan Ke UID');
			$status->setKeterangan('Bukti Persetujuan UID berhasil diunggah');
			$usulan->setStatus($status);
			$usulan->addStatus();
			$usulan->setTahapan('TAHAP3');
			$usulan->ubahStatus();

			$plus = new DateInterval('PT5S');
			$date_status = new DateTime();
			$plus = $date_status->add($plus);
			$date_status = $plus;
			$status->setTgl_status($date_status->format('d-m-Y H:i:s'));			
			$status->setStatus('Proses Pelaksanaan Usulan');
			$status->setKeterangan("");
			$usulan->setStatus($status);
			$usulan->addStatus();

			$usulan->setTahapan('TAHAP4');
			$usulan->ubahStatus();

			redirect('UsulanController/viewRincianUsulanStaffRenUp3/'.$usulan->getId_usulan());
			}
		}
	}

	public function unggahBuktiKontrak($id_usulan){
		date_default_timezone_set('Asia/Jakarta');
		define('PUBPATH',str_replace(SELF,'',FCPATH));		
		$m_usulan = new Usulan();
		$status = new Status();
		$daftarusulan = new DaftarUsulan();
		$buktikontrak = new Gambar();
		
		$m_usulan->setId_usulan($id_usulan);
		$daftarusulan->setUsulan($m_usulan);
		$datausulan = $daftarusulan->getDataUsulan2();
		$m_usulan->setLokasi($datausulan->LOKASI);
		$buktikontrak->setNama_file($datausulan->BUKTI_KONTRAK);
		$m_usulan->setBukti_kontrak($buktikontrak);
		 
		if ($datausulan->TAHAPAN == 'TAHAP4' && $datausulan->STATUS != 'Proses Pelaksanaan Usulan'){
			$_SESSION['log']='<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Maaf!</strong> Konfirmasi mulai pelaksanaan usulan sudah dilakukan.
			</div>';
		}
		else {
			//UNGGAH KONTRAK
			$con['upload_path'] = './assets/data_upload/Bukti_Kontrak/'.$m_usulan->getLokasi().'';
			$con['allowed_types'] = 'jpg|jpeg|png';
			$this->upload->initialize($con);

			// // JIKA DIREKTORI TIDAK ADA
			if (!is_dir('/assets/data_upload/Bukti_Kontrak/'.$m_usulan->getLokasi())) {
				mkdir('./assets/data_upload/Bukti_Kontrak/'.$m_usulan->getLokasi(),0777,true);
			}

			// // JIKA FORM UNGGAH KONTRAK KOSONG
			if (!$this->upload->do_upload('bukti_kontrak')) {
				$_SESSION['log']='<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Maaf!</strong> Tidak dapat menyimpan data, cek pengisian data !Bukti kontrak harus berekstensi .jpg, .jpeg, atau .png.
				</div>';
			
			}

			// //JIKA FORM UNGGAH KONTRAK TIDAK KOSONG
			else 
			{ 
				if ($datausulan->BUKTI_KONTRAK == NULL){
					$buktikontrak->setNama_file($this->upload->file_name);
					
					$file_parts = pathinfo($buktikontrak->getNama_file());
					$buktikontrak->setTipe($file_parts['extension']);
					$m_usulan->setBukti_kontrak($buktikontrak);
					
					$m_usulan->update_gambar('BuktiKontrak');	

					$status->setTgl_status(date('d-m-Y H:i:s'));
					$status->setStatus('Proses Pelaksanaan Usulan');
					$status->setKeterangan('Bukti kontrak berhasil diunggah.');
					$m_usulan->setStatus($status);
					$m_usulan->addStatus();
					$m_usulan->setTahapan('TAHAP4');
					$m_usulan->ubahStatus();
					$_SESSION['log']="<div class='alert alert-success alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<strong>Bukti kontrak berhasil di unggah.</strong>
					</div>";
				}
				else if ($datausulan->BUKTI_KONTRAK != NULL ){
					
					$lokasi = PUBPATH.'/assets/data_upload/Bukti_Kontrak/'.$m_usulan->getLokasi().'/'.$m_usulan->getBukti_kontrak()->getNama_file();
					unlink($lokasi);
					$buktikontrak->setNama_file($this->upload->file_name);
					
					$file_parts = pathinfo($buktikontrak->getNama_file());
					$buktikontrak->setTipe($file_parts['extension']);
					$m_usulan->setBukti_kontrak($buktikontrak);
					
					$_SESSION['log']="<div class='alert alert-success alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<strong>Bukti kontrak berhasil diperbarui.</strong>
					</div>";
					$m_usulan->update_gambar('BuktiKontrak');
				}
			}
		}
		redirect('UsulanController/viewRincianUsulanPengadaan/'.$m_usulan->getId_usulan());
	}

	public function unggahBuktiKemajuan($id_usulan){
		date_default_timezone_set('Asia/Jakarta');
		define('PUBPATH',str_replace(SELF,'',FCPATH));		
		$m_usulan = new Usulan();
		$status = new Status();
		$daftarusulan = new DaftarUsulan();
		$buktiprogress = new Gambar();
		
		$m_usulan->setId_usulan($id_usulan);
		$daftarusulan->setUsulan($m_usulan);
		$datausulan = $daftarusulan->getDataUsulan2();
		$m_usulan->setLokasi($datausulan->LOKASI);

		if($datausulan->TAHAPAN == 'TAHAP1' || $datausulan->TAHAPAN == 'TAHAP2' || $datausulan->TAHAPAN == 'TAHAP3' || $datausulan->STATUS == 'Proses Pelaksanaan Usulan' ){
			$_SESSION['log']='<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Maaf!</strong> Konfirmasi mulai pelaksanaan belum dilakukan.
				</div>';
		}
		
		else if ($datausulan->TAHAPAN == 'TAHAP4' &&  ( $datausulan->STATUS == 'Mulai Proses Pelaksanaan Usulan' || $datausulan->STATUS == 'Kemajuan Pelaksanaan Usulan')){
			//UNGGAH KEMAJUAN
			$con['upload_path'] = './assets/data_upload/Bukti_Pelaksanaan/'.$m_usulan->getLokasi().'';
			$con['allowed_types'] = 'jpg|jpeg|png';
			$this->upload->initialize($con);

			// // JIKA DIREKTORI TIDAK ADA
			if (!is_dir('/assets/data_upload/Bukti_Pelaksanaan/'.$m_usulan->getLokasi())) {
				mkdir('./assets/data_upload/Bukti_Pelaksanaan/'.$m_usulan->getLokasi(),0777,true);
			}

			// // JIKA FORM BUKTI KEMAJUAN KOSONG
			if (!$this->upload->do_upload('bukti_kemajuan')) {
				$_SESSION['log']='<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Maaf!</strong> Tidak dapat menyimpan data, cek pengisian data ! Bukti kemajuan harus berekstensi .jpg, .jpeg, atau .png.
				</div>';
			
			}

			// //JIKA FORM BUKTI KEMAJUAN TIDAK KOSONG
			else {
				if ($datausulan->BUKTI_KEMAJUAN == NULL &&  $datausulan->STATUS == 'Mulai Proses Pelaksanaan Usulan'){
					$buktiprogress->setNama_file($this->upload->file_name);
					$file_parts = pathinfo($buktiprogress->getNama_file());
					$buktiprogress->setTipe($file_parts['extension']);
					$m_usulan->setBukti_progress($buktiprogress);
					$_SESSION['log']="<div class='alert alert-success alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<strong>Kemajuan Pelaksanaan berhasil dilakukan.</strong>
					</div>";
					$m_usulan->update_gambar('BuktiProgress');

					$status->setTgl_status(date('d-m-Y H:i:s'));
					$status->setStatus('Kemajuan Pelaksanaan Usulan');
					$status->setKeterangan($this->input->post('deskripsi'));
					$m_usulan->setStatus($status);
					$m_usulan->addStatus();

					$m_usulan->setTahapan('TAHAP4');
					$m_usulan->ubahStatus();
				}
				else if ($datausulan->BUKTI_KEMAJUAN != NULL &&  $datausulan->STATUS == 'Kemajuan Pelaksanaan Usulan'){
					$buktiprogress->setNama_file($datausulan->BUKTI_KEMAJUAN);
					$lokasi = PUBPATH.'/assets/data_upload/Bukti_Pelaksanaan/'.$m_usulan->getLokasi().'/'.$buktiprogress->getNama_file();
					unlink($lokasi);
					$buktiprogress->setNama_file($this->upload->file_name);
					$file_parts = pathinfo($buktiprogress->getNama_file());
					$buktiprogress->setTipe($file_parts['extension']);
					$m_usulan->setBukti_progress($buktiprogress);
					$_SESSION['log']="<div class='alert alert-success alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<strong>Kemajuan Pelaksanaan berhasil diperbarui.</strong>
					</div>";
					$m_usulan->update_gambar('BuktiProgress');		
				}
				
			}
		}
		else if ($datausulan->TAHAPAN == 'TAHAP4' &&  $datausulan->STATUS != 'Kemajuan Pelaksanaan Usulan' ){
			$_SESSION['log']="<div class='alert alert-danger alert-dismissable'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
			<strong>Kemajuan Pelaksanaan sudah dilakukan.</strong>
			</div>";
		}
		redirect('UsulanController/viewRincianUsulanPengawas/'.$m_usulan->getId_usulan());

		

	}

	public function unggahBast1($id_usulan){
		date_default_timezone_set('Asia/Jakarta');
		define('PUBPATH',str_replace(SELF,'',FCPATH));		
		$m_usulan = new Usulan();
		$status = new Status();
		$daftarusulan = new DaftarUsulan();
		$bast1 = new Gambar();
		
		$m_usulan->setId_usulan($id_usulan);
		$daftarusulan->setUsulan($m_usulan);
		$datausulan = $daftarusulan->getDataUsulan2();
		$m_usulan->setLokasi($datausulan->LOKASI);

		if ($datausulan->TAHAPAN != 'TAHAP4' || $datausulan->STATUS == 'Proses Pelaksanaan Usulan' || $datausulan->STATUS == 'Mulai Proses Pelaksanaan Usulan'){
			$_SESSION['log']='<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Maaf!</strong> Kemajuan pelaksanaan belum dilakukan.
				</div>';
		}
		
		else if ($datausulan->TAHAPAN == 'TAHAP4' && $datausulan->STATUS == 'Kemajuan Pelaksanaan Usulan'){
			//UNGGAH BAST 1
			$con['upload_path'] = './assets/data_upload/Bukti_Pelaksanaan/'.$m_usulan->getLokasi().'';
			$con['allowed_types'] = 'jpg|jpeg|png';
			$this->upload->initialize($con);

			// // JIKA DIREKTORI TIDAK ADA
			if (!is_dir('/assets/data_upload/Bukti_Pelaksanaan/'.$m_usulan->getLokasi())) {
				mkdir('./assets/data_upload/Bukti_Pelaksanaan/'.$m_usulan->getLokasi(),0777,true);
			}

			// // JIKA FORM UNGGAH KONTRAK KOSONG
			if (!$this->upload->do_upload('bast1')) {
				$_SESSION['log']='<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Maaf!</strong> Tidak dapat menyimpan data, cek pengisian data ! Bukti selesai pelaksanaan harus berekstensi .jpg, .jpeg, atau .png.
				</div>';
			
			}

			// //JIKA FORM UNGGAH KONTRAK TIDAK KOSONG
			else {
				if ( $datausulan->BAST1 == NULL &&  $datausulan->STATUS == 'Kemajuan Pelaksanaan Usulan'){
					$bast1->setNama_file($this->upload->file_name);
					// $m_usulan->getBast1()->setNama_file($this->upload->file_name);
					$file_parts = pathinfo($bast1->getNama_file());
					$bast1->setTipe($file_parts['extension']);
					// $m_usulan->getBast1()->setTipe($file_parts['extension']);
					$m_usulan->setBast1($bast1);
					$m_usulan->update_gambar('Bast1');				
					$status->setTgl_status(date('d-m-Y H:i:s'));
					$status->setStatus('Selesai Pelaksanaan Usulan');
					$status->setKeterangan($this->input->post('deskripsi'));
					$m_usulan->setStatus($status);
					$m_usulan->addStatus();
					$m_usulan->setTahapan('TAHAP4');
					$m_usulan->ubahStatus();

					$plus = new DateInterval('PT5S');
					$date_status = new DateTime();
					$plus = $date_status->add($plus);
					$date_status = $plus;
					$status->setTgl_status($date_status->format('d-m-Y H:i:s'));
					$status->setStatus('Mulai Pengoperasian Usulan');
					$status->setKeterangan("");
					$m_usulan->setStatus($status);
					$m_usulan->addStatus();     
					$m_usulan->setTahapan('TAHAP4');
					$m_usulan->ubahStatus();
					$_SESSION['log']="<div class='alert alert-success alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<strong>Bukti selesai pelaksanaan (BAST 1) berhasil diunggah.</strong>
					</div>";
				}
			}
		}
		else if ($datausulan->BAST1 != NULL){
			$_SESSION['log']="<div class='alert alert-danger alert-dismissable'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
			Bukti selesai pelaksanaan (BAST1) sudah diunggah.
			</div>";
		}
		redirect('UsulanController/viewRincianUsulanPengawas/'.$m_usulan->getId_usulan());

	}

	public function unggahBast2($id_usulan){
		date_default_timezone_set('Asia/Jakarta');
		define('PUBPATH',str_replace(SELF,'',FCPATH));		
		$m_usulan = new Usulan();
		$status = new Status();
		$daftarusulan = new DaftarUsulan();
		$bast2 = new Gambar();
		
		$m_usulan->setId_usulan($id_usulan);
		$daftarusulan->setUsulan($m_usulan);
		$datausulan = $daftarusulan->getDataUsulan2();
		$m_usulan->setLokasi($datausulan->LOKASI);

		if ($datausulan->TAHAPAN != 'TAHAP4' || $datausulan->STATUS == 'Proses Pelaksanaan Usulan' 
		|| $datausulan->STATUS == 'Kemajuan Pelaksanaan Usulan' || $datausulan->STATUS == 'Mulai Proses Pelaksanaan Usulan'){
			$_SESSION['log']='<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Maaf!</strong>Bukti selesai pelaksanaan (BAST 1) belum diunggah.
				</div>';
		}
		else if ($datausulan->TAHAPAN == 'TAHAP4' && $datausulan->STATUS == 'Selesai Pengoperasian Usulan') {          
			$_SESSION['log']="<div class='alert alert-danger alert-dismissable'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
			<strong>Selesai pengoperasian sudah dilakukan.</strong>
			</div>";

		}
		else {
			//UNGGAH BAST2
			$con['upload_path'] = './assets/data_upload/Bukti_Pelaksanaan/'.$m_usulan->getLokasi().'';
			$con['allowed_types'] = 'jpg|jpeg|png';
			$this->upload->initialize($con);

			// // JIKA DIREKTORI TIDAK ADA
			if (!is_dir('/assets/data_upload/Bukti_Pelaksanaan/'.$m_usulan->getLokasi())) {
				mkdir('./assets/data_upload/Bukti_Pelaksanaan/'.$m_usulan->getLokasi(),0777,true);
			}

			// // JIKA FORM UNGGAH KONTRAK KOSONG
			if (!$this->upload->do_upload('bast2')) {
				$_SESSION['log']='<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Maaf!</strong> Tidak dapat menyimpan data, cek pengisian data ! Bukti selesai pengoperasian harus berekstensi .jpg, .jpeg, atau .png.
				</div>';
			
			}

			// //JIKA FORM UNGGAH KONTRAK TIDAK KOSONG
			else {
				if($datausulan->BAST2 == NULL &&  $datausulan->STATUS == 'Mulai Pengoperasian Usulan'){
					$bast2->setNama_file($this->upload->file_name);
					$file_parts = pathinfo($bast2->getNama_file());
					$bast2->setTipe($file_parts['extension']);
					$m_usulan->setBast2($bast2);
					$_SESSION['log']="<div class='alert alert-success alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<strong>Bukti selesai pengoperasian (BAST 2) berhasil diunggah.</strong>
					</div>";
					$m_usulan->update_gambar('Bast2');	

					$status->setTgl_status(date('d-m-Y H:i:s'));
					$status->setStatus('Selesai Pengoperasian Usulan');
					$status->setKeterangan( "Bukti Selesai Pengoperasian (BAST 2) Berhasil di Unggah. ".$this->input->post('deskripsi'));
					$m_usulan->setStatus($status);
					$m_usulan->addStatus();
					$m_usulan->setTahapan('TAHAP4');
					$m_usulan->ubahStatus();

					$m_usulan->setTgl_selesei($status->getTgl_status());
					$m_usulan->selesei_pelaksanaan();
				}
			}
		}
		
		redirect('UsulanController/viewRincianUsulanPengawas/'.$m_usulan->getId_usulan());
	}

	public function tampilGambar($id_usulan,$param){
		$daftarusulan = new DaftarUsulan();
		$usulan = new Usulan();
		$usulan->setId_usulan($id_usulan);
		$daftarusulan->setUsulan($usulan);
		$data['usulan'] = $daftarusulan->getDataUsulan2();
		$data['param'] = $param;
		$this->load->view('UsulanViews/gambarView', $data);
	}


	public function unduhGambar($id_usulan,$param){
		$usulan = new Usulan();
		$daftarusulan = new DaftarUsulan();
		$gambar = new Gambar();
		$usulan->setId_usulan($id_usulan);
		$daftarusulan->setUsulan($usulan);
		$datausulan = $daftarusulan->getDataUsulan2();
		$usulan->setLokasi($datausulan->LOKASI);
		
		// $usulan->setGambar($datausulan->GAMBAR);
		if ($param == 'GambarSurvey'){
			$gambar->setNama_file($datausulan->GAMBAR);
			$path = './assets/data_upload/Gambar_Survey/'.$usulan->getLokasi().'/';
		}
		else if ($param == 'BuktiUid'){
			$gambar->setNama_file($datausulan->BUKTI_UID);
			$path = './assets/data_upload/Bukti_UID/'.$usulan->getLokasi().'/';

		}
		else if ($param == 'BuktiKontrak'){
			$gambar->setNama_file($datausulan->BUKTI_KONTRAK);
			$path = './assets/data_upload/Bukti_Kontrak/'.$usulan->getLokasi().'/';

		}
		else if ($param == 'Progress'){
			$gambar->setNama_file($datausulan->BUKTI_KEMAJUAN);
			$path = './assets/data_upload/Bukti_Pelaksanaan/'.$usulan->getLokasi().'/';

		}
		else if ($param == 'Bast1'){
			$gambar->setNama_file($datausulan->BAST1);
			$path = './assets/data_upload/Bukti_Pelaksanaan/'.$usulan->getLokasi().'/';

		}
		else if ($param == 'Bast2'){
			$gambar->setNama_file($datausulan->BAST2);
			$path = './assets/data_upload/Bukti_Pelaksanaan/'.$usulan->getLokasi().'/';

		}
		
		// $file = $path.$usulan->getGambar();
		$file = $path.$gambar->getNama_file();
		if (file_exists($file)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.basename($file));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: private');
			header('Pragma: private');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();
			readfile($file);
			exit;
		}
		else{
			echo "FILE TIDAK ADA";
		}
	}

	
	public function persetujuanMUlp($idusulan){
		date_default_timezone_set('Asia/Jakarta');
		$status = new Status();
		$m_usulan = new Usulan();

		$m_usulan->setId_usulan($idusulan);
		$m_usulan->setTahapan('TAHAP1');
		$status->setTgl_status(date('d-m-Y H:i:s'));
		$status->setStatus('Disetujui Persetujuan Manajer ULP');
		$status->setKeterangan("");
		$m_usulan->setStatus($status);
		$m_usulan->addStatus();
		$m_usulan->ubahStatus();

		// Status Usulan Diajukan Ke UPPP 
		$plus = new DateInterval('PT5S');
		$date_status = new DateTime();
		$plus = $date_status->add($plus);
		$date_status = $plus;
		$m_usulan->setTahapan('TAHAP2');
		$status->setTgl_status($date_status->format('d-m-Y H:i:s'));
		$status->setStatus('Verifikasi Perencanaan UP3');
		$m_usulan->setStatus($status);
		$m_usulan->addStatus();
		$m_usulan->ubahStatus();

		$_SESSION['log']='<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Usulan berhasil disetujui.</strong>
		</div>';
		
		redirect('UsulanController/viewRincianUsulanMUlp/'.$m_usulan->getId_usulan());
    }
    
    public function persetujuanRenUp3($idusulan){
		date_default_timezone_set('Asia/Jakarta');
		$status = new Status();
		$m_usulan = new Usulan();
		$m_usulan->setId_usulan($idusulan);

		// Status Verifikasi Perencanaan UPPP
		$status->setTgl_status(date('d-m-Y H:i:s'));
		$status->setStatus('Disetujui Verifikasi Perencanaan UP3');
		$status->setKeterangan("");
		$m_usulan->setStatus($status);
		$m_usulan->addStatus();
		$m_usulan->setTahapan('TAHAP2');
		$m_usulan->ubahStatus();
		

		// Status Persetujuan Manajer Bagian Perencanaan UPP 
		$plus = new DateInterval('PT5S');
		$date_status = new DateTime();
		$plus = $date_status->add($plus);
		$date_status = $plus;
		$status->setTgl_status($date_status->format('d-m-Y H:i:s'));
		$status->setStatus('Persetujuan Manajer Bagian Perencanaan UP3');
		$status->setKeterangan("");
		$m_usulan->setStatus($status);
		$m_usulan->addStatus();
		$m_usulan->ubahStatus();
		$_SESSION['log']='<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Usulan berhasil disetujui.</strong>
		</div>';

		redirect('UsulanController/viewRincianUsulanStaffRenUp3/'.$m_usulan->getId_usulan());
    }
    
    public function persetujuanMBRenUp3($idusulan){
		date_default_timezone_set('Asia/Jakarta');
		$status = new Status();
		$m_usulan = new Usulan();

		$m_usulan->setId_usulan($idusulan);

		// Status Persetujuan Perencanaan MB REN UPPP
		$status->setTgl_status(date('d-m-Y H:i:s'));
		$status->setStatus('Disetujui Manajer Bagian Perencanaan UP3');
		$status->setKeterangan("");
		$m_usulan->setStatus($status);
		$m_usulan->addStatus();
		$m_usulan->setTahapan('TAHAP2');
		$m_usulan->ubahStatus();
		
		// Status Persetujuan Manajer UPPP 
		$plus = new DateInterval('PT5S');
		$date_status = new DateTime();
		$plus = $date_status->add($plus);
		$date_status = $plus;
		$status->setTgl_status($date_status->format('d-m-Y H:i:s'));
		$status->setStatus('Persetujuan Manajer UP3');
		$status->setKeterangan("");
		$m_usulan->setStatus($status);
		$m_usulan->addStatus();
		$m_usulan->ubahStatus();

		$_SESSION['log']='<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Usulan berhasil disetujui.</strong>
		</div>';

		redirect('UsulanController/viewRincianUsulanMBRenUp3/'.$m_usulan->getId_usulan());

    }
    
    public function persetujuanMUp3($idusulan){
		date_default_timezone_set('Asia/Jakarta');
		$status = new Status();
		$m_usulan = new Usulan();
		$m_usulan->setId_usulan($idusulan);

		// Status Persetujuan Manajer UPPP
		$status->setTgl_status(date('d-m-Y H:i:s'));
		$status->setStatus('Disetujui Persetujuan Manajer UP3');
		$status->setKeterangan("");
		$m_usulan->setStatus($status);
		$m_usulan->addStatus();
		$m_usulan->setTahapan('TAHAP2');
		$m_usulan->ubahStatus();

		// Status Usulan Diajukan Ke KD 
		$plus = new DateInterval('PT5S');
		$date_status = new DateTime();
		$plus = $date_status->add($plus);
		$date_status = $plus;
		$status->setTgl_status($date_status->format('d-m-Y H:i:s'));
		$status->setStatus('Diajukan Ke UID');
		$status->setKeterangan("");
		$m_usulan->setStatus($status);
		$m_usulan->addStatus();
		$m_usulan->setTahapan('TAHAP3');
		$m_usulan->ubahStatus();
		$_SESSION['log']='<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Usulan berhasil disetujui.</strong>
		</div>';

		redirect('UsulanController/viewRincianUsulanMUp3/'.$m_usulan->getId_usulan());
	}
	
    // AKHIR BAGIAN PERSETUJUAN

    // BAGIAN REVISI
    public function revisiMUlp($idusulan){
		date_default_timezone_set('Asia/Jakarta');
		$status = new Status();
		$m_usulan = new Usulan();
		$m_usulan->setId_usulan($idusulan);
		if ($this->input->post('cat_revisi') == NULL){
			$_SESSION['log']='<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong> Harap catatan revisi diisi ! </strong>
			</div>';
		}
		else {
			$m_usulan->setTahapan('TAHAP1');
			$status->setKeterangan($this->input->post('cat_revisi'));
			$status->setStatus('Revisi Persetujuan Manajer ULP');
			$status->setTgl_status(date('d-m-Y H:i:s'));
			$m_usulan->setStatus($status);
			$m_usulan->addStatus();
			$m_usulan->ubahStatus();
			$_SESSION['log']='<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Usulan berhasil direvisi.</strong>
			</div>';
		}
		
		redirect('UsulanController/viewRincianUsulanMUlp/'.$m_usulan->getId_usulan());
    }
    
    public function revisiRenUp3($idusulan){
		date_default_timezone_set('Asia/Jakarta');
		$status = new Status();
		$m_usulan = new Usulan();

		$m_usulan->setId_usulan($idusulan);
		if ($this->input->post('cat_revisi') == NULL){
			$_SESSION['log']='<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong> Harap catatan revisi diisi ! </strong>
			</div>';
		}
		else {
			$status->setKeterangan($this->input->post('cat_revisi'));
			$status->setStatus('Revisi Verifikasi Perencanaan UP3');
			$status->setTgl_status(date('d-m-Y H:i:s'));
			$m_usulan->setStatus($status);
			$m_usulan->addStatus();
			$m_usulan->setTahapan('TAHAP2');
			$m_usulan->ubahStatus();
			$_SESSION['log']='<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Usulan berhasil direvisi.</strong>
			</div>';
		}
		redirect('UsulanController/viewRincianUsulanStaffRenUp3/'.$m_usulan->getId_usulan());
    }
    
    public function revisiMBRenUp3($idusulan){
		date_default_timezone_set('Asia/Jakarta');
		$status = new Status();
		$m_usulan = new Usulan();
		$m_usulan->setId_usulan($idusulan);
		if ($this->input->post('cat_revisi') == NULL){
			$_SESSION['log']='<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong> Harap catatan revisi diisi ! </strong>
			</div>';
		}
		else {
			$status->setKeterangan($this->input->post('cat_revisi'));
			$status->setStatus('Revisi Persetujuan Manajer Bagian Perencanaan UP3');
			$status->setTgl_status(date('d-m-Y H:i:s'));
			$m_usulan->setStatus($status);
			$m_usulan->addStatus();

			$m_usulan->setTahapan('TAHAP2');
			$m_usulan->ubahStatus();
			$_SESSION['log']='<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong> Usulan berhasil direvisi.</strong>
			</div>';
		}
		redirect('UsulanController/viewRincianUsulanMBRenUp3/'.$m_usulan->getId_usulan());
    }
    
    public function revisiMUp3($idusulan){
		date_default_timezone_set('Asia/Jakarta');
		$status = new Status();
		$m_usulan = new Usulan();
		$m_usulan->setId_usulan($idusulan);
		if ($this->input->post('cat_revisi') == NULL){
			$_SESSION['log']='<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong> Harap catatan revisi diisi ! </strong>
			</div>';
		}
		else {
			$status->setKeterangan($this->input->post('cat_revisi'));
			$status->setStatus('Revisi Persetujuan Manajer UP3');
			$status->setTgl_status(date('d-m-Y H:i:s'));
			$m_usulan->setStatus($status);
			$m_usulan->addStatus();
			$m_usulan->setTahapan('TAHAP2');
			$m_usulan->ubahStatus();
			$_SESSION['log']='<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Usulan berhasil direvisi.</strong>
			</div>';
		}
		redirect('UsulanController/viewRincianUsulanMUp3/'.$m_usulan->getId_usulan());
    }  
	// BAGIAN REVISI

    
}
