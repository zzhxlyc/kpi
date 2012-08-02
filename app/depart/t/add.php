
<form action="" method="post" >
	
<div class="row">
	<label for="name">部门名称</label>
	<input size="20" type="text" name="name" value="<?php echo $depart->name?>" />
	<span class="error"><?php echo $errors['name']?></span>
</div>	

<div class="row">
	<input type="submit" value="保存" />
	<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
</div>

</form>


