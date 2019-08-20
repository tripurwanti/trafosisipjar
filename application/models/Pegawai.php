<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Pegawai extends CI_Model
{
    
    private $nip;
    private $nama;
    private $jabatan;
    private $akun;
    private $unit;
    


    function __construct()
    {
        parent::__construct();
        $this->load->model('Unit');
        $this->load->model('Akun');
        $this->nip = "";
        $this->nama = "";
        $this->jabatan = "";
        $this->akun = new Akun();
        $this->unit = new Unit();  


    }
       
    
    public function getNip(){
        return $this->nip;
    }
    
    public function setNip($nip){

        $this->nip = $nip;
    }

    public function getNama(){
        return $this->nama;
    }
    
    public function setNama($nama){

        $this->nama = $nama;
    }

    public function getJabatan(){
        return $this->jabatan;
    }
    
    public function setJabatan($jabatan){

        $this->jabatan = $jabatan;
    }

    public function getUnit(){
        return $this->unit;
    }
 
    public function setUnit(Unit $unit){
      $this->unit = $unit;
    }

    public function getAkun(){
        return $this->akun;
    }
 
    public function setAkun(Akun $akun){
      $this->akun = $akun;
    }
       
    public function cekUsername(){
        $username = $this->akun->getUsername();
        $query = "SELECT * FROM PEGAWAI WHERE USERNAME ='$username'";
        $hasil = $this->db->query($query);
        return $hasil;
    }

    public function cekNip(){
        $query = "SELECT * FROM PEGAWAI WHERE NIP ='$this->nip'";
        $hasil = $this->db->query($query);
        return $hasil;
    }

    public function add(){
        $data = array (
            'NIP' => $this->nip,
            'NAMA' => $this->nama,
            'UNIT' => $this->unit->getNama_unit(),
            'USERNAME' => $this->akun->getUsername(),
            'PASSWORD' => $this->akun->getPassword(),
            'JABATAN' => $this->jabatan
        );
        $this->db->insert('PEGAWAI',$data);
    }

    public function update(){
        $data = array (
            'NAMA' => $this->nama,
            'USERNAME' => $this->akun->getUsername(),
            'PASSWORD' => $this->akun->getPassword(),
        );
        $this->db->where('NIP', $this->nip);
        $this->db->update('PEGAWAI', $data);
    }

    public function delete(){
        $query = "DELETE PEGAWAI WHERE NIP = '$this->nip'";
        $this->db->query($query);

    }

   
}   

?>