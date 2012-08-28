<?php
if($error){
	output_error($error, $index_page);
}
else{
	?>
<div id="right">
<div class="box _edit">
<div class="header_main title">
<h2><?php echo $kpidata->name?></h2>
</div>
<form action="" method="post">
<div class="data_wrapper">

<div class="table">
<table>
	<thead>
	<tr>
		<th>考核表项</th>
		<th width="70">类型</th>
		<th width="70">时间节点</th>
		<th width="70">比重</th>
		<th width="70">分数</th>
		<th width="100">操作</th>
	</tr>
	</thead>
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
	<tbody><tr <?php echo $tr_class?>>
		<td><a href="<?php echo KPITABLE_HOME.'/showitem?id='.$o->id?>"><?php echo $o->name?></a></td>
		<td><?php echo KpiItemType::to_string($o->type)?></td>
		<td><?php echo $o->timeline?></td>
		<td><?php echo get_weight($o)?></td>
		<td><?php echo $score?></td>
		<td class="operate"><a
			href="<?php echo $home."/score?dataid=$kpidata->id&itemid=$o->id"?>">查看具体</a>
		</td>
	</tr></tbody>
	<?php
		}
	}
	?>
</table>

</div>

<div class="page-nav"><?php Pager::output_pager_list($page_list);?>
</div>
<div class="actions whiteBg">
<div class="actions-left"><input type="button" value="返回"
	onclick="location.href='<?php echo $home?>/index'" /></div>
</div>
</div>
</form>
</div>
</div>


	<?php
}
?>