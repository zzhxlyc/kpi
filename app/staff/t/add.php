
<div id="right">
<div class="box _edit">
<div class="header_main title">
<h2>添加办事员</h2>
</div>
<form action="" method="post" >
<div class="data_wrapper">
	
<div class="data">
	<div><label for="name">姓名</label></div>
	<div><input size="20" type="text" name="name" value="<?php echo $user->name?>" />
	<span class="error"><?php echo $errors['name']?></span></div>
</div>

<div class="data">
	<div><label for="slug">登陆名</label></div>
	<div><input size="20" type="text" name="slug" value="<?php echo $user->slug?>" />
	<span class="error"><?php echo $errors['slug']?></span>
	<span>只能使用用英文数字下划线，推荐姓名拼音或员工编号，此后不能修改</span></div>
</div>

<div class="data">
	<div><label for="password">密码</label></div>
	<div><input size="20" type="password" name="password" />
	<span class="error"><?php echo $errors['password']?></span></div>
</div>

<div class="data">
	<div><label for="depart">所属部门</label></div>
	<div class="readonly"><?php echo $manager->department?></div>
</div>

<div class="data">
	<div><label for="depart">部门主管</label></div>
	<div class="readonly"><?php echo $manager->name?>（<?php echo $manager->slug?>）</div>
</div>
</div>

<div class="actions">
<div class="actions-left"><input type="submit" value="保存" /></div>
<div class="actions-right"><input type="button" value="返回"
	onclick="location.href='<?php echo $home?>/index'" /></div>
	</div>
</form>
</div>
</div>


