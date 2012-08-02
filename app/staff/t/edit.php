<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>
<form action="" method="post" >
	
<div class="row">
	<label for="name">姓名</label>
	<input size="20" type="text" name="name" value="<?php echo $user->name?>" />
	<span class="error"><?php echo $errors['name']?></span>
</div>

<div class="row">
	<label for="slug">别名</label>
	<?php echo $user->slug?>
</div>

<div class="row">
	<label for="depart">所属部门</label>
	<?php echo $manager->department?>
</div>

<div class="row">
	<label for="depart">部门主管</label>
	<?php echo $manager->name?>（<?php echo $manager->slug?>）
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
