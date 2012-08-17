<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>
<h2><?php echo $kpidata->name?></h2>
<form action="" method="post">
<table class="normal-table" cellspacing="0" cellpadding="0">
	<tr class="top">
		<td>考核表项</td>
		<td width="70">类型</td>
		<td width="70">时间节点</td>
		<td width="70">比重</td>
		<td width="70">分数</td>
		<td width="100">操作</td>
	</tr>
	<?php 
		$i = 0;
		if(is_array($list)){
			foreach($list as $o){
				$i++;
				$tr_class = '';
				if($i % 2 == 0) $tr_class = 'class="even"';
				if($o->type != KpiItemType::FOUJUE){
					$score = get_score($data_item_list[$o->id]->score);
				}
				else{
					$score = $data_item_list[$o->id]->score.'%';
				}
	?>
	<tr <?php echo $tr_class?>>
		<td><a href="<?php echo KPITABLE_HOME.'/showitem?id='.$o->id?>"><?php echo $o->name?></a></td>
		<td><?php echo KpiItemType::to_string($o->type)?></td>
		<td><?php echo $o->timeline?></td>
		<td><?php echo get_weight($o)?></td>
		<td><?php echo $score?></td>
		<td class="operate">
			<a href="<?php echo $home."/score?dataid=$kpidata->id&itemid=$o->id"?>">查看具体</a>
		</td>
	</tr>
	<?php 
			}
		}
	?>
</table>

<input type="button" value="返回" onclick="location.href='<?php echo $home."/index"?>'" />
</form>

<div class="page-nav">
	<?php Pager::output_pager_list($page_list);?>
</div>

<?php 
	}
?>