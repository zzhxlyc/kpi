<div id="right">
<div class="box special2">

<div class="header_main title">
<h2><?php echo $kpidata->name?></h2>
</div>

<div class="table">
<table>
	<tr>
		<th>绩效考核项</th>
		<th >评分部门</th>
		<th >类型</th>
		<th >比重</th>
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
				if(array_key_exists($o->id, $data_list)){
					$score = get_score($data_list[$o->id]->score);
					$item_id = $data_list[$o->id]->id;
				}
				else{
					$score = 0;
				}
	?>
	<tr <?php echo $tr_class?>>
		<td><?php echo $o->name?></td>
		<td><?php echo $o->department?></td>
		<td><?php echo KpiItemType::to_string($o->type)?></td>
		<td><?php echo get_weight($o)?></td>
		<td><?php echo $score?></td>
		<td class="operate">
			<?php if($item_id){?>
			<a href="<?php echo $home.'/itemdetail?itemid='.$item_id?>">查看具体</a>
			<?php }?>
			<a target="_blank" href="<?php echo DATA_HOME.'/index?datasource='.$o->datasource?>">数据来源</a>
		</td>
	</tr>
	<?php 
			}
		}
		if(is_array($list2)){
			foreach($list2 as $o){
				$i++;
				$tr_class = '';
				if($i % 2 == 0) $tr_class = 'class="even"';
				if(array_key_exists($o->id, $data_list)){
					$score = get_score($data_list[$o->id]->score);
					$item_id = $data_list[$o->id]->id;
				}
				else{
					$score = 100;
				}
	?>
	<tr <?php echo $tr_class?>>
		<td><?php echo $o->name?></td>
		<td>-</td>
		<td><?php echo KpiItemType::to_string($o->type)?></td>
		<td>-</td>
		<td><?php echo $score?>%</td>
		<td class="operate">
			<?php if($item_id){?>
			<a href="<?php echo $home.'/foujue?itemid='.$item_id?>">评分</a>
			<?php }?>
		</td>
	</tr>
	<?php 
			}
		}
	?>
</table>
</div>

<div class="actions whiteBg">
<div class="actions-left">
<input type="button" value="返回" onclick="location.href='<?php echo $home."/kpidata?did=$kpidata->depart"?>'" />
</div>
</div>

</div>
</div>
