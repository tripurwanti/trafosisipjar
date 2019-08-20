<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class DaftarPekerjaan extends CI_Model
{

    private $daftarpekerjaan;


    function __construct()
    {
        parent::__construct();
        $this->load->model('Pekerjaan');
        $this->daftarpekerjaan = new Pekerjaan();   
    }

        
    public function getPekerjaan(){
        return $this->daftarpekerjaan;
    }

    public function setPekerjaan( Pekerjaan $pekerjaan){
         $this->daftarpekerjaan = $pekerjaan;
    }
    
    public function getAll(){
        $query = "SELECT * FROM PEKERJAAN ORDER BY NAMA_PEKERJAAN ASC" ;
        $hasil = $this->db->query($query)->result();
        return $hasil;
    }

    public function getDataPekerjaan(){
        $idpekerjaan = $this->daftarpekerjaan->getId_pekerjaan();
        $query = "SELECT * FROM PEKERJAAN WHERE ID_PEKERJAAN='$idpekerjaan'";
        $hasil = $this->db->query($query);
        return $hasil;
    }

 
   
}  


?>