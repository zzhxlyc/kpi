<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $view->charset(); ?>
<?php $view->title(); ?>
<?php $view->fetch_meta(); ?>
<?php $view->icon(); ?>
<?php //$view->css('style_login'); ?>

<?php $view->css('style_admin'); ?>
<?php //$view->css('blue'); ?>
<?php //$view->css('style-old'); ?>
<?php $view->fetch_css(); ?>
<script>
	window.ROOT_URL = '<?php echo ROOT_URL?>';
	window.IMAGE_HOME = '<?php echo IMAGE_HOME?>';
</script>
<?php $view->js('jquery.min'); ?>
<?php //$view->js('jquery-ui.min'); ?>
<?php //$view->js('23acda8'); ?>
<?php $view->js('common'); ?>
<?php $view->fetch_js(); ?>
</head>
<body>
	<?php if($request->get_method() != 'login'){?>
	<header>
		<div id="header_toolbar">
				<h1 class="grid_1">
					杭州钱鸿集团KPI系统
				</h1>
				<div class="grid_2">
					<div class="toolbar_large">
							<div class="toolicon">
								<img
									src="<?php echo IMAGE_HOME?>/user.png"
									width="16" height="16" alt="user"/>
							</div>
							<div class="toolmenu">
								<div class="toolcaption" style="min-width: 46px;">
									<a class="header" href="<?php echo $home?>/index"><?php echo $User->name?></a>
								</div>
							</div>
							<div class="toolicon_lock">
								<img
									src="<?php echo IMAGE_HOME?>/lock.png"
									width="16" height="16" alt="user"/>
							</div>
							<div class="loginout">
								<a class="header" href="<?php echo ROOT_URL.'/loginout'?>">注销</a>
							</div>
					</div>
				</div>
		</div>
		<nav class="header_main">
		<div class="container_12">
		</div>
		</nav>
	</header>		
	<?php }?>

	<?php include($TEMPLATE_PAGE); ?>

</body>
</html>
