<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Status extends CI_Model
{

    private $tgl_status;
    private $status;
    private $keterangan;


    function __construct()
    {
        parent::__construct();
        $this->tgl_status="";
        $this->status="";
        $this->keterangan="";
    }
        
    public function getTgl_status(){
        return $this->tgl_status;
    }

    public function setTgl_status($tgl_status){

        $this->tgl_status = $tgl_status;
    }

    public function getStatus(){
        return $this->status;
    }
    
    public function setStatus($status){

        $this->status = $status;
    }
      
    
    public function getKeterangan(){
        return $this->keterangan;
    }
    
    public function setKeterangan($keterangan){
        $this->keterangan = $keterangan;
    }

}  


?>