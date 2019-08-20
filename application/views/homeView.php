<div class="page-content">
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">
				HOME
			</h3>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php base_url()?>">
						HOME
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>

		<div class="col-xs-12">	
				
				<!-- PESAN LOG  -->
				<?php echo $_SESSION['log'];
				$_SESSION['log']="";
				?>
				<!-- END PESAN LOG -->
				
				
				<br><br><br>
			</div>
	</div>	
</div>

