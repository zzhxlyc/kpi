<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>
<div id="content">
		<div class="edit_panel">
			<div class="header_main title" >
			<h2><?php echo $kpitable->name?></h2>
			</div>
<div class="table">
<table cellspacing="0" cellpadding="0">
	<thead>
	<tr class="top">
		<th>考核表项</th>
		<th width="70">类型</th>
		<th width="70">比重</th>
		<th width="70">时间节点</th>
		<th width="100">操作</th>
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
		<td class="operate">
			<a href="<?php echo $home.'/edititem?id='.$o->id?>">编辑</a>
			<a href="<?php echo $home."/delitem?id=".$o->id?>">删除</a>
		</td>
	</tr>
	<?php 
			}
		}
	?>
</table>
</div>
<div class="data">
	<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
</div>
	<form action="<?php echo $home.'/additem?tableid='.$kpitable->id?>" method="post">
		<div class="data">
			<input type="submit" value="添加考核项" />
		</div>
	</form>




<div class="page-nav">
	<?php Pager::output_pager_list($page_list);?>
</div>

			</div>

</div>

<?php 
	}
?>