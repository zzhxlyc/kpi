<div id="right">
<div class="box noBlank">
<div class="header_main title">
</div>
<div class="table">
<table >
	<tr >
		<th width="100">部门</th>
		<th>KPI考核名称</th>
		<th width="150">考核项名</th>
		<th width="100">时间</th>
		<th width="70">分数</th>
		<th width="100">操作</th>
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
</div>
</div>
</div>
<div class="page-nav">
	<?php Pager::output_pager_list($page_list);?>
</div>

