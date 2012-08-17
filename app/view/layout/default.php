<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $view->charset(); ?>
<?php $view->title(); ?>
<?php $view->fetch_meta(); ?>
<?php $view->icon(); ?>
<?php $view->css('style_login'); ?>
<?php $view->css('reset'); ?>
<?php $view->css('style_admin'); ?>
<?php $view->css('blue'); ?>
<?php $view->fetch_css(); ?>
<script>
	window.ROOT_URL = '<?php echo ROOT_URL?>';
	window.IMAGE_HOME = '<?php echo IMAGE_HOME?>';
</script>
<?php $view->js('modernizr-2.0.6.min'); ?>
<?php $view->js('jquery.min'); ?>
<?php $view->js('jquery-ui.min'); ?>
<?php $view->js('23acda8'); ?>
<?php $view->js('common'); ?>
<?php $view->fetch_js(); ?>
</head>
<body>
	<div id="wrapper">
		<div id="main" class="clearfix">

			<?php include($TEMPLATE_PAGE); ?>
			
		</div>
	</div><!--end for wrapper-->
</body>
</html>
