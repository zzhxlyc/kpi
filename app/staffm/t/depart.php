<div id="right">
<div class="box special">

<div class="header_main title">
</div>

<div class="table">
<table>
	<tr>
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
			<a href="<?php echo $home.'/show?depart='.$o->id?>">查看办事员</a>
			<a href="<?php echo $home.'/add?depart='.$o->id?>">添加办事员</a>
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

