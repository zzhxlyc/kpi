
<table class="normal-table" cellspacing="0" cellpadding="0">
	<tr class="top">
		<td>姓名</td>
		<td width="250">操作</td>
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
			<a href="<?php echo $home.'/remove?id='.$o->id?>">删除</a>
		</td>
	</tr>
	<?php 
			}
		}
	?>
</table>

<a href="<?php echo $home.'/add'?>">添加办事员</a>

<div class="page-nav">
	<?php Pager::output_pager_list($page_list);?>
</div>

