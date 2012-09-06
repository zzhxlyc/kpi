
<?php
if($error){
	output_error($error, $index_page);
}
else{
	?>
<div class="box _datasource">
<form action="" method="get">
<div class="header_main title">
<h2>历史数据: <?php echo $datasource->name?></h2>
</div>

<div class="data_wrapper">

<div class="data">
<div class="_oneline"><label>从</label> <input type="text" name="from"
	id="fromDataPicker" /><label style="padding:0 10px;">到</label><input type="text" name="to" id="toDataPicker"
	value="<?php echo $_GET['to']?>" /> <input type="hidden"
	name="datasource" value="<?php echo $_GET['datasource']?>" /> <input
	type="hidden" name="page" value="<?php echo $_GET['page']?>" /><input type="submit" value="提交" /></div>
</div>


<div class="table datasource">
<table cellspacing="0" cellpadding="0">
	<thead>
		<tr id="column_row">
		<?php
		if(is_array($list)){
			foreach($list as $o){
				$name = $o->COLUMN_NAME;
				$comment = $o->COLUMN_COMMENT;
				?>
			<th ><?php echo $comment?></th>
			<?php
			}
		}
		?>
			<th>时间</th>
			<?php if($User->type == UserType::ADMIN){?>
			<th >操作</th>
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
				<td width="100"><?php echo $o->$name?></td>
				<?php
				}
			}
			?>
				<td><?php echo $o->time?></td>
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



</form>
</div>


<script type="text/javascript">
<!--
big_table_init();
//-->
</script>



	<?php
}
?>
