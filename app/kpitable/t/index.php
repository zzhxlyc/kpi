
<table class="normal-table" cellspacing="0" cellpadding="0">
	<tr class="top">
		<td>考核表名称</td>
		<td width="100">部门</td>
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
		<td><a href="<?php echo $home.'/show?id='.$o->id?>"><?php echo $o->name?></a></td>
		<td><?php echo $o->department?></td>
		<td class="operate">
			<a href="<?php echo $home.'/show?id='.$o->id?>">查看考核项</a>
			<a href="<?php echo $home.'/edit?id='.$o->id?>">编辑</a>
			<a href="<?php echo $home.'/remove?id='.$o->id?>">删除</a>
		</td>
	</tr>
	<?php 
			}
		}
	?>
</table>

<a href="<?php echo $home.'/add'?>">添加KPI考核表</a>

<div class="page-nav">
	<?php Pager::output_pager_list($page_list);?>
</div>

