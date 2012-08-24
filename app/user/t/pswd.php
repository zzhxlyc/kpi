<form action="<?php echo $home.'/pswd'?>" method="post" >

<div class="row">
	<label for="name">姓名</label>
	<?php echo $user->name?>
</div>

<div class="row">
	<label for="slug">账号</label>
	<?php echo $user->slug?>
</div>

<div class="row">
	<label for="password">原密码</label>
	<input size="30" type="password" name="password" />
	<span class="error"><?php echo $errors['password']?></span>
</div>

<div class="row">
	<label for="password">新密码</label>
	<input size="30" type="password" name="password1" />
	<span class="error"><?php echo $errors['password1']?></span>
</div>

<div class="row">
	<label for="password2">确认密码</label>
	<input size="30" type="password" name="password2" />
	<span class="error"><?php echo $errors['password2']?></span>
</div>

<div class="row">
	<input type="submit" value="保存" />
</div>

</form>

<?php 
	output_edit_success();
?>
