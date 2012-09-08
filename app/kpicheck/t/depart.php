<div id="right">
<div class="box special">
<div class="header_main title">
<h2>绩效考核汇总</h2>
</div>

<div class="table">
<table>
	<tr >
		<th>部门</th>
		<th >部门主管</th>
		<th >操作</th>
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
</div>
</div>
</div>

