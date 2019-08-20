<div class="page-content">
	<div class="row">
		<div class="col-md-12">
			<h3 class="page-title">
				TRAFO SISIPAN DAN JARINGAN PENUNJANG
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
					
				</ul>
		</div>

		<div class="col-xs-12">
			<?php echo $_SESSION['log'];
			$_SESSION['log']="";
			?>

			<!-- DAFTAR USULAN  -->
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-globe"></i> USULAN TRAFO SISIPAN DAN JARINGAN PENUNJANG
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse">
						</a>
						<a href="javascript:;" class="reload">
						</a>
						<a href="javascript:;" class="remove">
						</a>
					</div>
				</div>

				<div class="portlet-body table-responsive">
					<div class="table-toolbar">
						<div class="portlet-body form">
							<div class="tabbable tabbable-custom">
								<div class="tab-content">
									<?php 
									if ($_SESSION['akses_login']  == "SPV T ULP"){ 
									?>
									<div class="row w-100" style="margin-bottom: 3px">
										<div class="col-md-6">
											<div class="btn-group">
												<button data-toggle='modal' data-target='#inaddModal' class="btn green">
													Tambah <i class="fa fa-plus"></i>
												</button>
											</div>
										</div>
									</div>
									<?php } else if ($_SESSION['akses_login']  == "Ren UP3" || $_SESSION['akses_login'] == "MB UP3" || $_SESSION['akses_login'] == "M UP3") {?>
										<a href="<?php echo base_url() ?>UsulanController/unduhUsulan" class= "btn green" onclick="return confirm('Usulan yang diunduh adalah usulan yang telah disetujui Manajer UP3. Anda yakin akan mengunduh usulan?')">Unduh Usulan</a>
									<?php } ?>	
									<br/>
									<br/>
									<!-- TABEL DAFTAR USULAN -->
									<table class="table table-striped table-bordered table-hover" id="usulandatatable" >
										<thead>
											<tr>
												<th style="vertical-align: middle;" class="text-center">Lokasi</th>
												<th style="vertical-align: middle;" class="text-center">UNIT <br> (Unit Layanan Pelanggan)</th>
												<th style="vertical-align: middle;" class="text-center">Penyulang</th>
												<th style="vertical-align: middle;" class="text-center">Koordinat Penyulang</th>
												<th style="vertical-align: middle;" class="text-center">Jumlah Gangguan<br/>dalam 3 bulan (kali)</th>
												<th style="vertical-align: middle;" class="text-center">Status</th>
												<th style="vertical-align: middle;" class="text-center">Aksi</th>
											</tr>
										</thead>
										<tbody>
										<?php
										foreach($usulan as $listusulan):
										?>
											<tr>
												<td style='vertical-align: middle;' class='text-center'><?php echo  $listusulan->LOKASI ?></td>
												<td style='vertical-align: middle;' class='text-center'><?php echo $listusulan->NAMA_UNIT ?></td>
												<td style='vertical-align: middle;' class='text-center'><?php echo $listusulan->EXIST ?></td>
												<td style='vertical-align: middle;' class='text-center'><?php echo $listusulan->KOORDINAT_EXIST ?></td>
												<td style='vertical-align: middle;' class='text-center'><?php echo $listusulan->JML_GANGGUAN ?></td>
															
												<!-- KOLOM STATUS  -->
												<?php
													$status = explode(" ",$listusulan->STATUS);
													if ($status[0] == 'Revisi' OR $status[0] == 'Disetujui' OR $status[0] == 'Mulai' OR $status[0] == 'Sudah') {
												?>
												<td style='vertical-align: middle;' class='text-center'>
													<button data-toggle='modal' data-target='#logModal' class="btn btn-sm btn-default" onclick="tampilLog('<?php echo $listusulan->ID_USULAN ?>')" >
												<?php 
														if ($status[0] == 'Revisi'){
															echo '<i class="glyphicon glyphicon-star" style="color:Red"></i>  '.$status[0].'<br>';
															for ($i=1; $i < count($status) ; $i++) { 
																echo '<font style="font-size:15px;"><b>'.$status[$i].' '.'</b></font>';	
														}
													}
														else if ($status[0] == 'Disetujui' || $status[0] == 'Mulai' || $status[0] == 'Kemajuan'  ){
															echo '<i class="glyphicon glyphicon-star" style="color:Green"></i>  '.$status[0].'<br>';
															for ($i=1; $i < count($status) ; $i++) { 
																echo '<font style="font-size:15px;"><b>'.$status[$i].' '.'</b></font>';
														}													  	
													}
												?>
													</button>
												</td>
												<?php
													} else {
												?>
												<td style='vertical-align: middle;' class='text-center'><button  data-toggle='modal' data-target='#logModal' class="btn btn-sm btn-default" onclick="tampilLog('<?php echo $listusulan->ID_USULAN ?>')" ><?php echo '<font style="font-size:15px;"><b>'.$listusulan->STATUS.'</b></font>'; ?></button></td>
												<?php
													}		
												?>
												<!-- END KOLOM STATUS  -->		
															
												<!-- KOLOM AKSI -->														
												<?php 
													if ( $_SESSION['akses_login'] == "SPV T ULP"){
														if ($listusulan->TAHAPAN == 'TAHAP1'  || $listusulan->STATUS == "Revisi Verifikasi Perencanaan UP3"){
												?>
												<td style='vertical-align: middle;' width="175" class="text-center">
													<a class="btn btn-xs btn-success" href="<?php echo base_url()?>UsulanController/editUsulan/<?php echo $listusulan->ID_USULAN; ?>"><i class='glyphicon glyphicon-edit'></i>&nbsp;Rincian</a>
													<a class="btn btn-xs btn-danger"   href="<?php echo base_url()?>UsulanController/hapusUsulan/<?php echo $listusulan->ID_USULAN; ?>" onclick="return confirm('Anda yakin akan menghapus data usulan')" >Hapus</a>
												</td>
												<?php
													} 
													else {
												?>
													<td style='vertical-align: middle;' width="175" class="text-center">
														<a class="btn btn-xs btn-success" href="<?php echo base_url()?>UsulanController/editUsulan/<?php echo $listusulan->ID_USULAN; ?>"><i class='glyphicon glyphicon-edit'></i>&nbsp;Rincian</a>
														
														<!-- <a class="btn btn-xs btn-success" href="<?php echo base_url()?>UsulanController/viewRincianUsulanSpvTeknik/<?php echo $listusulan->ID_USULAN; ?>"><i class='glyphicon glyphicon-edit'></i>&nbsp;Rincian</a> -->
													</td>
												<?php
													
													}
												
												} else if ($_SESSION['akses_login'] == "M ULP") {
													?>
													<td style='vertical-align: middle;' width="175" class="text-center">
														<a class="btn btn-xs btn-success" href="<?php echo base_url()?>UsulanController/viewRincianUsulanMUlp/<?php echo $listusulan->ID_USULAN;?>"><i class='glyphicon glyphicon-edit'></i>&nbsp;Rincian</a>
													</td>
													<?php
												} else if ($_SESSION['akses_login'] == "Ren UP3"){
												?>
												<td style='vertical-align: middle;' width="175" class="text-center">
													<a class="btn btn-xs btn-success" href="<?php echo base_url()?>UsulanController/viewRincianUsulanStaffRenUp3/<?php echo $listusulan->ID_USULAN;?>"><i class='glyphicon glyphicon-edit'></i>&nbsp;Rincian</a>
												</td>
												<?php
												} else if ($_SESSION['akses_login'] == "MB UP3"){
													?>
													<td style='vertical-align: middle;' width="175" class="text-center">
														<a class="btn btn-xs btn-success" href="<?php echo base_url()?>UsulanController/viewRincianUsulanMBRenUp3/<?php echo $listusulan->ID_USULAN;?>"><i class='glyphicon glyphicon-edit'></i>&nbsp;Rincian</a>
													</td>
													<?php
												} 
												else if ($_SESSION['akses_login'] == "M UP3"){
													?>
													<td style='vertical-align: middle;' width="175" class="text-center">
														<a class="btn btn-xs btn-success" href="<?php echo base_url()?>UsulanController/viewRincianUsulanMUp3/<?php echo $listusulan->ID_USULAN;?>"><i class='glyphicon glyphicon-edit'></i>&nbsp;Rincian</a>
													</td>
												<?php
												}
												else if ($_SESSION['akses_login'] == "PEJABAT PENGADAAN"){
													?>
													<td style='vertical-align: middle;' width="175" class="text-center">
														<a class="btn btn-xs btn-success" href="<?php echo base_url()?>UsulanController/viewRincianUsulanPengadaan/<?php echo $listusulan->ID_USULAN;?>"><i class='glyphicon glyphicon-edit'></i>&nbsp;Rincian</a>
													</td>
												<?php
												}
												else if ($_SESSION['akses_login'] == "PENGAWAS"){
													?>
													<td style='vertical-align: middle;' width="175" class="text-center">
														<a class="btn btn-xs btn-success" href="<?php echo base_url()?>UsulanController/viewRincianUsulanPengawas/<?php echo $listusulan->ID_USULAN;?>"><i class='glyphicon glyphicon-edit'></i>&nbsp;Rincian</a> <br/><br/>
														<?php
														if ($listusulan->TGL_PELAKSANAAN != NULL){
															?>
														<a class="btn btn-xs btn-danger"   href="<?php echo base_url()?>UsulanController/updatePelaksanaan/<?php echo $listusulan->ID_USULAN;?>" onclick="return confirm('Anda yakin akan memulai pelaksanaan usulan?')" disabled><i style="align-items: center;" ></i> Mulai Pelaksanaan </a>

														<?php	
														}else {
															?>
															<a class="btn btn-xs btn-danger"   href="<?php echo base_url()?>UsulanController/updatePelaksanaan/<?php echo $listusulan->ID_USULAN;?>" onclick="return confirm('Anda yakin akan memulai pelaksanaan usulan?')" ><i style="align-items: center;" ></i> Mulai Pelaksanaan </a>
	
															<?php	
														}
														?>
													</td>
													
												
												<?php
													}		
												?>
												<!-- END KOLOM AKSI -->
															
											</tr>
											<?php
											endforeach;
											?>
										</tbody>							
									</table>
									<!-- END TABEL DAFTAR USULAN -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- MODAL LOG -->
