
<h2>登陆</h2>

<form action="" method="post" >
	
<div class="row">
	<label for="user">账号</label>
	<INPUT class="required" type="text" name="user" value="<?php echo $user?>" /> 
	<span class="error"><?php echo $errors['user']?></span>
</div>

<div class="row">
	<label for="password">密码</label>
	<INPUT class="required" name="password" type="password" /> 
	<span class="error"><?php echo $errors['password']?></span>
</div>

<div class="row">
	<input type="submit" value="登陆" />
</div>

</form>


