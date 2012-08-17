<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>

<h2><?php echo $datasource->name?>历史数据</h2>

<form action="" method="get">
<div class="row">
	从 <input type="text" name="from" value="<?php echo $_GET['from']?>" /> 
	到 <input type="text" name="to" value="<?php echo $_GET['to']?>" />
	<input type="hidden" name="datasource" value="<?php echo $_GET['datasource']?>" />
	<input type="hidden" name="page" value="<?php echo $_GET['page']?>" />
	<input type="submit" value="提交" />
</div>
</form>

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
	<?php if($User->type == UserType::ADMIN){?>
	<td width="100">操作</td>
	<?php }?>
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
	<?php if($User->type == UserType::ADMIN){?>
	<td>
		<a href="<?php echo DATASOURCE_HOME."/editdata?datasource=$datasource->id&id=$o->id"?>">编辑</a>
	</td>
	<?php }?>
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

<script type="text/javascript">
<!--
big_table_init();
//-->
</script>

<?php 
	}
?>
