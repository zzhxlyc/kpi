<div id="right">
<div class="box noBlank">
<div class="header_main title">
</div>
<div class="table">
<table>
	<tr>
		<th>姓名</th>
		<th width="250">操作</th>
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

<div class="actions whiteBg">
<div class="actions-left">
<form action="<?php echo $home.'/add'?>" method="post"><input
	type="submit" value="添加办事员" /></form>
</div>
</div>

</div>
</div>

<div class="page-nav">
	<?php Pager::output_pager_list($page_list);?>
</div>

