<div id="right">
<div class="box special">
<div class="header_main title">
<h2>KPI考核打分</h2>
</div>
<div class="data_wrapper">
<div class="table">
<table >
	<tr >
		<th >部门</th>
		<th>KPI考核名称</th>
		<th >考核项名</th>
		<th >时间</th>
		<th >分数</th>
		<th >操作</th>
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
<div class="page-nav">
	<?php Pager::output_pager_list($page_list);?>
</div>
</div>
</div>
</div>

