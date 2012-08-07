
<form action="<?php echo $home.'/delete'?>" method="post">
<table class="normal-table" cellspacing="0" cellpadding="0">
	<tr class="top">
		<td>KPI考核名称</td>
		<td width="150">考核表名</td>
		<td width="70">类型</td>
		<td width="50">总分</td>
		<td width="170">操作</td>
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
		<td><?php echo $o->table?></td>
		<td><?php echo KpiDataType::to_string($o->type)?></td>
		<td><?php echo $o->score?></td>
		<td class="operate">
			<a href="<?php echo $home.'/show?id='.$o->id?>">查看考核项</a>
			<a href="<?php echo $home.'/edit?id='.$o->id?>">编辑</a>
			<?php 
				if($o->status == KpiDataStatus::OPEN){
			?>
			<a href="<?php echo $home.'/delete?id='.$o->id?>">删除</a>
			<?php }?>
		</td>
	</tr>
	<?php 
			}
		}
	?>
</table>

<a href="<?php echo $home.'/add'?>">添加一场KPI考核</a>
</form>

<div class="page-nav">
	<?php Pager::output_pager_list($page_list);?>
</div>

