<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>
<form action="" method="post" >
	

<div class="row">
	<label for="password">新密码</label>
	<input size="20" type="password" name="password" />
	<span class="error"><?php echo $errors['password']?></span>
</div>

<div class="row">
	<label for="password2">确认密码</label>
	<input size="20" type="password" name="password2" />
	<span class="error"><?php echo $errors['password2']?></span>
</div>

<div class="row">
	<input type="submit" value="保存" />
	<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
	<input type="hidden" name="id" value="<?php echo $user->id?>" />
</div>

</form>
<?php 
	}
?>
