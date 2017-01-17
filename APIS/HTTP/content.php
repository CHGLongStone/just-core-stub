<?php 
/**
*
*/
require_once 'harness.php';
?>
<div class="clearfix">
</div>
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<?php 
		@include 'sidebar.php';
	?>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			
			
			</div>
			<!-- BEGIN PAGE HEADER-->

			<!-- END PAGE HEADER-->
			
			<!-- BEGIN PAGE CONTENT-->
			<?php 
			include 'pageloader.php';
			?>
			<!-- END PAGE CONTENT-->
				
		</div>
	</div>
	<!-- END CONTENT -->
</div>