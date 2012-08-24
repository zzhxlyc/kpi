
<div id="content">
	<form action="" method="post" >
		<div class="edit_panel">
			<div class="header_main title">
				<h5></h5>
			</div>
			<div class="data_wrapper">
			<div class="data">
				<label for="name">部门名称</label>
				<div><input size="20" type="text" name="name" value="<?php echo $depart->name?>" /></div>
				<span class="error"><?php echo $errors['name']?></span>
			</div>	
			</div>	
			<div class="actions">
				<div class="actions-left"><input type="submit" value="保存" /></div>
				<div class="actions-right"><input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" /></div>
			</div>
		</div>
	</form>
</div>	


