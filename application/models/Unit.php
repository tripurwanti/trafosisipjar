<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Unit extends CI_Model
{

    private $id_unit;
    private $nama_unit;


    function __construct()
    {
        parent::__construct();
        $this->id_unit="";
        $this->nama_unit="";
    }
    
    public function getId_unit(){
        return $this->id_unit;
    }
    
    public function setId_unit($id_unit){
        $this->id_unit = $id_unit;
    }
 

    public function getNama_unit(){
        return $this->nama_unit;
    }

    public function setNama_unit($nama_unit){
        $this->nama_unit = $nama_unit;
    }
}  


?>