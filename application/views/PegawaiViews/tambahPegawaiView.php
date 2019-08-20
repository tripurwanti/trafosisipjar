<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.1
Version: 3.6
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8"/>
	<title>LKAI | TRAFO SISIPAN</title>
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
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="<?php echo base_url()?>assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
	<!-- <link href="<?php echo base_url()?>assets/admin/pages/css/login3.css" rel="stylesheet" type="text/css"/> -->
	<link href="<?php echo base_url()?>assets/admin/pages/css/login5.css" rel="stylesheet" type="text/css"/>

	<!-- END PAGE LEVEL SCRIPTS -->
	<!-- BEGIN THEME STYLES -->
	<link href="<?php echo base_url()?>assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url()?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url()?>assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url()?>assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="<?php echo base_url()?>assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
	<!-- END THEME STYLES -->
	<link rel="shortcut icon" href="<?php echo base_url()?>assets/img/favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body style="background-image: url('./assets/img/bg/pln3.jpg');  background-repeat: no-repeat; background-size: cover; position: relative;" >
	<div class="login"> 
	
		<!-- BEGIN LOGO -->
		<div class="logo">
			<img src="<?php echo base_url()?>assets/img/favicon.ico" alt=""/> 
		</div>
		<!-- END LOGO -->
		<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
		<div class="menu-toggler sidebar-toggler">
		</div>
		<!-- END SIDEBAR TOGGLER BUTTON -->

		<!-- BEGIN REGISTRASI-->
		<div class="content">
			<?php echo form_open_multipart('PegawaiController/tambah','class="login-form"'); ?>
			<h3 class="form-title">Tambah Akun Pegawai</h3>
            <?php echo $_SESSION['log'];
				$_SESSION['log']="";
			?>

            <div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">NIP</label>
				<div class="input-icon">
					<i class="fa fa-font"></i>
					<input class="form-control placeholder-no-fix" type="text" placeholder="NIP" name="nip" required />
				</div>
			</div>

            <div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Nama</label>
				<div class="input-icon">
					<i class="fa fa-font"></i>
					<input class="form-control placeholder-no-fix" type="text" placeholder="Nama Lengkap" name="nama" required />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">UNIT</label>
				<div class="input-icon">
					<i class="fa fa-map-marker"></i>
					<select class="select2 form-control" name="unit" required>
						<option value="">UNIT</option>
						<option value="UP3">UP3</option>
						<option value="51301">ULP Lawang</option>
						<option value="51302">ULP Bululawang</option>
						<option value="51303">ULP Batu</option>
						<option value="51304">ULP Singosari</option>
						<option value="51305">ULP Kepanjen</option>
						<option value="51306">ULP Tumpang</option>
						<option value="51307">ULP Gondanglegi</option>
						<option value="51308">ULP Dampit</option>
						<option value="51309">ULP Ngantang</option>
						<option value="51310">ULP Sumber Pucung</option>
						<option value="51311">ULP Dinoyo</option>
						<option value="51312">ULP Blimbing</option>
						<option value="51313">ULP Malang Kota</option>
						<option value="51314">ULP Kebon Agung</option>
					</select>	
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">JABATAN</label>
				<div class="input-icon">
					<i class="fa fa-envelope"></i>
					<select name="jabatan" class="select2 form-control" required>
						<option value="">JABATAN</option>
						
						<option value="M UP3">Manajer UP3</option>
						<option value="MB UP3">Manajer Bagian Perencanaan UP3</option>
						<option value="PENGAWAS">Pengawas Pelaksana</option>
						<option value="PEJABAT PENGADAAN">Pejabat Pengadaan</option>
						<option value="Ren UP3">Staff Perencanaan UP3</option>
						<option value="M ULP">Manajer ULP Lawang</option>
						<option value="M ULP">Manajer ULP Bululawang</option>
						<option value="M ULP">Manajer ULP Batu</option>
						<option value="M ULP">Manajer ULP Singosari</option>
						<option value="M ULP">Manajer ULP Kepanjen</option>
						<option value="M ULP">Manajer ULP Tumpang</option>
						<option value="M ULP">Manajer ULP Gondanglegi</option>
						<option value="M ULP">Manajer ULP Dampit</option>
						<option value="M ULP">Manajer ULP Ngantang</option>
						<option value="M ULP">Manajer ULP Sumber Pucung</option>
						<option value="M ULP">Manajer ULP Dinoyo</option>
						<option value="M ULP">Manajer ULP Blimbing</option>
						<option value="M ULP">Manajer ULP Malang Kota</option>
						<option value="M ULP">Manajer ULP Kebon Angung</option>
						
						<option value="SPV T ULP">SPV Teknik ULP Lawang</option>
						<option value="SPV T ULP">SPV Teknik ULP Bululawang</option>
						<option value="SPV T ULP">SPV Teknik ULP Batu</option>
						<option value="SPV T ULP">SPV Teknik ULP Singosari</option>
						<option value="SPV T ULP">SPV Teknik ULP Kepanjen</option>
						<option value="SPV T ULP">SPV Teknik ULP Tumpang</option>
						<option value="SPV T ULP">SPV Teknik ULP Gondanglegi</option>
						<option value="SPV T ULP">SPV Teknik ULP Dampit</option>
						<option value="SPV T ULP">SPV Teknik ULP Ngantang</option>
						<option value="SPV T ULP">SPV Teknik ULP Sumber Pucung</option>
						<option value="SPV T ULP">SPV Teknik ULP Dinoyo</option>
						<option value="SPV T ULP">SPV Teknik ULP Blimbing</option>
						<option value="SPV T ULP">SPV Teknik ULP Malang Kota</option>
						<option value="SPV T ULP">SPV Teknik ULP Kebon Angung</option>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Username</label>
				<div class="input-icon">
					<i class="fa fa-user"></i>
					<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" required />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Password</label>
				<div class="input-icon">
					<i class="fa fa-lock"></i>
					<input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password" required />
				</div>
				<font color="red"><?php echo form_error('password'); ?></font>
			</div>

			<div class="form-actions">
                <a href="<?php echo base_url();?>PegawaiController/daftarPegawai"><button type="button" class="btn"><i class="m-icon-swapleft"></i>Kembali</button></a>
				<button type="submit" id="register-submit-btn" class="btn green-haze pull-right">
					Submit <i class="m-icon-swapright m-icon-white"></i>
				</button>
			</div>

			<?php 
			echo form_close(); ?>
			<!-- END REGISTRATION FORM -->
		</div>	
	</div>
	<!-- COPYRIGHT -->
	<div  class="copyright">
		<b>LKAI Program Susut Distribusi &copy; 2018 - TRI PURWANTI</b>
	</div>
	<!-- END COPYRIGHT -->

	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

	<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url()?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url()?>assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo base_url()?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url()?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url()?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/pages/scripts/login2.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
	jQuery(document).ready(function() {     
  Metronic.init(); // init metronic core components
  Layout.init(); // init current layout
  Login.init();
  Demo.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>