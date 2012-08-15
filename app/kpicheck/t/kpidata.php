
<table class="normal-table" cellspacing="0" cellpadding="0">
	<tr class="top">
		<td>绩效考核表</td>
		<td width="100">部门</td>
		<td width="50">分数</td>
		<td width="150">操作</td>
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
		<td><?php echo $o->name?></td>
		<td><?php echo $depart->name?></td>
		<td><?php echo $o->score?></td>
		<td class="operate">
			<a href="<?php echo $home.'/kpiitem?dataid='.$o->id?>">查看绩效考核项</a>
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

<input type="button" value="返回" onclick="location.href='<?php echo $home."/depart"?>'" />

