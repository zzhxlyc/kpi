<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>
<form action="<?php echo $home.'/edit?id='.$user->id?>" method="post" >
	
<div class="row">
	<label for="name">姓名</label>
	<input size="20" type="text" name="name" value="<?php echo $user->name?>" />
	<span class="error"><?php echo $errors['name']?></span>
</div>

<div class="row">
	<label for="slug">登录名</label>
	<?php echo $user->slug?>
</div>

<div class="row">
	<label for="depart">管理部门</label>
	<?php 
		foreach($depart_list as $o){
			if(is_array($user->depart)){
				$cond = in_array($o->id, $user->depart);
			}
	?>
	<?php echo $o->name?>
	<input type="checkbox" name="depart[]" value="<?php echo $o->id?>"
	<?php $HTML->if_checked($cond)?> />
	<?php 
		}
	?>
	<span class="error"><?php echo $errors['depart']?></span>
</div>	

<div class="row">
	<input type="submit" value="保存" />
	<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
	<input type="hidden" name="id" value="<?php echo $user->id?>" />
</div>

</form>
<?php 
		output_edit_success();
	}
?>
