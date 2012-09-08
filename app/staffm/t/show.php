<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>
<div id="right">
<div class="box special">
<div class="header_main title">
<h2>查看办事员 | <?php echo $depart->name?></h2>
</div>

<div class="data_wrapper">
<div class="table">
<table>
	<tr>
		<th>姓名</th>
		<th >部门</th>
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
		<td><a href="<?php echo $home.'/edit?id='.$o->id?>"><?php echo $o->name?></a></td>
		<td><?php echo $depart->name?></td>
		<td class="operate">
			<a href="<?php echo $home.'/edit?id='.$o->id?>">编辑</a>
			<a href="<?php echo $home.'/pswd?id='.$o->id?>">修改密码</a>
			<a class="remove_operation" href="<?php echo $home.'/remove?id='.$o->id?>">删除</a>
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


<div class="actions whiteBg">
<div class="actions-left">
<input type="button" value="添加办事员"
	onclick="location.href='<?php echo $home.'/add?depart='.$depart->id?>'" />	
</div>
<div class="actions-right"><input type="button" value="返回"
	onclick="location.href='<?php echo $home."/depart"?>'" /></div>
</div>

</div>
</div>

<?php 
	}
?>