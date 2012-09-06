
<div id="right">
<form action="<?php echo $home.'/pswd'?>" method="post">
<div class="box">
<div class="header_main title">
<h2>修改密码</h2>
</div>

<div class="data_wrapper">

<div class="data">
<div class="first-child"><label for="name">姓名</label></div>
<div class="child"><div class="readonly"><label><?php echo $user->name?></label></div></div>
</div>

<div class="data">
<div class="first-child"><label for="slug">账号</label></div>
<div class="child"><div class="readonly"><?php echo $user->slug?></div></div>
</div>

<div class="data">
<div class="first-child"><label for="password">原密码</label></div>
<div class="child"><input size="30" type="password" name="password" /> <span
	class="error"><?php echo $errors['password']?></span></div>
</div>

<div class="data">
<div class="first-child"><label for="password">新密码</label></div>
<div class="child"><input size="30" type="password" name="password1" /> <span
	class="error"><?php echo $errors['password1']?></span></div>
</div>

<div class="data">
<div class="first-child"><label for="password2">确认密码</label></div>
<div class="child"><input size="30" type="password" name="password2" /> <span
	class="error"><?php echo $errors['password2']?></span></div>
</div>



</div>

<div class="actions">
<div class="actions-left"><input type="submit" value="保存" /></div>
</div>

<?php 
output_edit_success();
?>

</div>
</form>
</div>
