<?php
if($error){
	output_error($error, $index_page);
}
else{
	?>
<div id="right" class="hasBlank">
<div class="box special">
<div class="header_main title">
<h2><?php echo $kpitable->name?></h2>
</div>
<div class="data_wrapper">

<div class="table">
<table cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<th>考核表项</th>
			<th >类型</th>
			<th >比重</th>
			<th >时间节点</th>
			<th >操作</th>
		</tr>
	</thead>
	<?php
	$i = 0;
	if(is_array($list)){
		foreach($list as $o){
			$i++;
			$tr_class = '';
			if($i % 2 == 0) $tr_class = 'class="even"';
			?>
	<tr <?php echo $tr_class?>>
		<td><a href="<?php echo $home.'/showitem?id='.$o->id?>"><?php echo $o->name?></a></td>
		<td><?php echo KpiItemType::to_string($o->type)?></td>
		<td><?php echo get_weight($o)?></td>
		<td><?php echo $o->timeline?></td>
		<td class="operate"><a
			href="<?php echo $home.'/edititem?id='.$o->id?>">编辑</a> <a
			class="remove_operation"
			href="<?php echo $home."/delitem?id=".$o->id?>">删除</a></td>
	</tr>
	<?php
		}
	}
	?>
</table>
</div>

<div class="page-nav"><?php Pager::output_pager_list($page_list);?></div>
</div>

<div class="actions whiteBg">
<div class="actions-left">
<input type="button" value="添加考核项"
	onclick="location.href='<?php echo $home.'/additem?tableid='.$kpitable->id?>'" />	
</div>
<div class="actions-right"><input type="button" value="返回"
	onclick="location.href='<?php echo $home?>/index'" /></div>
<input type="hidden" name="id" value="<?php echo $user->id?>" /></div>


</div>
</div>

	<?php
}
?>