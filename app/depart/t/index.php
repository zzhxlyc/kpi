
<div id="right">
<div class="box hasBlank" >
<form action="<?php echo $home.'/remove'?>" method="post">
<div class="header_main title"></div>

<div class="table">
<table>
	<thead>
		<tr>
			<th class="column1">选择</th>
			<th class="column2">部门</th>
			<th class="column3">操作</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$i = 0;
	if(is_array($list)){
		foreach($list as $o){
			$i++;
			$tr_class = '';
			if($i % 2 == 0) $tr_class = 'class="even"';
			?>
		<tr <?php echo $tr_class?>>
			<td class="center"><input name="id[]" type="checkbox"
				value="<?php echo $o->id?>" /></td>
			<td class="center"><a href="<?php echo $home.'/edit?id='.$o->id?>"><?php echo $o->name?></a></td>
			<td class="operate"><a href="<?php echo $home.'/edit?id='.$o->id?>">编辑</a>
			<a class="remove_operation" href="<?php echo $home.'/remove?id='.$o->id?>">删除</a></td>
		</tr>
		<?php
		}
	}
	?>
	</tbody>
</table>
<!-- end table --></div>

<div class="actions whiteBg">
<div class="actions-left"><input class="remove_operation batch_remove" type="submit" value="批量删除" /></div>
<div class="actions-right">
<input type="button" value="添加部门"
	onclick="location.href='<?php echo $home.'/add'?>'" />	
	
</div>
</div>
</form>
</div>
</div>

<div class="page-nav"><?php Pager::output_pager_list($page_list);?></div>





