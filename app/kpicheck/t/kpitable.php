<div id="right">
<div class="box special">
<div class="header_main title">
<h2>查看绩效考核表 | <?php echo $depart->name?></h2>
</div>
<div class="data_wrapper">
<div class="table">
<table>
	<tr>
		<th>绩效考核表</th>
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
		<td><?php echo $o->name?></td>
		<td><?php echo $depart->name?></td>
		<td class="operate"><a
			href="<?php echo $home.'/tableitem?tableid='.$o->id?>">查看考核项</a></td>
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
<div class="actions-right"><input type="button" value="返回"
	onclick="location.href='<?php echo $home."/depart"?>'" /></div>
</div>

</div>
</div>




