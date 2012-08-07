
<h2><?php echo $kpidata->name?></h2>

<table class="normal-table" cellspacing="0" cellpadding="0">
	<tr class="top">
		<td>绩效考核项</td>
		<td width="100">评分部门</td>
		<td width="70">分数</td>
		<td width="150">操作</td>
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
	?>
	<tr <?php echo $tr_class?>>
		<td><?php echo $o->name?></td>
		<td><?php echo $o->department?></td>
		<td><?php echo $score?></td>
		<td class="operate">
			<?php if($item_id){?>
			<a href="<?php echo $home.'/itemdetail?itemid='.$item_id?>">查看具体</a>
			<?php }?>
			<a target="_blank" href="<?php echo $home.'/datasource?dsid='.$o->datasource?>">数据来源</a>
		</td>
	</tr>
	<?php 
			}
		}
	?>
</table>

<input type="button" value="返回" onclick="location.href='<?php echo $home."/kpidata?did=$kpidata->depart"?>'" />

