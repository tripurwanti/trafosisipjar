	<div class="page-content">
		<div class="row">
			<div class="col-md-12">
				<h3 class="page-title">
					Rincian Usulan <?php echo $uraian_usulan->LOKASI ?>	
				</h3>
				<ul class="page-breadcrumb breadcrumb">
					<li>
						<a href="<?php echo base_url()?>LoginController/home">
							HOME
						</a>
					</li>
					<li>				
						<a href="<?php echo base_url()?>UsulanController/daftarUsulan">
						USULAN TRAFO SISIPAN DAN JARINGAN PENUNJANG
						</a>
					</li>
					<li>
						<a href="#">RINCIAN USULAN</a>
					</li>
					
				</ul>
			</div>

			<div class="col-xs-12">	
				<?php echo $_SESSION['log'];
				$_SESSION['log']="";
				?>
				<!-- END PESAN LOG -->

				<!-- RINCIAN USULAN KONSTRUKSI -->

				<?php include("rincianUsulan.php"); ?>
				
				<!-- END RINCIAN USULAN KONSTRUKSI -->

				
				<!-- FORM PERSETUJUAN		 -->
				<?php
					
				// if(($uraian_usulan->STATUS == "Persetujuan Manajer ULP" || $uraian_usulan->STATUS == "Revisi Verifikasi Perencanaan UP3" )
				if(($uraian_usulan->STATUS == "Persetujuan Manajer ULP" )				
				&& $_SESSION['akses_login'] == "M ULP"){
					echo $persetujuanMUlp;

				}else if (($uraian_usulan->STATUS == "Verifikasi Perencanaan UP3" || $uraian_usulan->STATUS == "Revisi Persetujuan Manajer Bagian Perencanaan UP3" )
				&& $_SESSION['akses_login'] == "Ren UP3"){
					echo $persetujuanRenUp3;

				}
				else if (($uraian_usulan->STATUS == "Persetujuan Manajer Bagian Perencanaan UP3" 
						|| $uraian_usulan->STATUS == "Revisi Persetujuan Manajer UP3")
						&& $_SESSION['akses_login'] == "MB UP3") {
						echo $persetujuanMBRenUp3;

				}
				else if ($_SESSION['akses_login'] == "M UP3"){
					if	($uraian_usulan->STATUS == "Persetujuan Manajer UP3"){
						echo $persetujuanMUp3;
					}
				}
				
				// END FORM PERSETUJUAN
				?>	
				<!-- <button data-toggle='modal' data-target='revisimodal' class='btn btn-danger'>Hehe</button> -->

				<br><br><br>
			</div>
		</div>
	</div>

<div id="revisimodal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" data-width="350">
	<div  class="modal-header">
		<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> -->
		<h4 class="modal-title">Catatan Revisi</h4>
	</div>
	<div class="modal-body">
	<?php if ($_SESSION['akses_login'] == "M ULP"){
	?>
		<form method="POST"  enctype='multipart/form-data' action="<?php echo base_url(); ?>UsulanController/revisiMUlp/<?php echo $uraian_usulan->ID_USULAN ?>" class="form-horizontal" role="form">
	<?php	
	}
	else if ($_SESSION['akses_login'] == "Ren UP3"){
	?>
		<form method="POST"  enctype='multipart/form-data' action="<?php echo base_url(); ?>UsulanController/revisiRenUp3/<?php echo $uraian_usulan->ID_USULAN ?>" class="form-horizontal" role="form">
	<?php
	}	
	else if ($_SESSION['akses_login'] == "MB UP3"){
	?>
		<form method="POST"  enctype='multipart/form-data' action="<?php echo base_url(); ?>UsulanController/revisiMBRenUp3/<?php echo $uraian_usulan->ID_USULAN ?>" class="form-horizontal" role="form">
	<?php
	} 
	else if ($_SESSION['akses_login'] == "M UP3"){
		?>
			<form method="POST"  enctype='multipart/form-data' action="<?php echo base_url(); ?>UsulanController/revisiMUp3/<?php echo $uraian_usulan->ID_USULAN ?>" class="form-horizontal" role="form">
		<?php
		}
	?>
	
	
		<textarea  name='cat_revisi' id="" cols="43" rows="6"></textarea>			
	</div>
	<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
			<button type= "submit" class="btn blue">Revisi</button>
		</form>
	</div>
</div>




	