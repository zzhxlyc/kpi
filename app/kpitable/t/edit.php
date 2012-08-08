<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>
<form action="" method="post" >
	
<div class="row">
	<label for="name">考核表名称</label>
	<input size="20" type="text" name="name" value="<?php echo $kpitable->name?>" />
	<span class="error"><?php echo $errors['name']?></span>
</div>

<div class="row">
	<label for="depart">所属部门</label>
	<?php echo $manager->department?>
	<input type="hidden" name="depart" value="<?php echo $manager->depart?>" />
</div>

<div class="row">
	<input type="submit" value="保存" />
	<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
	<input type="hidden" name="id" value="<?php echo $kpitable->id?>" />
</div>

</form>
<?php 
		output_edit_success();
	}
?>
