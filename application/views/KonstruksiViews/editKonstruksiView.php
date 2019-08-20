<div class="page-content">
	<div class="row">
		<div class="col-md-12">
			<h3 class="page-title">
				EDIT KONSTRUKSI
			</h3>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<i class="icon-rocket"></i>
					<a href="<?php echo base_url()?>KonstruksiController">
						KONSTRUKSI
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="#">
						EDIT
					</a>
				</li>
			</ul>
		</div>

		<div class="col-xs-12">
			<?php echo $_SESSION['log'];
			$_SESSION['log']="";
			?>

			<!-- FORM EDIT KONSTRUKSI -->
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-globe"></i>Konstruksi
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
					<table class="table table-striped table-bordered table-hover" >
						<thead>
							<tr>
								<th style="vertical-align: middle;" class="text-center">Nama</th>
								<th style="vertical-align: middle;" class="text-center">Harga Satuan</th>
							</tr>
						</thead>
						<tbody>
							<?php
							echo form_open_multipart('KonstruksiController/updateKonstruksi/'.$konstruksi->ID_KONSTRUKSI);
							?>
							<tr>
								<td ><input type="text" name="nama" class="form-control" value="<?php echo $konstruksi->NAMA_KONSTRUKSI ?>" required></td>
								<td ><input type="number" name="harga" class="form-control" value="<?php echo $konstruksi->HARGA ?>" required></td>
							</tr>
						</tbody>
					</table>
					<button  type="submit" class="btn btn-success" onclick="return confirm('Anda yakin akan memperbarui data konstruksi?')" >Simpan</button>
					<a class ="btn btn-danger" href="<?php echo base_url()?>KonstruksiController">Batal</a>			
					
							<?php 
							echo form_close();
							?>
				</div>
			</div>
			<!-- FORM EDIT KONSTRUKSI -->

			<!-- TAMBAH KONSTRUKSI DALAM PEKERJAAN -->
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-globe"></i> Konstruksi Pada Pekerjaan
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

								<!-- FORM TAMBAH KONSTRUKSI DALAM PEKERJAAN -->
								<div class="tab-content">
									<div class="tab-pane active">
										<div class="row w-100" style="margin-bottom: 3px">
											<div class="col-md-6">
												<div class="btn-group">
												
													<table>
														<tr>
															<td>
																<?php echo form_open_multipart('KonstruksiController/tambah_konstruksi_dlm_pekerjaan/'.$konstruksi->ID_KONSTRUKSI); ?>
																<select class="select2 form-control" name="pekerjaan">
																	<option  value="">Pilih Pekerjaan</option>
																	<?php 	foreach ($pekerjaan as $key) {
																		?>
																		<option  value="<?php echo $key->ID_PEKERJAAN ?>"><?php echo $key->NAMA_PEKERJAAN ?></option>
																		<?php
																	} ?>

																</select>
															</td>
															<td>
																&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															</td>
															<td>
																<button class="btn blue">
																	Tambah <i class="fa fa-plus"></i>

																</button>
																<a class ="btn btn-danger" href="<?php echo base_url()?>KonstruksiController">Batal</a>
															</td>
														</tr>
													</table>
													<br>
													
													<?php 	echo form_close(); ?>
												</div>
											</div>
										</div>
										<!-- FORM TAMBAH KONSTRUKSI DALAM PEKERJAAN -->
										
										<!-- DAFTAR KONSTRUKSI DALAM PEKERJAAN -->
										<table class="table table-striped table-bordered table-hover" id="datatable">
											<thead>
												<tr>
													<th style="vertical-align: middle;" class="text-center">Nama Konstruksi</th>
													<th style="vertical-align: middle;" class="text-center">Pekerjaan</th>
													<th style="vertical-align: middle;" class="text-center">Aksi</th>

												</tr>
											</thead>
											<tbody>
											<?php
											foreach($kons_pekerjaan as $list):
											?>
												<tr>
													<td style='vertical-align: middle;' class='text-center'><?php echo $list->NAMA_KONSTRUKSI?></td>
													<td style='vertical-align: middle;' class='text-center'><?php echo $list->NAMA_PEKERJAAN?></td>
													<td>
														<a class="btn btn-xs btn-danger" title="Hapus Member"  href="<?php echo base_url()?>KonstruksiController/hapus_konstruksi_dlm_pekerjaan/<?php echo $list->ID_PEKERJAAN ?>/<?php echo $list->ID_KONSTRUKSI?>" onclick="return confirm('Anda yakin menghapus konstruksi dalam pekerjaan?')"><i class="glyphicon glyphicon-trash"></i>&nbsp;Hapus</a>
													</td>
 												</tr>
											<?php
											endforeach;
											?>
											</tbody>							
										</table>
											<!-- END DAFTAR KONSTRUKSI DALAM PEKERJAAN -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END TAMABAH KONSTRUKSI DALAM PEKERJAAN -->			
		</div>
	</div>
</div>
