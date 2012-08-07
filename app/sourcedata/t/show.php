<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>

<h2><?php echo $datasource->name?>历史数据</h2>

<table class="normal-table" cellspacing="0" cellpadding="0">
	<tr class="top">
		<td>数据源表</td>
		<td width="140">添加时间</td>
		<td width="100">操作</td>
	</tr>
	<?php 
		$i = 0;
		if(is_array($list)){
			foreach($list as $o){
				$i++;
				$tr_class = '';
				if($i % 2 == 0) $tr_class = 'class="even"';
	?>
	<tr <?php echo $tr_class?>>
		<td><?php echo $datasource->name?></td>
		<td><?php echo $o->time?></td>
		<td class="operate">
			<a href="<?php echo $home."/edit?dsid=$datasource->id&id=$o->id"?>">编辑</a>
		</td>
	</tr>
	<?php 
			}
		}
	?>
</table>

<div class="page-nav">
	<?php Pager::output_pager_list($page_list);?>
</div>

<div class="row" style="margin: 20px 0">
	<input type="button" value="返回" onclick="location.href='<?php echo $home."/index"?>'" />
</div>

<?php 
	}
?>
