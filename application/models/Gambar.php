<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Gambar extends CI_Model
{

    private $nama_file;
    private $tipe;

    function __construct()
    {
        parent::__construct();
        $this->nama_file="";
        $this->tipe="";
    }

    public function getNama_file(){
        return $this->nama_file;
    }
    
    public function setNama_file($nama_file){

        $this->nama_file = $nama_file;
    }

    public function getTipe(){
        return $this->tipe;
    }
    
    public function setTipe($tipe){
        $this->tipe = $tipe;
    }

}