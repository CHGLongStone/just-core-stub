<?php 
/**
*
*/
require_once 'harness.php';
if(1 == $_SESSION['role_id']){
	$logoUserVer = '/assets/images/justcore_logo.svg';
}else{
	$logoUserVer = '/assets/images/angrycat.jpeg';
	
}


?>
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="/index.php">
				<img src="<?echo $logoUserVer;?>" alt="logo" height="62" width="62" class="logo-default"/>
			</a>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
			<!-- REQUIRED FOR MIBILE -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		
		<!-- BEGIN TOP NAVIGATION MENU -->

		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->