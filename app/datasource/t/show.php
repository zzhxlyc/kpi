<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>

<h2><?php echo $datasource->name?>历史数据</h2>

<table id="data_table" class="normal-table" cellspacing="0" cellpadding="0">
	<tr id="column_row" class="top">
<?php 
	if(is_array($list)){
		foreach($list as $o){
			$name = $o->COLUMN_NAME;
			$comment = $o->COLUMN_COMMENT;
?>
	<td width="100"><?php echo $comment?></td>
<?php 
		}
	}
?>
	<td width="150">时间</td>
	<td width="100">操作</td>
	</tr>
<?php 
	if(is_array($data) && count($data) > 0){
		$i = 0;
?>
	<tr>
<?php 
		foreach($data as $o){
			$tr_class = '';
			$i++;
			if($i % 2 == 0) $tr_class = 'class="even"';
?>
	<tr <?php echo $tr_class?>>
<?php 
	if(is_array($list)){
		foreach($list as $column){
			$name = $column->COLUMN_NAME;
?>
	<td width="100"><?php echo $o->$name?></td>
<?php 
		}
	}
?>
	<td><?php echo $o->time?></td>
	<td><a href="<?php echo $home."/editdata?datasource=$datasource->id&id=$o->id"?>">编辑</a></td>
<?php 
		}
?>
	</tr>
<?php 
	}
?>
	</tr>
</table>

<div class="page-nav">
	<?php Pager::output_pager_list($page_list);?>
</div>

<div class="row" style="margin: 20px 0">
	<input type="button" value="返回" onclick="location.href='<?php echo $home."/index"?>'" />
</div>

<script type="text/javascript">
<!--
big_table_init();
//-->
</script>

<?php 
	}
?>
