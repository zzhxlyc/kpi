
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
									width="16" height="16" alt="user">
							</div>
							<div class="toolmenu">
								<div class="toolcaption" style="min-width: 46px;">
									<span>管理员</span>
								</div>
							</div>
							<div class="toolicon_lock">
								<img
									src="<?php echo IMAGE_HOME?>/lock.png"
									width="16" height="16" alt="user">
							</div>
							<div class="loginout">
								<a class="a_loginout" href="<?php echo ROOT_URL.'/loginout'?>"> 注销</a>
							</div>
					</div>
				</div>
		</div>
		<nav id="header_main">
		<div class="container_12">
		</div>
		</nav>
</header>		

<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>
		<div id="content">
			<form action="" method="post" >
				<div class="edit_panel">
					<div class="title">
						<h5></h5>
					</div>
					
					<div class="data">
						<label for="name">部门名称</label>
						<input size="20" type="text" name="name" value="<?php echo $depart->name?>" />
						<span class="error"><?php echo $errors['name']?></span>
					</div>	

					<div class="data">
						<input type="submit" value="保存" />
						<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
						<input type="hidden" name="id" value="<?php echo $depart->id?>" />
					</div>
					<div class="data">
						<?php 
							output_edit_success();
						?>
					</div>
				</div>
			</form>

		</div>		
<?php
	}
?>
