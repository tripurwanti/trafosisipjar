<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class DaftarUnit extends CI_Model
{
    private $daftarunit;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Unit');
        $this->daftarunit = new Unit();
    }

      
    public function getUnit(){
        return $this->daftarunit;
    }
    
    public function setUnit(Unit $unit){

        $this->daftarunit = $unit;
    }

    public function getDataUnit(){
        $id_unit = $this->daftarunit->getId_unit();
        // echo $id_unit;
        $query = "SELECT * FROM UNIT WHERE ID_UNIT = '$id_unit'";
        $hasil = $this->db->query($query);
        return $hasil;
      }

    

}   
