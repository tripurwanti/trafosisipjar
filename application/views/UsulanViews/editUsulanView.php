<div class="page-content">
	<div class="row">
		<div class="col-md-12">
			<h3 class="page-title">
				EDIT USULAN <?php echo $uraian_usulan->LOKASI ?>	
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
						<a href="<?php echo base_url()?>UsulanController/editUsulan/<?php echo $uraian_usulan->ID_USULAN ?>">
						EDIT USULAN
						</a>
					</li>
				
			</ul>
		</div>
		
		<div class="col-xs-12">
			<?php 
			echo $_SESSION['log'];
			$_SESSION['log']="";
			?>
		</div>

			<div class="col-lg-6">
			<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-align-justify"></i> Uraian & Lokasi Usulan <?php echo $uraian_usulan->LOKASI;?>
						</div>
					</div>
					<div class="portlet-body table-responsive"> 
						<form action="<?php echo base_url()?>UsulanController/updateUraianUsulan/<?php echo $uraian_usulan->ID_USULAN  ?>" method="POST">
							<table class="table table-bordered table-hover">
								<thead bgcolor="#f9f9f9">
									<tr>
										<th style="vertical-align: middle;" class="text-center">Lokasi</th>
										<td >
											<!-- <input type="hidden" name="id_usulan" class="form-control" value="<?php echo $uraian_usulan->ID_USULAN ?>"> -->
											<input type="text" name="lokasi" class="form-control" value="<?php echo $uraian_usulan->LOKASI?>" disabled>
										</td>
									</tr>
									<tr>
										<th style="vertical-align: middle;" class="text-center">Tanggal Usulan</th>
										<td> 
										<input type="text" name="lokasi" class="form-control"  value="<?php echo $uraian_usulan->TGL_USULAN?>" disabled>
										
										</td>
									</tr>
									<tr>
										<th style="vertical-align: middle;" class="text-center">ULP <br> (Unit Layanan Pelanggan)</th>
										<td ><input type="text" name="unit" class="form-control" value="<?php echo $uraian_usulan->NAMA_UNIT ?>" required disabled></td>

									</tr>
									<tr>
										<th style="vertical-align: middle;" class="text-center">Penyulang</th>
										<td ><input type="text" name="exist" class="form-control" value="<?php echo $uraian_usulan->EXIST ?>" required></td>

									</tr>
									<tr>
										<th style="vertical-align: middle;" class="text-center">Koordinat Penyulang</th>
										<td ><input type="text" name="koordinatexist" class="form-control" value="<?php echo $uraian_usulan->KOORDINAT_EXIST ?>" required></td>

									</tr>	
									<tr>
										<th style="vertical-align: middle;" class="text-center">Jumlah Gangguan <br/> dalam 3 bulan (kali)</th>	
										<td ><input type="text" name="jml_gangguan" class="form-control" value="<?php echo $uraian_usulan->JML_GANGGUAN ?>" required></td>

									</tr>
									<tr>
										<th style="vertical-align: middle;" class="text-center">Deskripsi Gangguan</th>	
										<td ><textarea name="deskripsigangguan"  cols="80" rows="4" required><?php echo $uraian_usulan->DESKRIPSI_GANGGUAN; ?></textarea></td>

									</tr>
								</thead>
								
							</table>
							<!-- <button data-toggle='modal' data-target='#confirmationModal' class="btn btn-sm btn-default" onclick="confirm()" > -->
							<!-- <button data-toggle='modal' data-target='#confirmationModal' class="btn btn-primary">Simpan</button> -->
							<?php if($uraian_usulan->TAHAPAN== "TAHAP1" || $uraian_usulan->STATUS == "Revisi Verifikasi Perencanaan UP3" ){
							?>
								<button  type="submit"  class="btn btn-primary">Simpan</button>
								<a class ="btn btn-danger" href="<?php echo base_url()?>UsulanController/daftarUsulan">Batal</a>			
							<?php 
							} else {
								?>
								<button  type="submit"  class="btn btn-primary" disabled >Simpan</button>
								<a class ="btn btn-danger" href="<?php echo base_url()?>UsulanController/daftarUsulan">Batal</a>
							<?php
							}
							?>

						</form>
						<!-- <button  type="submit" data-target='#confirmationModal' class="btn btn-primary">Simpan</button> -->
					</div>
				</div>
			</div>

			
			<div class="col-lg-6">
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-gift"></i>GAMBAR
						</div>
					</div>		
					<div class="portlet-body table-responsive">
						<div class="tabbable tabbable-custom">
							<div class="tab-content">
								<div class="tab-pane active">
								<?php
									if ($_SESSION['akses_login'] == "SPV T ULP")  {
										if($uraian_usulan->TAHAPAN == "TAHAP1" || $uraian_usulan->STATUS == "Revisi Verifikasi Perencanaan UP3"){
											echo "<br/>".$unggah_gmbr_survey."<br/><br/>";
										} else {
											echo "<br/>".$unggah_gmbr_survey_disabled."<br/><br/>";
										}
									
									}
								?>
									<table class="table table-striped table-hover table-bordered display">
										<thead>
											<tr>
												<th>NAMA GAMBAR</th>
												<th>GAMBAR</th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
										
											<tr>
												<td>GAMBAR SURVEI</td>
												<td><?php echo $uraian_usulan->GAMBAR; ?></td>
												<td>
													<a class="btn btn-sm btn-primary"  href="<?php echo base_url();?>UsulanController/tampilGambar/<?php echo $uraian_usulan->ID_USULAN ?>/GambarSurvey" target="_blank">Lihat</a>														
														
												</td>
											</tr>
											
								
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
				</div>

				
				    
		<div class="col-lg-12">
	         <!-- KONSTRUKSI USULAN  -->
		
			<div class="portlet box blue-hoki">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-pencil-square"></i> Rincian Konstruksi
					</div>
					<div class="tools">
						<a href="javascript:;" class="expand">
						</a>
						<a href="javascript:;" class="reload">
						</a>
						<a href="javascript:;" class="fullscreen">
						</a>
					</div>
				</div>
				<div class="portlet-body form" style="display: none;">
					<div class="form-body">
						<form action="<?php echo base_url()?>UsulanController/updateVolumeKonstruksi/<?php echo $uraian_usulan->ID_USULAN;?>" method="POST">
						<?php foreach ($pekerjaan as $list_pekerjaan): ?>
							<div class="portlet box blue">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-gift"></i><?php echo $list_pekerjaan->NAMA_PEKERJAAN; ?>
									</div>
								</div>		
								<div class="portlet-body table-responsive">
									<div class="tabbable tabbable-custom">
										<div class="tab-content">
											<div class="tab-pane active">
												<table class="table table-striped table-hover table-bordered display" cellspacing="0" width="100%">
													<thead bgcolor="#f9f9f9">
														<tr > 
															<?php foreach ($konstruksi_usulan as $list_konstruksi_usulan): 
															if ($list_konstruksi_usulan->ID_PEKERJAAN == $list_pekerjaan->ID_PEKERJAAN) {
															?>
															<th class="text-center"><?php echo $list_konstruksi_usulan->NAMA_KONSTRUKSI ?></th>
															<?php }
															endforeach ?>
														</tr>
														<tr >
															<?php foreach ($konstruksi_usulan as $list_konstruksi_usulan): 
															if ($list_konstruksi_usulan->ID_PEKERJAAN == $list_pekerjaan->ID_PEKERJAAN) {
															?>
															<?php }
															endforeach ?>
														</tr>
													</thead>
													<tbody>
														<tr>
														<?php foreach ($konstruksi_usulan as $list_konstruksi_usulan): 
															if ($list_konstruksi_usulan->ID_PEKERJAAN == $list_pekerjaan->ID_PEKERJAAN) {
																if($uraian_usulan->TAHAPAN== "TAHAP1"  || $uraian_usulan->STATUS == "Revisi Verifikasi Perencanaan UP3"){
														?>
															<td><input type="number" maxlength="3" name="<?php echo $list_pekerjaan->ID_PEKERJAAN.'-'.$list_konstruksi_usulan->ID_KONSTRUKSI; ?>" class="form-control"  value="<?php echo $list_konstruksi_usulan->VOLUME_KONSTRUKSI; ?>" /></td>

														<?php
														}else {
														?>
															<td><input type="number" maxlength="3" name="<?php echo $list_pekerjaan->ID_PEKERJAAN.'-'.$list_konstruksi_usulan->ID_KONSTRUKSI; ?>" class="form-control"  value="<?php echo $list_konstruksi_usulan->VOLUME_KONSTRUKSI; ?>" disabled/></td>

														<?php
																}
														?>														
														<?php }
														endforeach?>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>	
						<?php endforeach ?>
						<?php 
						if($uraian_usulan->TAHAPAN== "TAHAP1" || $uraian_usulan->STATUS == "Revisi Verifikasi Perencanaan UP3"){
						?>
						<input type="submit" onclick='return confirm("Anda yakin akan memperbarui volume konstruksi usulan?")' class="btn btn-primary" value="Simpan">

						<?php
						}
						?>
						
						</form>
					</div>
				</div>
			</div>
		</div>
			<!-- END KONSTRUKSI USULAN -->
	
				
		</div>
			
		</div>
	</div>
</div>
