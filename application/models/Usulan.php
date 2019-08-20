<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Usulan extends CI_Model
{

    private $id_usulan;
    private $lokasi;
    private $exist;
    private $koordinat_exist;
    private $jml_gangguan;
    private $deskripsi_gangguan;
    private $tahapan;
    private $tgl_usulan;
    private $unit; 
    private $daftarpekerjaan; 
    private $daftarstatus;
    private $gambar; 
    private $bukti_uid; 
    private $bukti_kontrak; 
    private $bukti_kemajuan; 
    private $bast1; 
    private $bast2; 
    private $tgl_pelaksanaan;
    private $tgl_selesei;
   

    function __construct()
    {
        parent::__construct();
        $this->load->model('Unit');
        $this->load->model('Pekerjaan');
        $this->load->model('Status');
        $this->load->model('Gambar'); 

        $this->id_usulan= "";
        $this->lokasi="";
        $this->exist="";
        $this->koordinat_exist="";
        $this->jml_gangguan=0;
        $this->deskripsi_gangguan="";
        $this->tahapan=""; 
        $this->tgl_usulan="";
        $this->unit = new Unit();
        $this->daftarpekerjaan = new Pekerjaan();
        $this->daftarstatus = new Status();
        $this->gambar = new Gambar();
        $this->bukti_uid = new Gambar();
        $this->bukti_kontrak = new Gambar();
        $this->bukti_kemajuan = new Gambar();
        $this->bast1 = new Gambar();
        $this->bast2 = new Gambar();
        $this->tgl_pelaksanaan="";
        $this->tgl_selesei="";

    }

    
 
    public function getId_usulan(){
        return $this->id_usulan;
    }
    
    public function setId_usulan($id_usulan){

        $this->id_usulan = $id_usulan;
    }
    
    public function getLokasi(){
        return $this->lokasi;
    }
    
    public function setLokasi($lokasi){

        $this->lokasi = $lokasi;
    }   

    public function getExist(){
        return $this->exist;
    }
    
    public function setExist($exist){

        $this->exist = $exist;
    }
    

    public function getKoordinat_exist(){
        return $this->koordinat_exist;
    }
    
    public function setKoordinat_exist($koordinat_exist){

        $this->koordinat_exist = $koordinat_exist;
    }
    
    public function getJml_gangguan(){
        return $this->jml_gangguan;
    }
    
    public function setJml_gangguan($jml_gangguan){

        $this->jml_gangguan = $jml_gangguan;
    }

    public function getDeskripsi_gangguan(){
        return $this->deskripsi_gangguan;
    }
    
    public function setDeskripsi_gangguan($deskripsi_gangguan){

        $this->deskripsi_gangguan = $deskripsi_gangguan;
    }


    public function getTahapan(){
        return $this->tahapan;
    }
    
    public function setTahapan($tahapan){

        $this->tahapan = $tahapan;
    }
    
    public function getTgl_usulan(){
        return $this->tgl_usulan;
    }
    
    public function setTgl_usulan($tgl_usulan){

        $this->tgl_usulan = $tgl_usulan;
    }

    public function getUnit(){
        return $this->unit;
    }
    
    public function setUnit( Unit $unit){
        $this->unit = $unit;
    }

    public function getPekerjaan(){
        return $this->daftarpekerjaan;
    }
    
    public function setPekerjaan( Pekerjaan $pekerjaan){

        $this->daftarpekerjaan = $pekerjaan;
    }

    public function getStatus(){
        return $this->daftarstatus;
    }
    
    public function setStatus(Status $status){

        $this->daftarstatus = $status;
    }


    public function getGambar(){
        return $this->gambar;
    }
    
    public function setGambar( Gambar $gambar){

        $this->gambar = $gambar;
    }

    public function getBukti_uid(){
        return $this->bukti_uid;
    }
    
    public function setBukti_uid( Gambar $bukti_uid){

        $this->bukti_uid = $bukti_uid;
    }

    public function getBukti_kontrak(){
        return $this->bukti_kontrak;
    }
    
    public function setBukti_kontrak( Gambar $bukti_kontrak){

        $this->bukti_kontrak = $bukti_kontrak;
    }

    public function getBukti_progress(){
        return $this->bukti_kemajuan;
    }
    
    public function setBukti_progress( Gambar $bukti_progress){

        $this->bukti_kemajuan = $bukti_progress;
    }

    public function getBast1(){
        return $this->bast1;
    }
    
    public function setBast1( Gambar $bast1){

        $this->bast1 = $bast1;
    }

    public function getBast2(){
        return $this->bast2;
    }
    
    public function setBast2( Gambar $bast2){

        $this->bast2 = $bast2;
    }

    public function getTgl_pelaksanaan(){
        return $this->tgl_pelaksanaan;
    }
    
    public function setTgl_pelaksanaan($tgl_pelaksanaan){

        $this->tgl_pelaksanaan = $tgl_pelaksanaan;
    }

    public function getTgl_selesei(){
        return $this->tgl_selesei;
    }
    
    public function setTgl_selesei($tgl_selesei){

        $this->tgl_selesei = $tgl_selesei;
    }

    // URAIAN USULAN

    public function add(){
        $data = array(
            'LOKASI' => $this->lokasi,
            'EXIST' => $this->exist,
            'KOORDINAT_EXIST' => $this->koordinat_exist,
            'STATUS' => $this->daftarstatus->getStatus(),
            'JML_GANGGUAN' => $this->jml_gangguan,
            'DESKRIPSI_GANGGUAN' => $this->deskripsi_gangguan,
            'ID_UNIT' =>$this->unit->getId_unit(),
            'TAHAPAN' => $this->tahapan,
            'GAMBAR' => $this->gambar->getNama_file(),
            'TIPE_GAMBAR' => $this->gambar->getTipe(),

        );
        $this->db->set('TGL_USULAN',"TO_DATE('$this->tgl_usulan','DD-MM-YYYY hh24:mi:ss')",false);
        $this->db->set($data);
        $this->db->insert('USULAN');

        // pengujian unit
        // $data = array(
        //     "LOKASI" => 'Jl. Merbabu',
        //     'EXIST' => 'Dinoyo',
        //     'KOORDINAT_EXIST' => 'S - 07.19.516 E-11247578',
        //     'STATUS' => 'Persetujuan Manajer ULP',
        //     'JML_GANGGUAN' => '3',
        //     'DESKRIPSI_GANGGUAN' => '1. Lampu ditempat pelanggan X redup 2. Lampu ditempat pelanggan Y padam 3. Trafo di jaringan Y cepat panas',
        //     'ID_UNIT' => '51303',
        //     'TAHAPAN' => 'TAHAP1',
        //     'GAMBAR' => 'GambarSurvey.jpg',
        //     'TIPE_GAMBAR' => 'jpg',
        //     'TGL_USULAN' => '23-01-2019'

        // );
        // return true;
     
    }

    public function update_uraian(){
        $data = array (
            'EXIST' => $this->exist,
            'KOORDINAT_EXIST' => $this->koordinat_exist,
            'JML_GANGGUAN' => $this->jml_gangguan,
            'DESKRIPSI_GANGGUAN' => $this->deskripsi_gangguan,
        );
        $this->db->where('ID_USULAN', $this->id_usulan);
        $this->db->update('USULAN', $data);
    }

    public function update_gambar($params){
    
        if($params == 'GambarSurvey'){
            $gambar = $this->gambar->getNama_file();
            $tipe_gambar = $this->gambar->getTipe();
            $this->db->set('GAMBAR', $gambar);
            $this->db->set('TIPE_GAMBAR', $tipe_gambar);
            $this->db->where('ID_USULAN', $this->id_usulan);
            $this->db->update('USULAN');
            
        }
        else if ($params == 'BuktiUid'){ 
            $bukti_uid = $this->bukti_uid->getNama_file();
            $tipe_buktiuid = $this->bukti_uid->getTipe();
            $this->db->set('BUKTI_UID', $bukti_uid);
            $this->db->set('TIPE_BUKTIUID', $tipe_buktiuid);
            $this->db->where('ID_USULAN', $this->id_usulan);
            $this->db->update('USULAN');
        }

        else if ($params == 'BuktiKontrak'){ 
            $bukti_kontrak = $this->bukti_kontrak->getNama_file();
            $tipe_buktikontrak = $this->bukti_kontrak->getTipe();
            $this->db->set('BUKTI_KONTRAK', $bukti_kontrak);
            $this->db->set('TIPE_BUKTIKONTRAK', $tipe_buktikontrak);
            $this->db->where('ID_USULAN', $this->id_usulan);
            $this->db->update('USULAN');
        }
        else if ($params == 'BuktiProgress'){
            $bukti_progress = $this->bukti_kemajuan->getNama_file();
            $tipe_buktiprogress = $this->bukti_kemajuan->getTipe();
            $this->db->set('BUKTI_KEMAJUAN', $bukti_progress);
            $this->db->set('TIPE_BUKTIKEMAJUAN', $tipe_buktiprogress);
            $this->db->where('ID_USULAN', $this->id_usulan);
            $this->db->update('USULAN');
        }
        else if ($params == 'Bast1'){
            $bast1 = $this->bast1->getNama_file();
            $tipe_bast1 = $this->bast1->getTipe();
            $this->db->set('BAST1', $bast1);
            $this->db->set('TIPE_BAST1', $tipe_bast1);
            $this->db->where('ID_USULAN', $this->id_usulan);
            $this->db->update('USULAN');
        }
        else if ($params == 'Bast2'){
            $bast2 = $this->bast2->getNama_file();
            $tipe_bast2 = $this->bast2->getTipe();
            $this->db->set('BAST2', $bast2);
            $this->db->set('TIPE_BAST2', $tipe_bast2);
            $this->db->where('ID_USULAN', $this->id_usulan);
            $this->db->update('USULAN');
        }
       
    }

    public function delete(){
        $id_usulan = $this->id_usulan;
        $query1 = "DELETE FROM STATUS WHERE ID_USULAN ='$id_usulan'";
        $hasil1= $this->db->query($query1);
        $query2 = "DELETE FROM DETIL_KONSTRUKSI_USULAN WHERE ID_USULAN = '$id_usulan'";
        $hasil2= $this->db->query($query2);
        $query4 = "DELETE FROM USULAN WHERE ID_USULAN ='$id_usulan'";
        $hasil4= $this->db->query($query4);
        
    }

    public function addStatus(){
        
        if ($this->id_usulan != NULL){
            $tgl_status = $this->daftarstatus->getTgl_status();
            $status = $this->daftarstatus->getStatus();
            $keterangan = $this->daftarstatus->getKeterangan();
            $data = array ( 
                'ID_USULAN' => $this->id_usulan,
                'STATUS' => $status,
                'KETERANGAN' => $keterangan
            );   
            $this->db->set('TGL_STATUS',"TO_DATE('$tgl_status','DD-MM-YYYY hh24:mi:ss')",false);
            $this->db->set($data);
            $this->db->insert('STATUS');
            return true;    
        }
        else {
            return false;
        }  

        // pengujian unit 

        // id_usulan tidak null
        // $id_usulan = 'USUTSJ989';
        // if ($id_usulan != NULL){
        //     $data = array ( 
        //         'ID_USULAN' => $id_usulan,
        //         'STATUS' => 'Persetujuan Manajer ULP',
        //         'KETERANGAN' => 'Data uraian usulan berhasil diperbarui',
        //         'TGL_STATUS' => '27-02-2019',
        //     );   
           
            
        //     return true;    
        // }
        // else {
        //     return false;
        // }  

        // id_usulan  null
        // $id_usulan = NULL;
        // if ($id_usulan != NULL){
        //     $data = array ( 
        //         'ID_USULAN' => $id_usulan,
        //         'STATUS' => 'Persetujuan Manajer ULP',
        //         'KETERANGAN' => 'Data uraian usulan berhasil diperbarui',
        //         'TGL_STATUS' => '27-02-2019',
        //     );   
              
        //     return true;    
        // }
        // else {
        //     return false;
        // } 
    }

    // ubah status pada usulan
    public function ubahStatus(){
        $data = array(
            'STATUS' => $this->daftarstatus->getStatus(),
            'TAHAPAN' => $this->tahapan
        );
        $this->db->where('ID_USULAN', $this->id_usulan);
        $this->db->update('USULAN', $data);
    }

    public function getDataStatus(){
        $query = "SELECT KETERANGAN, TO_CHAR(TGL_STATUS, 'DD-MM-YYYY hh24:mi:ss') as TGL_STATUS_TEMP , 
        STATUS FROM STATUS WHERE ID_USULAN = '$this->id_usulan' ORDER BY TO_DATE(TGL_STATUS_TEMP, 'DD-MM-YYYY hh24:mi:ss') ASC";
        $hasil = $this->db->query($query)->result();
        return $hasil;
    }

    public function cekStatus(){
        $keterangan = $this->daftarstatus->getKeterangan();
        $status = $this->daftarstatus->getStatus();
        $query = "SELECT KETERANGAN, TO_CHAR(TGL_STATUS, 'DD-MM-YYYY hh24:mi:ss') as TGL_STATUS_TEMP , 
        STATUS FROM STATUS WHERE KETERANGAN = '$keterangan' AND STATUS = '$status' AND ID_USULAN = '$this->id_usulan'";
        $hasil = $this->db->query($query)->row();
        return $hasil;
    
    }

    public function mulai_pelaksanaan(){
        $query = "UPDATE USULAN 
        SET 
        TGL_PELAKSANAAN = TO_DATE('$this->tgl_pelaksanaan','DD-MM-YYYY hh24:mi:ss')
        WHERE ID_USULAN = '$this->id_usulan'"; 
        $hasil = $this->db->query($query);
    }

    public function selesei_pelaksanaan(){
        $query = "UPDATE USULAN 
        SET 
        TGL_SELESEI = TO_DATE('$this->tgl_selesei','DD-MM-YYYY hh24:mi:ss')
        WHERE ID_USULAN = '$this->id_usulan'"; 
        $hasil = $this->db->query($query);
    }

     // KONSTRUKSI USULAN

     public function add_konstruksi(){
        $idpekerjaan = $this->daftarpekerjaan->getId_pekerjaan();
        $idkonstruksi = $this->daftarpekerjaan->getKonstruksi()->getId_konstruksi();
        $idusulan = $this->id_usulan;
        $volume_konstruksi = $this->daftarpekerjaan->getKonstruksi()->getVolume_konstruksi();
        $totalHarga = $this->daftarpekerjaan->getKonstruksi()->getTotalHarga();
        
        $data = array (
            'ID_PEKERJAAN' => $idpekerjaan,
            'ID_KONSTRUKSI' => $idkonstruksi,
            'ID_USULAN' => $idusulan,
            'VOLUME_KONSTRUKSI' => $volume_konstruksi,
            'HARGA' => $totalHarga
        );
        $this->db->insert('DETIL_KONSTRUKSI_USULAN',$data);
    }
   
    public function update_konstruksi(){
        $idpekerjaan = $this->daftarpekerjaan->getId_pekerjaan();
        $idkonstruksi = $this->daftarpekerjaan->getKonstruksi()->getId_konstruksi();
        $volume_konstruksi = $this->daftarpekerjaan->getKonstruksi()->getVolume_konstruksi();
        $totalHarga = $this->daftarpekerjaan->getKonstruksi()->getTotalHarga();
        $query = "UPDATE DETIL_KONSTRUKSI_USULAN
                  SET VOLUME_KONSTRUKSI = '$volume_konstruksi',
                    HARGA =  '$totalHarga'
                  WHERE ID_USULAN = '$this->id_usulan' 
                  AND ID_KONSTRUKSI = '$idkonstruksi' 
                  AND ID_PEKERJAAN = '$idpekerjaan'";
        $hasil = $this->db->query($query);
    }
  

    // MENGECEK APAKAH KONSTRUKSI SUDAH ADA PADA USULAN, KONSTRUKSI TERTENTU YANG BARU DI INPUTKAN UNTUK DI UPDATE PADA USULAN
    public function cekKonstruksi(){

        $idkons = $this->daftarpekerjaan->getKonstruksi()->getId_konstruksi();
        $idpekerjaan = $this->daftarpekerjaan->getId_pekerjaan();
        $idusulan = $this->id_usulan;

        $query = "SELECT KONSTRUKSI.ID_KONSTRUKSI  
        FROM PEKERJAAN JOIN DETIL_KONSTRUKSI_USULAN ON PEKERJAAN.ID_PEKERJAAN = DETIL_KONSTRUKSI_USULAN.ID_PEKERJAAN 
        JOIN KONSTRUKSI ON KONSTRUKSI.ID_KONSTRUKSI = DETIL_KONSTRUKSI_USULAN.ID_KONSTRUKSI
        JOIN USULAN ON USULAN.ID_USULAN = DETIL_KONSTRUKSI_USULAN.ID_USULAN 
        WHERE KONSTRUKSI.ID_KONSTRUKSI = '$idkons' AND PEKERJAAN.ID_PEKERJAAN = '$idpekerjaan' AND USULAN.ID_USULAN = '$idusulan'";

        $count= $this->db->query($query)->result();
        return count($count);
    }

    public function getDataKonstruksiUsulan(){
        $query = "SELECT PEKERJAAN.* , KONSTRUKSI.*, USULAN.*, DETIL_KONSTRUKSI_USULAN.* , DETIL_KONSTRUKSI_USULAN.HARGA AS HARGA_TOTAL  
        FROM PEKERJAAN 
        JOIN DETIL_KONSTRUKSI_USULAN ON PEKERJAAN.ID_PEKERJAAN = DETIL_KONSTRUKSI_USULAN.ID_PEKERJAAN 
        JOIN KONSTRUKSI ON KONSTRUKSI.ID_KONSTRUKSI = DETIL_KONSTRUKSI_USULAN.ID_KONSTRUKSI
        JOIN USULAN ON USULAN.ID_USULAN = DETIL_KONSTRUKSI_USULAN.ID_USULAN 
        WHERE USULAN.ID_USULAN = '$this->id_usulan' ORDER BY KONSTRUKSI.ID_KONSTRUKSI ASC";
        $hasil = $this->db->query($query)->result();
        return $hasil; 
    }

    public function getDataKonstruksiUsulanEksport(){
        $query = "SELECT PEKERJAAN.* , KONSTRUKSI.*, USULAN.*, DETIL_KONSTRUKSI_USULAN.* , DETIL_KONSTRUKSI_USULAN.HARGA AS HARGA_TOTAL  
        FROM PEKERJAAN 
        JOIN DETIL_KONSTRUKSI_USULAN ON PEKERJAAN.ID_PEKERJAAN = DETIL_KONSTRUKSI_USULAN.ID_PEKERJAAN 
        JOIN KONSTRUKSI ON KONSTRUKSI.ID_KONSTRUKSI = DETIL_KONSTRUKSI_USULAN.ID_KONSTRUKSI
        JOIN USULAN ON USULAN.ID_USULAN = DETIL_KONSTRUKSI_USULAN.ID_USULAN 
        WHERE USULAN.ID_USULAN = '$this->id_usulan' AND STATUS = 'Diajukan Ke UID' ORDER BY NAMA_PEKERJAAN ASC";
        $hasil = $this->db->query($query)->result();
        return $hasil; 
    }

    public function countTotalHarga(){
        $hargatotal = $this->daftarpekerjaan->getKonstruksi()->getTotalHarga();
        $id_pekerjaan = $this->daftarpekerjaan->getId_pekerjaan();
        $id_konstruksi = $this->daftarpekerjaan->getKonstruksi()->getId_konstruksi();
        $query = "UPDATE DETIL_KONSTRUKSI_USULAN SET HARGA = '$hargatotal' WHERE 
                ID_PEKERJAAN = '$id_pekerjaan' 
                  AND ID_KONSTRUKSI = '$id_konstruksi'
                  AND ID_USULAN = '$this->id_usulan'";
         $hasil = $this->db->query($query);
        return $hasil;        

    }      
}  


?>