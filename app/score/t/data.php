<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>

<div id="right">
<form action="" method="post">
<div class="box">
<div class="header_main title">
</div>


<div class="data">
	<div class="first-child"><label for="quality">时间段选择</label></div>
	<div class="child">从 <input type="text" name="from" value="<?php echo $_GET['from']?>" /> 
	到 <input type="text" name="to" value="<?php echo $_GET['to']?>" />
	<input type="hidden" name="itemid" value="<?php echo $tableitem->id?>" />
	<input type="submit" value="提交" /></div>
</div>



<div class="table">
<table>
	<thead>
	<tr>
		<th>数据源表</th>
		<th width="150">添加时间</th>
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
		<td><?php echo $datasource->name?></td>
		<td><?php echo $o->time?></td>
		<td class="operate">
			<a href="<?php echo $home."/detail?dsid=$o->id"?>">查看</a>
		</td>
	</tr>
	<?php 
			}
		}
	?>
</table>
</div>

</div>
</form>
</div>

<div class="page-nav">
	<?php Pager::output_pager_list($page_list);?>
</div>

<?php 
	}
?>
