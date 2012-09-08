<div id="right">
<div class="box special">
<div class="header_main title">
<h2>数据源数据管理</h2>
</div>
<div class="data_wrapper">
<div class="table">
<table>
	<thead>
	<tr>
		<th>数据源表</th>
		<th>操作</th>
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
</div>
<div class="page-nav">
	<?php Pager::output_pager_list($page_list);?>
</div>
</div>
</div>
</div>


