<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>
<h2><?php echo $kpitable->name?></h2>
<table class="normal-table" cellspacing="0" cellpadding="0">
	<tr class="top">
		<td>考核表项</td>
		<td width="70">类型</td>
		<td width="70">比重</td>
		<td width="70">时间节点</td>
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
		<td><a href="<?php echo $home.'/showitem?id='.$o->id?>"><?php echo $o->name?></a></td>
		<td><?php echo KpiItemType::to_string($o->type)?></td>
		<td><?php echo $o->weight?>%</td>
		<td><?php echo $o->timeline?></td>
		<td class="operate">
			<a href="<?php echo $home.'/edititem?id='.$o->id?>">编辑</a>
			<a href="<?php echo $home."/delitem?id=".$o->id?>">删除</a>
		</td>
	</tr>
	<?php 
			}
		}
	?>
</table>

<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
<a href="<?php echo $home.'/additem?tableid='.$kpitable->id?>">添加考核项</a>

<div class="page-nav">
	<?php Pager::output_pager_list($page_list);?>
</div>

<?php 
	}
?>