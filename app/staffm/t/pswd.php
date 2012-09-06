<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>
<div id="right">
<form action="" method="post" >
<div class="box">
<div class="header_main title">
<h2>修改密码</h2>
</div>

<div class="data_wrapper">

<div class="data">
	<div class="first-child"><label for="name">姓名</label></div>
	<div class="child"><div class="readonly"><?php echo $user->name?></div></div>
</div>

<div class="data">
	<div class="first-child"><label for="slug">账号</label></div>
	<div class="child"><div class="readonly"><?php echo $user->slug?></div></div>
</div>

<div class="data">
	<div class="first-child"><label for="password">新密码</label></div>
	<div class="child"><input size="20" type="password" name="password" />
	<span class="error"><?php echo $errors['password']?></span></div>
</div>

<div class="data">
	<div class="first-child"><label for="password2">确认密码</label></div>
	<div class="child"><input size="20" type="password" name="password2" />
	<span class="error"><?php echo $errors['password2']?></span></div>
</div>

<div class="data">
	<div class="first-child"><label for="depart">所属部门</label></div>
	<div class="child"><div class="readonly"><?php echo $depart->name?></div></div>
</div>
</div>

<div class="actions">
<div class="actions-left"><input type="submit" value="保存" /></div>
<div class="actions-right"><input type="button" value="返回" onclick="location.href='<?php echo $home."/show?depart=$depart->id"?>'" />
</div>
<input type="hidden" name="id" value="<?php echo $user->id?>" /></div>

</div>
</form>
</div>
<?php 
	}
?>
