
<table class="normal-table" cellspacing="0" cellpadding="0">
	<tr class="top">
		<td>数据源表</td>
		<td width="180">操作</td>
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
		<td class="operate">
			<a href="<?php echo $home."/add?dsid=$o->id"?>">填写新数据</a>
			<!-- <a href="<?php echo $home."/show?dsid=$o->id"?>">历史数据</a> -->
			<a target="_blank" href="<?php echo DATA_HOME."/index?datasource=$o->id"?>">历史数据</a>
		</td>
	</tr>
	<?php 
			}
		}
	?>
</table>

<div class="page-nav">
	<?php Pager::output_pager_list($page_list);?>
</div>

