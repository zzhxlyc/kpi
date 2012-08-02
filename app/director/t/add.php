
<h2>添加部门主管</h2>

<form action="" method="post" >
	
<div class="row">
	<label for="name">姓名</label>
	<input size="20" type="text" name="name" value="<?php echo $user->name?>" />
	<span class="error"><?php echo $errors['name']?></span>
</div>

<div class="row">
	<label for="slug">登录名</label>
	<input size="20" type="text" name="slug" value="<?php echo $user->slug?>" />
	<span class="error"><?php echo $errors['slug']?></span>
	只能使用用英文数字下划线，推荐姓名拼音或员工编号，此后不能修改
</div>

<div class="row">
	<label for="password">密码</label>
	<input size="20" type="password" name="password" />
	<span class="error"><?php echo $errors['password']?></span>
</div>

<div class="row">
	<label for="depart">管理部门</label>
	<select name="depart">
		<option value="" ></option>
	<?php 
		foreach($depart_list as $o){
			if(is_array($user->depart)){
				$cond = in_array($o->id, $user->depart);
			}
	?>
	<?php echo $o->name?>
	<option value="<?php echo $o->id?>" 
		<?php $HTML->selected($o->id, $user->depart)?> ><?php echo $o->name?></option>
	<?php 
		}
	?>
	</select>
	<span class="error"><?php echo $errors['depart']?></span>
</div>

<div class="row">
	<input type="submit" value="保存" />
	<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
</div>

</form>


