<?
/**
* header, top menu, main menu, content and footer
*/

@include 'head.php';
?>
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
	<a href="index.html">
	<img src="/assets/img/White.jpeg" alt=""/>
	</a>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
	<?php
		#@include 'header.php';
		#echo '*************DAFUQ!!!!!!!!!!!!!!!!!!!!!!!!!!!!'.PHP_EOL;
		#@include 'content_sparse.php';
		#echo 'here: '.__FILE__.'@'.__LINE__.'load_path['.$load_path.'] $view==<pre>'.var_export($view, true).'</pre><br>';
		$loadPath = JCORE_TEMPLATES_DIR.'HTML/'.$load_path.'.html';
		echo file_get_contents( $loadPath);
		#echo '*************DAFUQ!!!!!!!!!!!!!!!!!!!!!!!!!!!!'.PHP_EOL;
		@include 'endOfpage.php';
		#echo '*************DAFUQ!!!!!!!!!!!!!!!!!!!!!!!!!!!!'.PHP_EOL;
		#@include 'footer.php';
	?>

</body>
<!-- END BODY -->
</html>

