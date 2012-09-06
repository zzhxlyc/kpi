<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $view->charset(); ?>
<?php $view->title(); ?>
<?php $view->fetch_meta(); ?>
<?php $view->icon(); ?>
<?php $view->css('style_admin'); ?>
<?php $view->fetch_css(); ?>
<script>
	window.ROOT_URL = '<?php echo ROOT_URL?>';
	window.IMAGE_HOME = '<?php echo IMAGE_HOME?>';
</script>
<?php $view->js('jquery.min'); ?>
<?php $view->js('jquery-ui.min'); ?>
<?php $view->js('common'); ?>
<?php $view->fetch_js(); ?>
</head>
<body>
<?php if($request->get_method() != 'login'){?>
<div id="header">
<div id="header_toolbar">
<div class="grid_1">
<h1>杭州钱鸿集团KPI系统</h1>
</div>
<div class="grid_2">
<div class="toolbar_large">
<div class="toolicon"><div class="user_icon"></div></div>
<div class="toolmenu">
<div class="toolcaption" style="min-width: 46px;"><span><?php echo $User->name?></span>
</div>
</div>
<div class="toolicon_lock"><div class="lock_icon"></div></div>
<div class="loginout"><a class="header"
	href="<?php echo ROOT_URL.'/loginout'?>">注销</a></div>
</div>
</div>
</div>
<div class="header_main nav">
<div class="container_12"></div>
</div> </div>

<?php include($TEMPLATE_PAGE); ?>

<div id="footer">
Copyright &copy; 2011 杭州钱鸿集团，保留一切权利。
</div>
<?php }else{?>
<?php include($TEMPLATE_PAGE); ?>

<div id="footer" style="position: absolute; top: 880px; bottom:0px;">
Copyright &copy; 2011 杭州钱鸿集团，保留一切权利。
</div>
<?php }?>
</body>
</html>
