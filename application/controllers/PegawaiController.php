<?php  ?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class PegawaiController extends CI_Controller
{
	function __construct()
	{
		session_start();
		parent::__construct();
		$this->load->library(array('template','pagination','form_validation','upload'));
		$this->load->model('Pegawai');
		$this->load->model('Akun');
		$this->load->model('Unit');
		$this->load->model('DaftarPegawai');
		$this->load->model('DaftarUnit');

		if ( !isset($_SESSION['is_login']) ) {
			redirect('LoginController');
		}
	}

	public function index()
	{	
		
	}


	public function daftarPegawai(){
		$daftarpegawai = new DaftarPegawai();
		$data['side1']="";
		$data['side2']="";
		$data['side3']="";
		$data['side4']="active";
		$data['side2sub1']="";
		$data['side2sub2']="";
		$data['side2sub3']="";
		$data['side2sub4']="";
		$data['user'] = $daftarpegawai->getAll();
		$this->template->display('PegawaiViews/daftarPegawaiView', $data);

	}

	public function viewTambah(){ // nama diganti viewTambahPegawai
		$data['log']=$_SESSION['log'];		
		$this->load->view('PegawaiViews/tambahPegawaiView',$data); //apabila session kosong load login/v_form
	}

	public function tambah() { // namadiganti tambah
	
		$daftarpegawai = new DaftarPegawai();
		$akun = new Akun();
		$unit = new Unit();
		$pegawai = new Pegawai();
		$daftarunit = new DaftarUnit();
		
		$akun->setUsername($this->input->post('username'));
		$akun->setPassword(md5($this->input->post('password')));
		$pegawai->setAkun($akun);

		$unit->setId_unit($this->input->post('unit'));
		$daftarunit->setUnit($unit);
		$namaunit = $daftarunit->getDataUnit()->row()->NAMA_UNIT;
		$unit->setNama_unit($namaunit);
		$pegawai->setUnit($unit);

		$pegawai->setJabatan($this->input->post('jabatan'));
		$pegawai->setNama($this->input->post('nama'));
		$pegawai->setNip($this->input->post('nip'));
		$daftarpegawai->setPegawai($pegawai);

		if($daftarpegawai->getPegawai()->cekNip()->num_rows <= 0){
			if($daftarpegawai->getPegawai()->cekUsername()->num_rows <= 0){
				$daftarpegawai->getPegawai()->add();
				$_SESSION['log']="<div class='alert alert-success alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<strong><font size='4'>Berhasil menambahkan akun pegawai baru.
					</div>";
			} else{
			$_SESSION['log']="<div class='alert alert-danger alert-dismissable'>
		   <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		   <strong><font size='4'>Maaf!</font></strong> Username sudah digunakan, silakan ganti dengan yang lain.
		   </div>";
			}
		}
		else {
		   $_SESSION['log']="<div class='alert alert-danger alert-dismissable'>
		   <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		   <strong><font size='4'>Maaf!</font></strong> NIP sudah digunakan, silakan ganti dengan yang lain.
		   </div>";
		}
	 redirect('PegawaiController/viewTambah');
    }

	public function edit($nip){ 
		$pegawai = new Pegawai();
		$daftarpegawai = new DaftarPegawai();
		$data['side1']="";
		$data['side2']="";
		$data['side3']="";
		$data['side4']="active";
		$data['side2sub1']="";
		$data['side2sub2']="";
		$data['side2sub3']="";
		$data['side2sub4']="";
		$pegawai->setNip($nip);
		$daftarpegawai->setPegawai($pegawai);
		$data['hasil'] = $daftarpegawai->getDataPegawai()->row();
		$this->template->display('PegawaiViews/editPegawaiView', $data);

	}

	public function update(){ 
			$akun = new Akun();
			$pegawai = new Pegawai();
		
			$pegawai->setNip($this->input->post('nip'));
			$pegawai->setNama($this->input->post('nama'));
			$akun->setUsername($this->input->post('username'));
			$akun->setPassword(md5($this->input->post('password')));
			$pegawai->setAkun($akun);
			$pegawai->update();
			$_SESSION['log']="<div class='alert alert-success alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				Data akun berhasil di ubah.
				</div>";
			redirect(site_url('PegawaiController/edit/'.$pegawai->getNip()));
	}

	public function hapus($nip){
		$daftarpegawai = new DaftarPegawai();
		$pegawai = new Pegawai();
		$pegawai->setNip($nip);
		$daftarpegawai->setPegawai($pegawai);
		
		$daftarpegawai->getPegawai()->delete();
		$_SESSION['log']="<div class='alert alert-success alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		<strong>Akun pegawai berhasil dihapus.</strong> 
		</div>";

		redirect(site_url('PegawaiController/daftarPegawai/'));

	}

}
?>