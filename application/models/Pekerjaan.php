<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Pekerjaan extends CI_Model
{

    private $id_pekerjaan;
    private $nama_pekerjaan;
    private $daftarkonstruksi;


    function __construct()
    {
        parent::__construct();
        $this->load->model('Konstruksi');
        $this->id_pekerjaan= "";
        $this->nama_pekerjaan = "";
        $this->daftarkonstruksi = new Konstruksi();

    }


    public function getId_pekerjaan(){
        return $this->id_pekerjaan;
    }
    
    public function setId_pekerjaan($id_pekerjaan){

        $this->id_pekerjaan = $id_pekerjaan;
    }
    
    
    public function getNama_pekerjaan(){
        return $this->nama_pekerjaan;
    }
    
    public function setNama_pekerjaan($nama_pekerjaan){

        $this->nama_pekerjaan = $nama_pekerjaan;
    }

    public function getKonstruksi(){
        return $this->daftarkonstruksi;
    }
    
    public function setKonstruksi( Konstruksi $konstruksi){

        $this->daftarkonstruksi = $konstruksi;
    }

    public function add_konstruksi_dlm_pekerjaan(){
        if($this->id_pekerjaan != NULL){
            $data = array (
                'ID_PEKERJAAN' => $this->id_pekerjaan,
                'ID_KONSTRUKSI' => $this->daftarkonstruksi->getId_konstruksi()
            );
            $this->db->insert('PEKERJAAN_KONSTRUKSI',$data);
            return true;
        }
        else {
            return false;
        }
        
    }

    
    public function delete_konstruksi_dlm_pekerjaan(){
        $data = array(
            'ID_PEKERJAAN' => $this->id_pekerjaan,
            'ID_KONSTRUKSI' => $this->daftarkonstruksi->getId_konstruksi()
        );

        $this->db->where($data);
        $this->db->delete('PEKERJAAN_KONSTRUKSI');

        $this->db->where($data);
        $this->db->delete('DETIL_KONSTRUKSI_USULAN');

    }

    // melihat apakah konstruksi sudah masuk dalam pekerjaan
    public function cek_konstruksi_dlm_pekerjaan(){
        $data = array(
            'ID_PEKERJAAN' => $this->id_pekerjaan,
            'ID_KONSTRUKSI' => $this->daftarkonstruksi->getId_konstruksi()
        );
        $hasil =  $this->db->get_where('PEKERJAAN_KONSTRUKSI',$data);
        return $hasil;
    }
    
    //  melihat 1 konstruksi berada pada pekerjaan apa saja
    public function get_konstruksi_dlm_pekerjaan(){
        $idkonstruksi = $this->daftarkonstruksi->getId_konstruksi();
        $query= "SELECT KONSTRUKSI.*, PEKERJAAN.* FROM KONSTRUKSI 
        JOIN PEKERJAAN_KONSTRUKSI 
        ON konstruksi.id_konstruksi = PEKERJAAN_KONSTRUKSI.id_konstruksi 
        JOIN PEKERJAAN
        ON PEKERJAAN_KONSTRUKSI.id_PEKERJAAN = PEKERJAAN.id_PEKERJAAN 
        WHERE konstruksi.id_konstruksi = '$idkonstruksi'";
        $hasil = $this->db->query($query);
        return $hasil;
     }

    // mengambil semua konstruksi berdasarkan pekerjaan
    public function get_konstruksi_by_pekerjaan(){
        $query = "SELECT KONSTRUKSI.*, PEKERJAAN_KONSTRUKSI.* , PEKERJAAN.* 
        FROM KONSTRUKSI JOIN PEKERJAAN_KONSTRUKSI 
        ON KONSTRUKSI.ID_KONSTRUKSI = PEKERJAAN_KONSTRUKSI.ID_KONSTRUKSI
        JOIN PEKERJAAN 
        ON PEKERJAAN.ID_PEKERJAAN = PEKERJAAN_KONSTRUKSI.ID_PEKERJAAN 
        WHERE ID_PEKERJAAN = '$this->id_pekerjaan' ORDER BY KONSTRUKSI.ID_KONSTRUKSI ASC";
        $hasil = $this->db->query($query)->result();
        return $hasil;
    }

}  


?>