<div id="logModal" class="modal container fade" tabindex="-1">
	<div class="modal-header">
		<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> -->
		<h4 class="modal-title"></span>Status Usulan</h4>
	</div>
	<div class="modal-body" style="height: 500px;overflow-y: auto;">
		<table class="table table-bordered" >
			<thead bgcolor="#f9f9f9">
				<tr>
					<th style="vertical-align: middle;" class="text-center">TGL STATUS</th>
					<th style="vertical-align: middle;" class="text-center">STATUS</th>
				</tr>				
			</thead>
			<tbody id="log_usulan">
			</tbody>	
		</table>
	</div>

</div>
<!-- END MODAL LOG -->

<!-- MODAL TAMBAH USULAN -->
<div id="inaddModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" data-width="760">
	<div  class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Tambah Usulan</h4>
	</div>
	<div class="modal-body">
		<form method="POST"  enctype='multipart/form-data' action="<?php echo base_url(); ?>UsulanController/tambahUsulan" class="form-horizontal" role="form">
			<table class="table table-bordered">
				<thead bgcolor="#f9f9f9">
					<tr>
						<td style="vertical-align: middle;">Lokasi</td>
						<td>
					
							<input type="text" name="lokasi" class="form-control" required>
						</td>
					</tr>
					<tr>
						<td style="vertical-align: middle;" >UNIT <br> (Unit Layanan Pelanggan)</td>
						<td>
							<select name="unit" id="select2_sample4" placeholder="" class="select2 form-control" required>
								<option value=""></option>
								<?php 
								if ($_SESSION['unit_login'] == 'ULP LAWANG') {
									echo '<option value="51301" >ULP LAWANG</option>';
								}
								else if ($_SESSION['unit_login'] == 'ULP BULULAWANG'){
									echo '<option value="51302">ULP BULULAWANG</option>';
								}
								else if ($_SESSION['unit_login'] == 'ULP BATU'){
									echo '<option value="51303">ULP BATU</option>';
								}
								else if ($_SESSION['unit_login'] == 'ULP SINGOSARI'){
									echo '<option value="51304">ULP SINGOSARI</option>';
								}
								else if ($_SESSION['unit_login'] == 'ULP KEPANJEN'){
									echo '<option value="51305">ULP KEPANJEN</option>';
								}
								else if ($_SESSION['unit_login'] == 'ULP TUMPANG'){
									echo '<option value="51306">ULP TUMPANG</option>';
								}
								else if ($_SESSION['unit_login'] == 'ULP GONDANGLEGI'){
									echo '<option value="51307">ULP GONDANGLEGI</option>';
								}
								else if ($_SESSION['unit_login'] == 'ULP DAMPIT'){
									echo '<option value="51308">ULP DAMPIT</option>';
								}
								else if ($_SESSION['unit_login'] == 'ULP NGANTANG'){
									echo '<option value="51309">ULP NGANTANG</option>';
								}
								else if ($_SESSION['unit_login'] == 'ULP SUMBER PUCUNG'){
									echo '<option value="51310">ULP SUMBER PUCUNG</option>';
								}
								else if ($_SESSION['unit_login'] == 'ULP DINOYO'){
									echo '<option value="51311">ULP DINOYO</option>';
								}
								else if ($_SESSION['unit_login'] == 'ULP BLIMBING'){
									echo '<option value="51312">ULP BLIMBING</option>';
								}
								else if ($_SESSION['unit_login'] == 'ULP MALANG KOTA'){
									echo '<option value="51313">ULP MALANG KOTA</option>';
								}
								else if ($_SESSION['unit_login'] == 'ULP KEBON ANGUNG'){
									echo '<option value="51314">ULP KOBON ANGUNG</option>';
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td style="vertical-align: middle;" >Penyulang</td>
						<td><input type="text" name="exist" class="form-control" required></td>
					</tr>
					<tr>
						<td style="vertical-align: middle;" >Koordinat Penyulang</td>
						<td ><input type="text" name="koordinatexist" class="form-control" required></td>
					</tr>
					<tr>
						<td style="vertical-align: middle;" >Gambar Survei</td>
						<td><input type="file" name="gambarsurvey" ></td>
					</tr>
					<tr>
						<td style="vertical-align: middle;">Jumlah Gangguan<br/>dalam 3 bulan (kali)</td>
						<td ><input type="number" name="jml_gangguan"   class="form-control" required></td>
					
					</tr>
					<tr>
						<td style="vertical-align: middle;">Deskripsi Gangguan</td>
						<td ><textarea name="deskripsigangguan"  cols="70" rows="3" required></textarea></td>
					
					</tr>
				</thead>
			</table>
	</div>
	<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
			<button class="btn blue">Tambah</button>
		</form>
	</div>
</div>
<!-- MODAL TAMBAH USULAN -->
