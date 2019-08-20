<head>
	<meta charset="utf-8"/>
	<title>LKAI | SUSUT DISTRIBUSI <?php //echo $title;?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="<?php echo base_url()?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url()?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url()?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url()?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url()?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/select2/select2.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
	<link href="<?php echo base_url()?>assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url()?>assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL STYLES -->
	<!-- BEGIN THEME STYLES -->
	<link href="<?php echo base_url()?>assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url()?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url()?>assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
	<link id="style_color" href="<?php echo base_url()?>assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url()?>assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
	<!-- END THEME STYLES -->
	<link rel="shortcut icon" href="<?php echo base_url()?>assets/img/favicon.ico"/>
</head>
<body>
	<!-- BEGIN HEADER -->
	<div class="page-header navbar navbar-fixed-top" style="background-color: #282828;">
		<div class="col-md-12 col-sm-12 col-xs-12" >
			<div class="col-md-6 col-sm-6 col-xs-6">
				<a href="<?php echo base_url()?>">
					<img src="<?php echo base_url()?>assets/img/pln5.PNG" style="margin-top:5px; margin-left:50px; "width="100px" height="41px" alt="logo" class="img-responsive">
				</a>
			</div>

			<div align="right" class="col-md-6 col-sm-6 col-xs-6">
			
			<?php if($param == 'GambarSurvey') {?>
			<a style="margin-top: 5px" class="btn btn-info btn-md" onclick="return confirm('Anda yakin akan mengunduh gambar?')" href="<?php echo base_url()?>UsulanController/unduhGambar/<?php echo $usulan->ID_USULAN;?>/<?php echo $param?>">
					<span class="glyphicon glyphicon-circle-arrow-down"></span> Unduh
					
			</a>
			<?php
			}
			?>
				
			</div>

		</div>
	</div>

	
	<!-- END HEADER -->
	<div  style="margin-top: 100px;">
		<div >
			<div class="col-md-10 col-md-offset-1">
			<?php
				if($param == 'GambarSurvey'){
			?>
				<img align="center" src="<?php echo base_url()?>assets/data_upload/Gambar_Survey/<?php echo $usulan->LOKASI; ?>/<?php echo $usulan->GAMBAR; ?>" height="auto" width="100%">
			<?php
				}
				else if($param == 'BuktiUid'){
			?>
				<img align="center" src="<?php echo base_url()?>assets/data_upload/Bukti_UID/<?php echo $usulan->LOKASI; ?>/<?php echo $usulan->BUKTI_UID; ?>" height="auto" width="100%">
				
			<?php
				}
				else if($param == 'BuktiKontrak'){
			?>
				<img align="center" src="<?php echo base_url()?>assets/data_upload/Bukti_Kontrak/<?php echo $usulan->LOKASI; ?>/<?php echo $usulan->BUKTI_KONTRAK; ?>" height="auto" width="100%">
				
			<?php
				}
				else if($param == 'Progress'){
			?>
				<img align="center" src="<?php echo base_url()?>assets/data_upload/Bukti_Pelaksanaan/<?php echo $usulan->LOKASI; ?>/<?php echo $usulan->BUKTI_KEMAJUAN; ?>" height="auto" width="90%">
				
			<?php
			} 
			else if($param == 'Bast1'){
			?>
				<img align="center" src="<?php echo base_url()?>assets/data_upload/Bukti_Pelaksanaan/<?php echo $usulan->LOKASI; ?>/<?php echo $usulan->BAST1; ?>" height="auto" width="100%">		
			<?php
			} else if($param == 'Bast2' ){
			?>
				<img align="center" src="<?php echo base_url()?>assets/data_upload/Bukti_Pelaksanaan/<?php echo $usulan->LOKASI; ?>/<?php echo $usulan->BAST2; ?>" height="auto" width="100%">
						
			<?php
			} 

			?> 			
			</div>
			
		</div>
	</div>
</body>