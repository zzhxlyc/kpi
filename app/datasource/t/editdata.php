<?php
if($error){
	output_error($error, $index_page);
}
else{
	?>
<div id="right">
<form action="" method="post">
<div class="box">
<div class="header_main title">
<h2>修改数据源表: <?php echo $datasource->name?></h2>
</div>

<div class="data_wrapper">

<div class="table">
<table id="data_table">
	<tr id="column_row">
	<?php
	if(is_array($list)){
		foreach($list as $o){
			$name = $o->COLUMN_NAME;
			$comment = $o->COLUMN_COMMENT;
			?>
		<th width="100"><label for="<?php echo $name?>"><?php echo $comment?></label></th>
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
		<td width="100"><input type="text" name="<?php echo $name?>"
			value="<?php echo $data->$name?>" /></td>
			<?php
		}
	}
	?>
	</tr>
</table>
</div>


</div>

<div class="actions">

<div class="actions-left"><input type="submit" value="保存" /></div>
<div class="actions-right"><input type="button" value="返回"
	onclick="location.href='<?php echo DATA_HOME."/index?datasource=$datasource->id"?>'" /></div>
<input type="hidden" name="datasource"
	value="<?php echo $datasource->id?>" /> <input type="hidden" name="id"
	value="<?php echo $data->id?>" /></div>
	
<?php
output_edit_success();
}
?>

</div>
</form>
</div>


