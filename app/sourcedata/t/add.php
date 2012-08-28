<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>
<div id="right">
<div class="box _edit">
<div class="header_main title">
</div>

<div class="data">
	<div><label for="datasource">数据源表</label></div>
	<div class="readonly"><?php echo $datasource->name?></div>
</div>
<div class="data">
	<div><label for="datasource">部门</label></div>
	<div class="readonly"><?php echo $department?></div>
</div>

<div class="table">
<table>
	<tr>
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
		foreach($list as $o){
?>
	<td><input style="width:80px" type="text"/></td>
<?php 
		}
	}
?>
	</tr>
</table>
</div>


<div class="actions">
<input type="hidden" value="<?php echo count($list)?>" id="columns" />
<div class="actions-left"><input type="submit" value="保存" /></div>
<div class="actions-right"><input type="button" value="返回"
	onclick="location.href='<?php echo $home?>/index'" /></div>
<input type="hidden" id="dsid" name="dsid" value="<?php echo $datasource->id?>" /></div>

</div>
</div>

<script type="text/javascript">
<!--
big_table_init();
//-->
</script>


<?php 
	}
?>


