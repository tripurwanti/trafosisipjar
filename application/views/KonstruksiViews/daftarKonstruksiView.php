<div class="page-content" >
	<div class="row">
		<div class="col-md-12">
			<h3 class="page-title">
				KONSTRUKSI
			</h3>
			<ul class="page-breadcrumb breadcrumb">
					<li>
						<a href="<?php echo base_url()?>LoginController/home">
						HOME
						</a>
					</li>
					<li>				
						<a href="<?php echo base_url()?>KonstruksiController">
						KONSTRUKSI
						</a>
					</li>
			</ul>
		</div>

		<div class="col-xs-12">
			<?php echo $_SESSION['log'];
			$_SESSION['log']="";
			?>

			<!-- DAFTAR KONSTRUKSI -->
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
					<div class="table-toolbar">
						<div class="row">
							<div class="col-md-6">
								<div class="btn-group">
									<button data-toggle='modal' data-target='#inaddModal' class="btn green">
										Tambah <i class="fa fa-plus"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
					<table class="table table-striped table-bordered table-hover" id="konstruksidatatable" >
						<thead>
							<tr>
								<th style="vertical-align: middle;" class="text-center">Id Konstruksi</th>								
								<th style="vertical-align: middle;" class="text-center">Nama</th>
								<th style="vertical-align: middle;" class="text-center">Harga</th>
								<th style="vertical-align: middle;" class="text-center">AKSI</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($konstruksi as $listkonstruksi): ?>
							<tr>
								<td class='text-center'><?php echo $listkonstruksi->ID_KONSTRUKSI ?></td>
								<td class='text-center'><?php echo $listkonstruksi->NAMA_KONSTRUKSI ?></td>
								<td class='text-center'>
								<?php 
								$hargaformat = number_format($listkonstruksi->HARGA,2);
								
								echo "Rp.".$hargaformat;
								
								?>
								</td>
								<td width="175" class="text-center">
									<?php echo "<a class='btn btn-xs btn-success' href='".base_url()."KonstruksiController/editKonstruksi/".$listkonstruksi->ID_KONSTRUKSI."'><i class='glyphicon glyphicon-edit'></i>&nbsp;Edit</a>"; ?>
									<a class="btn btn-xs btn-danger" title="Hapus Member"  href="<?php echo base_url()?>KonstruksiController/hapusKonstruksi/<?php echo $listkonstruksi->ID_KONSTRUKSI?>" onclick="return confirm('Anda yakin akan menghapus konstruksi?')"><i class="glyphicon glyphicon-trash"></i>&nbsp;Hapus</a>		
								<?php echo "
								</td>
							</tr>";
							endforeach;?>
						</tbody>							
					</table>
				</div>
			</div>
			<!-- END DAFTAR KONSTRUKSI -->

		</div>
	</div>
</div>
		
<!-- FORM TAMBAH KONSTRUKSI -->
<div id="inaddModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Tambah Konstruksi</h4>
	</div>
	<div class="modal-body">
		<form method="POST" action="<?php echo base_url()?>KonstruksiController/tambahKonstruksi" class="form-horizontal" role="form">
			<table class="table table-bordered">
				<thead bgcolor="#f9f9f9">
					<tr>
						<th style="vertical-align: middle;" class="text-center">Nama</th>
						<th style="vertical-align: middle;" class="text-center">Harga</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="text-center"><input type="text" name="nama" class="form-control" required></td>
						<td class="text-center"><input type="text" name="harga" class="form-control" required></td>
					</tr>
				</tbody>
			</table>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
		<button class="btn blue">Tambah</button>
	</div>		
		</form>
	</div>
</div>
<!-- FORM TAMBAH KONSTRUKSI -->