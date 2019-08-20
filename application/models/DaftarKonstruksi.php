<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class DaftarKonstruksi extends CI_Model
{

    private $daftarkonstruksi;

    function __construct()
    {
        parent::__construct();
		$this->load->model('Konstruksi');
        $this->daftarkonstruksi = new Konstruksi();
    }

        
    public function getKonstruksi(){
        return $this->daftarkonstruksi;
    }

    public function setKonstruksi( Konstruksi $konstruksi){
        $this->daftarkonstruksi = $konstruksi;
    }
 
    public function getAll(){
        
        $query = "SELECT * FROM KONSTRUKSI ORDER BY ID_KONSTRUKSI ASC";
        $hasil = $this->db->query($query)->result();
        return $hasil;
    }

    public function getAllTahap1(){
        $id_konstruksi = $this->daftarkonstruksi->getId_konstruksi();        
        $query="SELECT DETIL_KONSTRUKSI_USULAN.*,
                USULAN.STATUS as STATUS, 
                USULAN.TAHAPAN as TAHAPAN
                FROM DETIL_KONSTRUKSI_USULAN JOIN USULAN
                ON DETIL_KONSTRUKSI_USULAN.id_usulan = USULAN.id_usulan
                WHERE DETIL_KONSTRUKSI_USULAN.id_konstruksi = '$id_konstruksi' 
                      AND (TAHAPAN = 'TAHAP1' OR STATUS LIKE '%Revisi%')";
        $hasil = $this->db->query($query)->result();
        return $hasil;
    }

    public function getAllTahap12(){
        $id_konstruksi = $this->daftarkonstruksi->getId_konstruksi();        
        $query="SELECT DETIL_KONSTRUKSI_USULAN.*,
                USULAN.STATUS as STATUS, 
                USULAN.TAHAPAN as TAHAPAN
                FROM DETIL_KONSTRUKSI_USULAN JOIN USULAN
                ON DETIL_KONSTRUKSI_USULAN.id_usulan = USULAN.id_usulan
                WHERE DETIL_KONSTRUKSI_USULAN.id_konstruksi = '$id_konstruksi' 
                      AND (TAHAPAN = 'TAHAP1' OR TAHAPAN = 'TAHAP2' OR STATUS LIKE '%Revisi%')";
        $hasil = $this->db->query($query)->result();
        return $hasil;
    }

    public function getDataKonstruksi(){
        $id_konstruksi = $this->daftarkonstruksi->getId_konstruksi();
        $query = "SELECT * FROM KONSTRUKSI 
                  WHERE ID_KONSTRUKSI = '$id_konstruksi'";
        $hasil = $this->db->query($query);
        return $hasil;
    }

    public function getDataKonstruksi2(){
        $id_konstruksi = $this->daftarkonstruksi->getId_konstruksi();
        $query = "SELECT SUM(VOLUME_KONSTRUKSI) AS TOTAL_VOLUME 
        FROM USULAN
        JOIN DETIL_KONSTRUKSI_USULAN ON USULAN.ID_USULAN = DETIL_KONSTRUKSI_USULAN.ID_USULAN 
        WHERE ID_KONSTRUKSI = '$id_konstruksi' AND STATUS = 'Diajukan Ke UID' ";
        $hasil = $this->db->query($query)->row();
        return $hasil;  
    }
   
}  


?>