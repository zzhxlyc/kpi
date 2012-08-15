<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>

<div class="row">
	<label for="datasource">数据源表</label>
	<?php echo $datasource->name?>
</div>

<form action="" method="post">
<table id="data_table" class="normal-table" cellspacing="0" cellpadding="0">
	<tr id="column_row" class="top">
<?php 
	if(is_array($list)){
		foreach($list as $o){
			$name = $o->COLUMN_NAME;
			$comment = $o->COLUMN_COMMENT;
?>
	<td width="100"><label for="<?php echo $name?>"><?php echo $comment?></label></td>
<?php 
		}
	}
?>
	</tr>
	<tr>
<?php 
	if(is_array($list)){
		foreach($list as $column){
			$name = $column->COLUMN_NAME;
?>
	<td width="100"><input type="text" name="<?php echo $name?>" value="<?php echo $data->$name?>"/></td>
<?php 
		}
	}
?>
	</tr>
</table>

<div class="row" style="margin: 20px 0">
	<input type="submit" value="保存" />
	<input type="button" value="返回" onclick="location.href='<?php echo $home."/show?datasource=$datasource->id"?>'" />
	<input type="hidden" name="datasource" value="<?php echo $datasource->id?>" />
	<input type="hidden" name="id" value="<?php echo $data->id?>" />
</div>
</form>
<?php 
		output_edit_success();
	}
?>


