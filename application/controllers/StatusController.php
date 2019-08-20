<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class StatusController extends CI_Controller
{
	function __construct()
	{
		session_start();
		parent::__construct();
		$this->load->library(array('template','pagination','form_validation','upload'));
		$this->load->model('Usulan');
		if ( !isset($_SESSION['is_login']) ) {
			redirect('LoginController');
		}
	}

	public function index()
	{
		
	}

	public function tampil($idusulan){
		$usulan = new Usulan();
		$usulan->setId_usulan($idusulan);
		$statuslist = $usulan->getDataStatus();
		foreach ($statuslist as $key) {
			echo '<tr>';
			echo '<td style="vertical-align: middle;" class="text-center">'.$key->TGL_STATUS_TEMP.'</td>';
			$status_arr = explode(" ",$key->STATUS);	
			if ($key->KETERANGAN != NULL && $status_arr[0] == 'Revisi') {
				echo '<td style="vertical-align: middle;">';
				echo '<i class="glyphicon glyphicon-star" style="color:Red"></i>  '.$status_arr[0].'<br>';
				for ($i=1; $i < count($status_arr) ; $i++) { 
					echo '<font style="font-size:15px;"><b>'.$status_arr[$i].' '.'</b></font>';	
				}
				echo '<br/><button disabled><b>Catatan! </b>'.$key->KETERANGAN.'</button>';
			}
			else if ($key->KETERANGAN != NULL && ($status_arr[0] == 'Disetujui' || $status_arr[0] == 'Mulai')){
				echo '<td style="vertical-align: middle;">';
				echo '<i class="glyphicon glyphicon-star" style="color:Green"></i>  '.$status_arr[0].'<br>';
				for ($i=1; $i < count($status_arr) ; $i++) { 
					echo '<font style="font-size:15px;"><b>'.$status_arr[$i].' '.'</b></font>';	
				}
				echo '<br/><button disabled><b>Catatan! </b>'.$key->KETERANGAN.'</button>';
			}
			else if ($key->KETERANGAN != NULL){
				echo 
				'<td style="vertical-align: middle; "><b style="font-size: 15px">'.$key->STATUS.'</font></b><br/>
				<button disabled><b>Catatan! </b>'.$key->KETERANGAN.'</button>
				</td>';
			}
			else if ($key->KETERANGAN == NULL && ($status_arr[0] == 'Disetujui' || $status_arr[0] == 'Mulai')){
				echo '<td style="vertical-align: middle;">';
				echo '<i class="glyphicon glyphicon-star" style="color:Green"></i>  '.$status_arr[0].'<br>';
				for ($i=1; $i < count($status_arr) ; $i++) { 
					echo '<font style="font-size:15px;"><b>'.$status_arr[$i].' '.'</b></font>';	
				}					
			}
			else if ($key->KETERANGAN == NULL){
				echo '<td style="vertical-align: middle; "><b style="font-size: 15px">'.$key->STATUS.'</font></b></td>';
			}
			echo '</tr>';
		}
	}
}
