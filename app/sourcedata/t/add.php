<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>
<form action="" method="post" >

<div class="row">
	<label for="datasource">数据源表</label>
	<?php echo $datasource->name?>
</div>
<div class="row">
	<label for="datasource">部门</label>
	<?php echo $department?>
</div>
<?php 
	if(is_array($list)){
		foreach($list as $o){
			$name = $o->COLUMN_NAME;
			$comment = $o->COLUMN_COMMENT;
			if($name != 'id'){
?>
<div class="row">
	<label for="<?php echo $name?>"><?php echo $comment?></label>
	<input size="80" type="text" name="<?php echo $name?>" value="<?php echo $data[$name]?>" />
	<span class="error"><?php echo $errors[$name]?></span>
</div>
<?php 
			}
		}
	}
?>

<div class="row" style="margin: 20px 0">
	<input type="submit" value="保存" />
	<input type="button" value="返回" onclick="location.href='<?php echo $home."/index"?>'" />
	<input type="hidden" name="itemid" value="<?php echo $table_item->id?>" />
</div>

</form>
<?php 
	}
?>


