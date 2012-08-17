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
<div class="row">
	<label for="datasource">部门</label>
	<?php echo $department?>
</div>

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
		foreach($list as $o){
?>
	<td><input style="width:80px" type="text"/></td>
<?php 
		}
	}
?>
	</tr>
</table>

<div class="row" style="margin: 20px 0">
	<input type="hidden" value="<?php echo count($list)?>" id="columns" />
	<input type="button" value="保存" onclick="sourcedata_save_row()" />
	<input type="button" value="返回" onclick="location.href='<?php echo $home."/index"?>'" />
	<input type="hidden" id="dsid" name="dsid" value="<?php echo $datasource->id?>" />
</div>

<script type="text/javascript">
<!--
big_table_init();
//-->
</script>


<?php 
	}
?>


