
<div id="right">
<form action="" method="post">
<div class="box">
<div class="header_main title">
<h2>添加公司主管</h2>
</div>


<div class="data_wrapper">

<div class="data">
<div class="first-child"><label for="name">姓名</label></div>
<div class="child"><input type="text" name="name" class="fixed2"
	value="<?php echo $user->name?>" /> <span class="error"><?php echo $errors['name']?></span></div>
</div>

<div class="data">
<div class="first-child"><label for="slug">登录名</label></div>
<div class="child"><input type="text" name="slug" class="fixed2"
	value="<?php echo $user->slug?>" /> <br><label class="input_rule">只能使用用英文、数字下、划线，推荐姓名拼音或员工编号，此后不能修改</label>
<span class="error"><?php echo $errors['slug']?></span></div>
</div>


<div class="data">
<div class="first-child"><label for="password">密码</label></div>
<div class="child"><input type="password" name="password" class="fixed2" /> <span
	class="error"><?php echo $errors['password']?></span></div>
</div>

<div class="data">
<div class="first-child"><label for="depart">管理部门</label></div>
<div class="child"><?php 
foreach($depart_list as $o){
	if(is_array($user->depart)){
		$cond = in_array($o->id, $user->depart);
	}
	?>
<div class="subdata">
<div class="sub_first-child"><label> <?php echo $o->name?> </label></div>
<div class="sub_child"><input class="checkbox" type="checkbox" name="depart[]" value="<?php echo $o->id?>"
<?php $HTML->if_checked($cond)?> /></div>
</div>
<?php
}
?> <span class="error"><?php echo $errors['depart']?></span></div>
</div>

</div>
<div class="actions">
<div class="actions-left"><input type="submit" value="保存" /></div>
<div class="actions-right"><input type="button" value="返回"
	onclick="location.href='<?php echo $home?>/index'" /></div>
</div>

</div>
</form>
</div>


