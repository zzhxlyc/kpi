<?php
if($error){
	output_error($error, $index_page);
}
else{
	?>
<div id="right">
<div class="box special">
<div class="header_main title"></div>

<div class="data_wrapper">
<div class="data">
<div class="first-child"><label for="datasource">数据源表</label></div>
<div class="child">
<div class="readonly"><?php echo $datasource->name?></div>
</div>
</div>
<div class="data">
<div class="first-child"><label for="datasource">部门</label></div>
<div class="child">
<div class="readonly"><?php echo $department?></div>
</div>
</div>


<div class="table datasource">
<table id="data_table">
	<thead>
		<tr id="column_row">
		<?php
		if(is_array($list)){
			foreach($list as $o){
				$name = $o->COLUMN_NAME;
				$comment = $o->COLUMN_COMMENT;
				?>
			<th><label for="<?php echo $name?>"><?php echo $comment?></label></th>
			<?php
			}
		}
		?>
		</tr>
	</thead>
	<tbody>
		<tr>
		<?php
		if(is_array($list)){
			foreach($list as $o){
				?>
			<td><input class="unSaved" type="text" /></td>
			<?php
			}
		}
		?>
		</tr>
	</tbody>
</table>
</div>
</div>

<div class="actions"><input type="hidden"
	value="<?php echo count($list)?>" id="columns" />
<div class="actions-left"><input type="button" value="保存"
	onclick="sourcedata_save_row()" /></div>
<div class="actions-right"><input type="button" value="返回"
	onclick="location.href='<?php echo $home?>/index'" /></div>
<input type="hidden" id="dsid" name="dsid"
	value="<?php echo $datasource->id?>" /></div>

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


