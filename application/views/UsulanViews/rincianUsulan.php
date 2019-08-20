	<div class="col-lg-6">
			<!-- TABEL URAIAN -->
			<div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-align-justify"></i>Uraian & Lokasi Usulan <?php echo $uraian_usulan->LOKASI;?>
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
                            <table class="table table-bordered table-hover">
                                    <tr>
                                        <th style="vertical-align: middle;" class="text-center">Lokasi</th>
                                        <td style="vertical-align: middle;" class="text-center" ><?php echo $uraian_usulan->LOKASI ?></td>
                                    </tr>
									<tr>
                                        <th style="vertical-align: middle;" class="text-center">Tanggal Usulan</th>
										<td style="vertical-align: middle;" class="text-center" ><?php echo $uraian_usulan->TGL_USULAN ?></td>

									</tr>
									<tr>
									    <th style="vertical-align: middle;" class="text-center">UNIT <br>(Unit Layanan Pelanggan)</th>
                                        <td style="vertical-align: middle;" class="text-center" ><?php echo $uraian_usulan->NAMA_UNIT ?></td>

									</tr>
									<tr>
									    <th style="vertical-align: middle;" class="text-center">Penyulang</th>
                                        <td style="vertical-align: middle;" class="text-center" ><?php echo $uraian_usulan->EXIST ?></td>

                                    </tr>
									<tr>
										<th style="vertical-align: middle;" class="text-center">Koordinat Penyulang</th>
                                        <td style="vertical-align: middle;" class="text-center" ><?php echo $uraian_usulan->KOORDINAT_EXIST ?></td>

									<tr>
										<th style="vertical-align: middle;" class="text-center">Jumlah Gangguan <br/> dalam 3 bulan (kali)</th>
                                        <td style="vertical-align: middle;" class="text-center" ><?php echo $uraian_usulan->JML_GANGGUAN ?></td>

                                    </tr>
									<tr>
										<th style="vertical-align: middle;" class="text-center">Deskripsi Gangguan</th>
                                        <td style="vertical-align: middle;" class="text-center" >
										<textarea name="deskripsigangguan"  cols="80" rows="4" disabled><?php echo $uraian_usulan->DESKRIPSI_GANGGUAN ?></textarea>
										
										</td>


									</tr>
									<tr>
									    <th style="vertical-align: middle;" class="text-center">Tgl Mulai Pelaksanaan</th>
                                        <td style="vertical-align: middle;" class="text-center" ><?php echo $uraian_usulan->TGL_PELAKSANAAN ?></td>

                                    </tr>
									<tr>
										<th style="vertical-align: middle;" class="text-center">Tgl Selesei Pelaksanaan</th>
                                        <td style="vertical-align: middle;" class="text-center" ><?php echo $uraian_usulan->TGL_SELESEI ?></td>
                                    </tr>
                            </table>
                        </div>
                    </div>
                    <!-- END TABEL URAIAN -->
    </div>

	<div class="col-lg-6">
	<div class="portlet box blue-hoki">
					<div class="portlet-title">
						<div class="tools">
							<a href="javascript:;" class="collapse">
							</a>
							<a href="javascript:;" class="reload">
							</a>
							<a href="javascript:;" class="fullscreen">
							</a>
						</div>
					</div>		
					<div class="portlet-body table-responsive">
						<div class="tabbable tabbable-custom">
							<ul class="nav nav-tabs">
							<!-- <?php
								if ($_SESSION['akses_login'] == "M UP3" || $_SESSION['akses_login'] == "MB UP3" || $_SESSION['akses_login'] == "PEJABAT PENGADAAN"
									|| $_SESSION['akses_login'] == "M ULP" || $_SESSION['akses_login'] == "PENGAWAS" || $_SESSION['akses_login'] == "Ren UP3" || 
									$_SESSION['akses_login'] == "SPV T ULP" ) 
								{
									?> -->
								<li class="active">
									<a href="#tab_1_1" data-toggle="tab">
									Gambar Survei</a>
								</li>
								<!-- <?php
								}	
								?> -->
								<?php
								if ($_SESSION['akses_login'] == "M UP3" || $_SESSION['akses_login'] == "MB UP3"
									|| $_SESSION['akses_login'] == "M ULP" || $_SESSION['akses_login'] == "PENGAWAS" || $_SESSION['akses_login'] == "Ren UP3"  ) 
								{
									?>
								<li>
									<a href="#tab_1_2" data-toggle="tab">
									Bukti UID </a>
								</li>
								<?php
								}	
								?>
								<?php
								if ($_SESSION['akses_login'] == "PEJABAT PENGADAAN" || $_SESSION['akses_login'] == "M UP3" || $_SESSION['akses_login'] == "MB UP3"
									|| $_SESSION['akses_login'] == "M ULP" || $_SESSION['akses_login'] == "PENGAWAS" ) 
								{	
								?>
								<li>
									<a href="#tab_1_3" data-toggle="tab">
									Bukti Kontrak </a>
								</li>
								<?php
								}	
								?>
								<?php
								if ($_SESSION['akses_login'] == "M UP3" || $_SESSION['akses_login'] == "MB UP3"
									|| $_SESSION['akses_login'] == "M ULP" || $_SESSION['akses_login'] == "PENGAWAS" ) 
								{	
								?>
								<li>
									<a href="#tab_1_4" data-toggle="tab">
									Bukti Kemajuan <br/> Pelaksanaan </a>
								</li>
								<li>
									<a href="#tab_1_5" data-toggle="tab">
									BAST 1 </a>
								</li>
								<li>
									<a href="#tab_1_6" data-toggle="tab">
									BAST 2 </a>
								</li>

								<?php
								}	
								?>
							

								<?php
							// }
								?>
							</ul>
							<div class="tab-content">
								<!-- BEGIN TAB1-->
								<div class="tab-pane active" id="tab_1_1">
									<div class="form-body">
										<div class="form-group">
											
										</div>
									</div>

									<table class="table table-striped table-hover table-bordered display">
										<thead>
											<tr>
												<th class='text-center'>Nama File</th>
												<th>Tipe</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<td><?php echo $uraian_usulan->GAMBAR?></td>
											<td><?php echo $uraian_usulan->TIPE_GAMBAR ?></td>
											<td><a class="btn btn-sm btn-primary"  href="<?php echo base_url();?>UsulanController/tampilGambar/<?php echo $uraian_usulan->ID_USULAN ?>/GambarSurvey" target="_blank">Lihat</a></td>										
										</tbody>
									</table>
								</div>
								<!-- END TAB1-->
								<!-- BEGIN TAB2-->
								<div class="tab-pane" id="tab_1_2">
									<div class="form-body">
										<div class="form-group">
											<?php 			
											if ($_SESSION['akses_login'] == "Ren UP3" ) { 
													echo $formBuktiUID;
											} ?>
										</div>
									</div>
									<?php 
										if($uraian_usulan->BUKTI_UID != NULL){
									?>
									<table class="table table-striped table-hover table-bordered display">
										<thead>
											<tr>
												<th class='text-center'>Nama File</th>
												<th>Tipe</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<td><?php echo $uraian_usulan->BUKTI_UID; ?></td>
											<td><?php echo $uraian_usulan->TIPE_BUKTIUID; ?></td>
											<td>
												<a class="btn btn-sm btn-primary"  href="<?php echo base_url();?>UsulanController/tampilGambar/<?php echo $uraian_usulan->ID_USULAN ?>/BuktiUid"  onclick='return confirm("Anda yakin ingin melihat Bukti UID ?")' target="_blank">Lihat</a>												
											</td>
										</tbody>
									</table>
									<?php 
									}

									?>
								</div>
								<!-- END TAB2-->
							<?php
							// if ($_SESSION['akses_login'] == "PEJABAT PENGADAAN" || $_SESSION['akses_login'] == "M UP3" || $_SESSION['akses_login'] == "MB UP3"
							// || $_SESSION['akses_login'] == "M ULP") 
							// {
								
							?>
							<?php
							if ($_SESSION['akses_login'] != "SPV T ULP" || $_SESSION['akses_login'] != "Ren UP3") 
							
							{	
							?>
								<!-- BEGIN TAB3-->
								<div class="tab-pane" id="tab_1_3">
									<div class="form-body">
										<div class="form-group">
											<?php
											if($_SESSION['akses_login'] == "PEJABAT PENGADAAN"){
												echo "<div style='height: 60px;'>";
												echo $formUnggahKontrak;
												echo "</div>";
											}
											?>
										</div>
									</div>
									<?php 
										if($uraian_usulan->BUKTI_KONTRAK != NULL){
									?>
									<table class="table table-striped table-hover table-bordered display">
										<thead>
											<tr>
												<th class='text-center'>Nama File</th>
												<th>Tipe</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<td><?php echo $uraian_usulan->BUKTI_KONTRAK; ?></td>
											<td><?php echo $uraian_usulan->TIPE_BUKTIKONTRAK; ?></td>
											<td>
												<a class="btn btn-sm btn-primary"  href="<?php echo base_url();?>UsulanController/tampilGambar/<?php echo $uraian_usulan->ID_USULAN ?>/BuktiKontrak" onclick='return confirm("Anda yakin ingin melihat Bukti Kontrak ?")' target="_blank">Lihat</a>												
											</td>
										</tbody>
									</table>
									<?php 
										}
										else {
											echo "<h4 align='center'>Bukti Kontrak belum diunggah</h4>";
										}
									?>
								</div>
								<!-- END TAB3-->
								<?php
								}	
								?>

								<!-- BEGIN TAB4-->
								<div class="tab-pane" id="tab_1_4">
									<div class="form-body">
										<div class="form-group">
											<?php
												if ($_SESSION['akses_login'] == "PENGAWAS" ){
											?>
											<form enctype='multipart/form-data' method='POST' action='<?php echo base_url(); ?>UsulanController/unggahBuktiKemajuan/<?php echo $uraian_usulan->ID_USULAN; ?>'>
												<table class="table table-bordered table-hover">	
													<tr>
														<td style="vertical-align: middle;"  >CATATAN</td>
														<td>
															<textarea type="text" name="deskripsi" class="form-control" value = "" placeholder ="Tulis disini..."></textarea>
														</td>	
													</tr>						
													<tr>
														<td style="vertical-align: middle;">BUKTI <br>KEMAJUAN PELAKSANAAN<br/></td>
														<td>
															<input type="file" name="bukti_kemajuan" class="form-control">	
														</td>	
													</tr>
												</table>
											
												<button  type='submit' onclick='return confirm("Apakah anda yakin dengan data yang anda masukkan ?")' class='btn btn-primary'>SUBMIT</button>&nbsp;&nbsp;
											</form>
											<?php
											}											?>
										</div>
									</div>
									<?php 
										if($uraian_usulan->BUKTI_KEMAJUAN != NULL){
									?>
									<table class="table table-striped table-hover table-bordered display">
										<thead>
											<tr>
												<th class='text-center'>Nama File</th>
												<th>Tipe</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<td><?php echo $uraian_usulan->BUKTI_KEMAJUAN; ?></td>
											<td><?php echo $uraian_usulan->TIPE_BUKTIKEMAJUAN; ?></td>
											<td>
												<a class="btn btn-sm btn-primary"  href="<?php echo base_url();?>UsulanController/tampilGambar/<?php echo $uraian_usulan->ID_USULAN ?>/Progress" onclick='return confirm("Anda yakin ingin melihat Bukti Kemajuan Pelaksanaan ?")' target="_blank">Lihat</a>												
											</td>
										</tbody>
									</table>
									<?php 
										}
										else {
											echo "<h4 align='center'>Bukti kemajuan belum diunggah</h4>";
										}
									?>
								</div>
								<!-- END TAB4-->

								<!-- BEGIN TAB5-->
								<div class="tab-pane" id="tab_1_5">
									<div class="form-body">
										<div class="form-group">
											<?php
												if ($_SESSION['akses_login'] == "PENGAWAS" ){
											?>
											<form enctype='multipart/form-data' method='POST' action='<?php echo base_url(); ?>UsulanController/unggahBast1/<?php echo $uraian_usulan->ID_USULAN; ?>'>
												<table class="table table-bordered table-hover">	
													<tr>
														<td style="vertical-align: middle;"  >CATATAN</td>
														<td>
															<textarea type="text" name="deskripsi" class="form-control" value = "" placeholder ="Tulis disini..."></textarea>
														</td>	
													</tr>						
													<tr>
														<td style="vertical-align: middle;">BUKTI <br>SELESAI PELAKSANAAN<br/></td>
														<td>
															<input type="file" name="bast1" class="form-control">	
														</td>	
													</tr>
												</table>
												<button  type='submit' onclick='return confirm("Apakah anda yakin dengan data yang anda masukkan ?")' class='btn btn-primary'>SUBMIT</button>&nbsp;&nbsp;
											</form>
											<?php
												}
											?>
										</div>
									</div>
									<?php 
										if($uraian_usulan->BAST1 != NULL){
									?>

									<table class="table table-striped table-hover table-bordered display">
										<thead>
											<tr>
												<th class='text-center'>Nama File</th>
												<th>Tipe</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<td><?php echo $uraian_usulan->BAST1; ?></td>
											<td><?php echo $uraian_usulan->TIPE_BAST1; ?></td>
											<td>
												<a class="btn btn-sm btn-primary"  href="<?php echo base_url();?>UsulanController/tampilGambar/<?php echo $uraian_usulan->ID_USULAN ?>/Bast1" onclick='return confirm("Anda yakin ingin melihat Bukti Selesai Pelaksanaan ?")' target="_blank">Lihat</a>												
											</td>
										</tbody>
									</table>
									<?php 
										}
										else {
											echo "<h4 align='center'>BAST 1 belum diunggah</h4>";
										}
									?>
								</div>
								<!-- END TAB5-->
								<!-- BEGIN TAB6-->
								<div class="tab-pane" id="tab_1_6">
									<div class="form-body">
										<div class="form-group">
										<?php
											if ($_SESSION['akses_login'] == "PENGAWAS" ){
										?>
											<form enctype='multipart/form-data' method='POST' action='<?php echo base_url(); ?>UsulanController/unggahBast2/<?php echo $uraian_usulan->ID_USULAN; ?>'>
												<table class="table table-bordered table-hover">
													<tr>
														<td style="vertical-align: middle;"  >CATATAN</td>
														<td>
															<textarea type="text" name="deskripsi" class="form-control" value = "" placeholder ="Tulis disini..."></textarea>
														</td>	
													</tr>						
													<tr>
														<td style="vertical-align: middle;">BUKTI <br>SELESAI PENGOPERASIAN<br/></td>
														<td>
															<input type="file" name="bast2" class="form-control">	
														</td>	
													</tr>
												</table>
												<button  type='submit' onclick='return confirm("Apakah anda yakin dengan data yang anda masukkan ?")' class='btn btn-primary'>SUBMIT</button>&nbsp;&nbsp;
											</form>
											<?php
											}
											?>
										</div>
									</div>
									<?php 
										if($uraian_usulan->BAST2 != NULL){
									?>

									<table class="table table-striped table-hover table-bordered display">
										<thead>
											<tr>
												<th class='text-center'>Nama File</th>
												<th>Tipe</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<td><?php echo $uraian_usulan->BAST2; ?></td>
											<td><?php echo $uraian_usulan->TIPE_BAST2; ?></td>
											<td>
												<a class="btn btn-sm btn-primary"  href="<?php echo base_url();?>UsulanController/tampilGambar/<?php echo $uraian_usulan->ID_USULAN ?>/Bast2" onclick='return confirm("Anda yakin ingin melihat Bukti Selesi Pelaksanaan?")' target="_blank">Lihat</a>												
											</td>
										</tbody>
									</table>
									<?php 
										}
										else {
											echo "<h4 align='center'>BAST 2 belum diunggah</h4>";
										}
									?>
								</div>
								<!-- END TAB6-->
							<?php
							// }
							?>
							</div>
						</div>
					</div>
				<!-- </div> -->
    </div>
    </div>
				
	<div class="col-lg-12">
	<!-- KONSTRUKSI USULAN  -->
	<div class="portlet box red">
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
						<?php foreach ($subprk as $list_pekerjaan): ?>
							<div class="portlet box blue-hoki">
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
														<tr>
															<th class="text-center" >Nama Konstruksi</th>
															<th class="text-center" >Volume Konstruksi</th>
															<th class="text-center" >Harga</th>
														
														</tr>
													</thead>
													<tbody>
													<?php 
															foreach ($konstruksi_usulan as $list_konstruksi_usulan):
																if ($list_konstruksi_usulan->ID_PEKERJAAN == $list_pekerjaan->ID_PEKERJAAN) {
														?>
															<tr>
																<td class="text-center"><?php echo $list_konstruksi_usulan->NAMA_KONSTRUKSI ?></td>
																<?php
																if ($list_konstruksi_usulan->VOLUME_KONSTRUKSI == 0) {
																?>
																<td class="text-center"><?php echo "-"?></td>
																<?php
																}
																else {

																?>
																	<td class="text-center"><?php echo $list_konstruksi_usulan->VOLUME_KONSTRUKSI ?></td>
																<?php
																}
																
																?>
																	
													
																<?php 
																	if ($uraian_usulan->TAHAPAN != "TAHAP1" 
																	AND $uraian_usulan->STATUS != "Revisi Verifikasi Perencanaan UP3"
																	AND $uraian_usulan->STATUS != "Verifikasi Perencanaan UP3"){
																?>
																<td class="text-center"><?php 
																
																$hargaformat = number_format($list_konstruksi_usulan->HARGA_TOTAL,2);
								
																echo "Rp.".$hargaformat;
																
																?></td>
																<?php
																}	
																else {
																$hargaformat = number_format(0,2);
								
																
																?>	
																<td class="text-center"><?php echo "Rp.".$hargaformat;?></td>
														<?php
																	}
																}  	
															endforeach 
														?>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>	
						<?php endforeach ?>
					
						</form>
					</div>
				</div>
			</div>
			<!-- END KONSTRUKSI USULAN -->
	<div>		
	
					
					
			
