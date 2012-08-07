<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>
<form action="" method="post" >

<div class="row">
	<label for="name">姓名</label>
	<?php echo $user->name?>
</div>

<div class="row">
	<label for="slug">账号</label>
	<?php echo $user->slug?>
</div>

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
	<label for="depart">所属部门</label>
	<?php echo $depart->name?>
</div>

<div class="row">
	<input type="submit" value="保存" />
	<input type="button" value="返回" onclick="location.href='<?php echo $home."/show?depart=$depart->id"?>'" />
	<input type="hidden" name="id" value="<?php echo $user->id?>" />
</div>

</form>
<?php 
	}
?>
