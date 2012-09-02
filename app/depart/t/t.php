<div id="content">
	<div id="left">
		<?php include(MODULE_DIR.'/sidebar/sidebar.php')?>
	</div>

<?php 
if(file_exists($view->get_template())){
	include($view->get_template());
}
?>
</div>