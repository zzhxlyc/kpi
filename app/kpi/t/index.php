<div id="right">
<form action="<?php echo $home.'/remove'?>" method="post">
<div class="box ">

<div class="header_main title">
<h5></h5>
</div>
<div class="table">
<table>
	<tr>
		<th>KPI考核名称</th>
		<th >考核表名</th>
		<th >类型</th>
		<th >总分</th>
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
		<td><a href="<?php echo $home.'/show?id='.$o->id?>"><?php echo $o->name?></a></td>
		<td><?php echo $o->table?></td>
		<td><?php echo KpiDataType::to_string($o->type)?></td>
		<td><?php echo $o->score?></td>
		<td class="operate"><a href="<?php echo $home.'/show?id='.$o->id?>">查看考核项</a>
		<a href="<?php echo $home.'/edit?id='.$o->id?>">编辑</a> <?php 
		if($o->status == KpiDataStatus::OPEN){
			?> <a class="remove_operation" href="<?php echo $home.'/delete?id='.$o->id?>">删除</a> <?php }?>
		</td>
	</tr>
	<?php
		}
	}
	?>
</table>
</div>

<div class="actions whiteBg">

<div class="actions-right">
<input type="button" value="添加一场KPI考核"
	onclick="location.href='<?php echo $home.'/add'?>'" />	
</div>
</div>

</div>
</form>
</div>
<div class="page-nav"><?php Pager::output_pager_list($page_list);?></div>

