<div class="page-content">
	<div class="row">
		<div class="col-md-12">
			<h3 class="page-title">
				AKUN PEGAWAI
			</h3>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="<?php echo base_url()?>LoginController/Home">
						HOME
					</a>
				</li>
				<li>
					<a href="<?php echo base_url()?>PegawaiController/edit">
						AKUN PEGAWAI
					</a>
				</li>
			</ul>
		</div>
		<div class="col-xs-12">
			<?php echo $_SESSION['log'];
			$_SESSION['log']="";
			?>

			
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-pencil-square"></i> UBAH AKUN PEGAWAI
					</div>
					<div class="tools">
						<!-- <a href="javascript:;" class="collapse">
						</a>
						<a href="javascript:;" class="reload">
						</a>
						<a href="javascript:;" class="fullscreen">
						</a> -->
					</div>
				</div>

				<!-- FORM EDIT AKUN PEGAWAI  -->
				<div class="portlet-body form">
					<?php echo form_open('PegawaiController/update','class="form-horizontal"');?>
					<div class="form-body">
						<table class="table table-striped table-hover table-bordered display" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th width="90%" class="text-center">
										Uraian Kolom
									</th>
									<th width="10%" class="text-center">
										Input
									</th>
								</tr>	
							</thead>
							<tbody>
								<?php
							
									?>
									<tr>
										<td>NIP</td>
										<td>
											<div class="input-group input-large">
												<span class="input-group-addon">
													<i class="fa fa-lock"></i>
												</span>
												<input name="nip" class="form-control" type="text" value="<?php echo $hasil->NIP?>" readonly="yes">
											</div>
										</td>
									</tr>
									<tr>
										<td>NAMA</td>
										<td>
											<font color="#ef4423"><?php echo form_error('nama'); ?></font>
											<div class="input-group input-large">
												<span class="input-group-addon">
													<i class="fa fa-pencil-square"></i>
												</span>
												<input name="nama" class="form-control" type="text" value="<?php echo $hasil->NAMA?>" required>
											</div>

										</td>
									</tr>
									<tr>
										<td>JABATAN</td>
										<td>

											<div class="input-group input-large">
												<span class="input-group-addon">
													<i class="fa fa-user"></i>
												</span>
												<input class="form-control" type="text" value="<?php echo $hasil->JABATAN?>" disabled>
											</div>
										</td>
									</tr>
									<tr>
										<td>UNIT</td>
										<td>

											<div class="input-group input-large">
												<span class="input-group-addon">
													<i class="fa fa-map-marker"></i>
												</span>
												<input class="form-control" type="text" value="<?php echo $hasil->UNIT?>" disabled >
											</div>
										</td>
									</tr>
									<tr>
										<td>USERNAME</td>
										<td>
											<font color="#ef4423"><?php echo form_error('username'); ?></font>
											<div class="input-group input-large">
												<span class="input-group-addon">
													<i class="fa fa-dollar"></i>
												</span>
												<input name="username" class="form-control" type="text" value="<?php echo $hasil->USERNAME?>" required>
											</div>
										</td>
									</tr>
									<tr>
										<td>NEW PASSWORD</td>
										<td>
											
											<div class="input-group input-large">
												<span class="input-group-addon">
													<i class="fa fa-lightbulb-o"></i>
												</span>
												<font color="#ef4423"><?php echo form_error('password'); ?></font>
												<input name="password" type="password" class="form-control placeholder-no-fix" autocomplete="off" placeholder="Password Baru" required >
											</div>
										</td>
									</tr>
									<?php
								?>
							</tbody>
						</table>
					</div>
					<div class="form-actions top">
						<div class="row">
							<div class="col-md-12">
								<div class="pull-right">
									<button type="submit" class="btn green">Simpan</button>
									<a href="<?php echo base_url()?>" class = "btn default">Batal</a>
								</div>
							</div>
						</div>
					</div>
					<?php echo form_close();?>
				</div>
				<!-- FORM EDIT AKUN PEGAWAI  -->
			</div>
		</div>
	</div>
	
</div>
