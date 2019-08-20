<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class DaftarPegawai extends CI_Model
{
    private $daftarpegawai;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Pegawai');
        $this->daftarPegawai = new Pegawai();
    }

      
    public function getPegawai(){
        return $this->daftarpegawai;
    }
    
    public function setPegawai( Pegawai $pegawai){
        $this->daftarpegawai = $pegawai;
    }

    public function getAll(){
        $query = "SELECT * FROM PEGAWAI";
        $hasil = $this->db->query($query)->result();
        return $hasil;
    }

    public function getDataPegawai(){
        $nip = $this->daftarpegawai->getNip();
        $query = "SELECT * FROM PEGAWAI WHERE NIP = '$nip'";
        $hasil = $this->db->query($query);
        return $hasil;
    }

}   

?>