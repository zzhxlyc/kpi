
<table class="normal-table" cellspacing="0" cellpadding="0">
	<tr class="top">
		<td>部门</td>
		<td width="150">部门主管</td>
		<td width="200">操作</td>
	</tr>
	<?php 
		$i = 0;
		if(is_array($list)){
			foreach($list as $o){
				$i++;
				$tr_class = '';
				if($i % 2 == 0) $tr_class = 'class="even"';
				if(array_key_exists($o->id, $manager_list)){
					$manager = $manager_list[$o->id]->name;
				}
				else{
					$manager = '暂无部门主管';
				}
	?>
	<tr <?php echo $tr_class?>>
		<td><?php echo $o->name?></td>
		<td><?php echo $manager?></td>
		<td class="operate">
			<a href="<?php echo $home.'/kpitable?did='.$o->id?>">绩效考核表</a>
			<a href="<?php echo $home.'/kpidata?did='.$o->id?>">绩效考核汇总</a>
		</td>
	</tr>
	<?php 
			}
		}
	?>
</table>

