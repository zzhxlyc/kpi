
<?php
if($error){
	output_error($error, $index_page);
}
else{
	?>
<div class="box _datasource">

<div class="header_main title">
<h2>历史数据: <?php echo $datasource->name?></h2>
</div>

<div class="data_wrapper">
<form action="" method="get">
<div class="data">
<div class="_oneline"><label>从</label> 
<input type="text" name="from" id="fromDataPicker" value="<?php echo $_GET['from']?>" />
	<label>到</label>  
	<input type="text" name="to" id="toDataPicker" value="<?php echo $_GET['to']?>" /> 
	<input type="hidden" name="datasource" value="<?php echo $_GET['datasource']?>" /> 
	<input type="hidden" name="page" value="<?php echo $_GET['page']?>" /><input type="submit" value="提交" /></div>
</div>
</form>



<div class="table datasource">
<table>
	<thead>
		<tr id="column_row">
		<?php
		if(is_array($list)){
			foreach($list as $o){
				$name = $o->COLUMN_NAME;
				$comment = $o->COLUMN_COMMENT;
				?>
			<th ><label><?php echo $comment?></label></th>
			<?php
			}
		}
		?>
			<th><label>时间</label></th>
			<?php if($User->type == UserType::ADMIN){?>
			<th ><label>操作</label></th>
			<?php }?>
		</tr>
	</thead>
	<?php
	if(is_array($data) && count($data) > 0){
		$i = 0;
		?>
	<tbody>
		<?php
		foreach($data as $o){
			$tr_class = '';
			$i++;
			if($i % 2 == 0) $tr_class = 'class="even"';
			?>
			<tr <?php echo $tr_class?>>
			<?php
			if(is_array($list)){
				foreach($list as $column){
					$name = $column->COLUMN_NAME;
					?>
				<td><label><?php echo $o->$name?></label></td>
				<?php
				}
			}
			?>
				<td><label><?php echo $o->time?></label></td>
				<?php if($User->type == UserType::ADMIN){?>
				<td><a
					href="<?php echo DATASOURCE_HOME."/editdata?datasource=$datasource->id&id=$o->id"?>">编辑</a>
				</td>
				<?php }?>
				</tr>
				<?php
		}
		?>
		
	
	</tbody>
	<?php
	}
	?>
</table>
</div>

<div class="page-nav"><?php Pager::output_pager_list($page_list);?></div>

</div>

</div>

<script type="text/javascript">
<!--
big_table_init();
//-->
</script>

	<?php
}
?>
