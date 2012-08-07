
<table class="normal-table" cellspacing="0" cellpadding="0">
	<tr class="top">
		<td width="100">部门</td>
		<td>KPI考核名称</td>
		<td width="150">考核项名</td>
		<td width="100">时间</td>
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
	?>
	<tr <?php echo $tr_class?>>
		<td><?php echo $departs[$o->depart]->name?></td>
		<td><?php echo $o->dataname?></td>
		<td><?php echo $o->itemname?></td>
		<td><?php echo get_date($o->time)?></td>
		<td><?php echo get_score($o->score)?></td>
		<td class="operate">
			<a href="<?php echo $home.'/score?id='.$o->id?>">评分</a>
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

