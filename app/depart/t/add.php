
<div id="right">
	
		<div class="box _edit">
			<div class="header_main title">
			<h2>添加部门</h2>
			</div>
			<form action="" method="post" >
			<div class="data_wrapper">
			<div class="data _edit">
				<div><label for="name">部门名称</label></div>
				<div><input size="20" type="text" name="name" value="<?php echo $depart->name?>" /></div>
				<span class="error"><?php echo $errors['name']?></span>
			</div>	
			</div>	
			<div class="actions">
				<div class="actions-left"><input type="submit" value="保存" /></div>
				<div class="actions-right"><input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" /></div>
			</div>
			</form>
		</div>
	
</div>	


