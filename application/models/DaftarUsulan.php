<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class DaftarUsulan extends CI_Model
{
    private $daftarusulan;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Usulan');
        $this->daftarusulan = new Usulan();

    }

    public function setUsulan( Usulan $usulan){
        $this->daftarusulan = $usulan;
    }

    public function getUsulan(){
        return $this->daftarusulan;
    }

    public function getAll(){
        $query = "SELECT a.* , b.NAMA_UNIT FROM USULAN a INNER JOIN UNIT b ON a.ID_UNIT = b.ID_UNIT";
        $hasil = $this->db->query($query)->result();
        return $hasil;        
    }

    public function getAllUnit() {
        $nama_unit = $this->daftarusulan->getUnit()->getNama_unit(); // mengambil atribut nama dari objek UNIT
        $query = "SELECT a.* , b.NAMA_UNIT FROM USULAN a INNER JOIN UNIT b ON a.ID_UNIT = b.ID_UNIT 
                  WHERE b.NAMA_UNIT = '$nama_unit' 
                  ORDER BY ID_USULAN ASC" ;
        $hasil = $this->db->query($query)->result();
        return $hasil;
    }

    public function getAllUp3(){
        $query = "SELECT a.* , b.NAMA_UNIT FROM USULAN a INNER JOIN UNIT b ON a.ID_UNIT = b.ID_UNIT 
                  ORDER BY ID_USULAN ASC" ;
        $hasil = $this->db->query($query)->result();
        return $hasil;
    }

    public function getAllTahap4(){
        $query = "SELECT a.* , b.NAMA_UNIT FROM USULAN a INNER JOIN UNIT b ON a.ID_UNIT = b.ID_UNIT 
                  WHERE TAHAPAN = 'TAHAP4' ORDER BY ID_USULAN ASC" ;
        $hasil = $this->db->query($query)->result();
        return $hasil;
    }
    
    public function getAllEksport(){
        $query = "SELECT a.* , b.NAMA_UNIT FROM USULAN a INNER JOIN UNIT b ON a.ID_UNIT = b.ID_UNIT 
                  WHERE STATUS = 'Diajukan Ke UID'" ;
        $hasil = $this->db->query($query)->result();
        return $hasil;
    }
    
    
    public function getDataUsulan(){
        $lokasi = $this->daftarusulan->getLokasi();
        $tgl = $this->daftarusulan->getTgl_usulan();
        $query = "SELECT a.* , b.NAMA_UNIT FROM USULAN a INNER JOIN UNIT b ON a.ID_UNIT = b.ID_UNIT 
                  WHERE LOKASI = '$lokasi' AND TO_CHAR(TGL_USULAN, 'DD-MM-YYYY hh24:mi:ss') = '$tgl' ";
        $hasil = $this->db->query($query);
        return $hasil;   

        // pengujian unit
        // $lokasi = 'Jl. Veteran';
        // $tgl = '28-02-2019 20:54:53';
        // $query = "SELECT a.* , b.NAMA_ULP FROM USULAN a INNER JOIN ULP b ON a.ID_ULP = b.ID_ULP 
        //           WHERE LOKASI = '$lokasi' AND TO_CHAR(TGL_USULAN, 'DD-MM-YYYY hh24:mi:ss') = '$tgl' ";
        // return true;
    }

    public function getDataUsulan2(){
        $id_usulan = $this->daftarusulan->getId_usulan();
        $query = "SELECT a.* , b.NAMA_UNIT FROM USULAN a INNER JOIN UNIT b ON a.ID_UNIT = b.ID_UNIT 
                  WHERE ID_USULAN = '$id_usulan'";
        $hasil = $this->db->query($query)->row();
        return $hasil;   
    }

}  


?>