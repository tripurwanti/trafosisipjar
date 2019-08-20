<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Konstruksi extends CI_Model
{

    private $id_konstruksi;
    private $nama_konstruksi;
    private $harga;
    private $volume_konstruksi;
    private $totalHarga;


    function __construct()
    {
        parent::__construct();
        $this->id_konstruksi="";
        $this->nama_konstruksi="";
        $this->harga = 0.0;
        $this->volume_konstruksi = 0;
        $this->totalHarga=0.0;
        
    }

        
    public function getId_konstruksi(){
        return $this->id_konstruksi;
    }

    public function setId_konstruksi($id_konstruksi){

         $this->id_konstruksi = $id_konstruksi;
    }
 
    public function getNama_konstruksi(){
        return $this->nama_konstruksi;
    }

    public function setNama_konstruksi($nama_konstruksi){

        $this->nama_konstruksi = $nama_konstruksi;
    }

    public function getHarga(){
        return $this->harga;
    }

    public function setHarga($harga){

        $this->harga = $harga;
    }
        
    public function getVolume_konstruksi(){
        return $this->volume_konstruksi;
    }

    public function setVolume_konstruksi($volume_konstruksi){

        $this->volume_konstruksi = $volume_konstruksi;
    }

    
    public function getTotalHarga(){
        return $this->totalHarga;
    }
    
    public function setTotalHarga($totalHarga){

        $this->totalHarga = $totalHarga;
    }
   
    public function add(){
        $data = array (
            'NAMA_KONSTRUKSI' => $this->nama_konstruksi,
            'HARGA' => $this->harga
        );
        $this->db->insert('KONSTRUKSI',$data);
    }    

    public function update(){
        $data = array (
            'NAMA_KONSTRUKSI' => $this->nama_konstruksi,
            'HARGA' => $this->harga
        );

        $this->db->where('ID_KONSTRUKSI', $this->id_konstruksi);
        $this->db->update('KONSTRUKSI', $data);
    }
    
    public function delete(){
        $idkons = $this->id_konstruksi;
        $query3 = "DELETE FROM DETIL_KONSTRUKSI_USULAN WHERE ID_KONSTRUKSI = '$idkons'";
        $hasil3= $this->db->query($query3);
        $query2 = "DELETE FROM PEKERJAAN_KONSTRUKSI WHERE ID_KONSTRUKSI = '$idkons'";
        $hasil2= $this->db->query($query2);
        $query1 = "DELETE FROM KONSTRUKSI WHERE ID_KONSTRUKSI = '$idkons'";
        $hasil1= $this->db->query($query1);

    }

} 
?>