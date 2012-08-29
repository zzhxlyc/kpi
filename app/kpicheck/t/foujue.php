<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>
<div id="right">
<div class="box">

<div class="header_main title">
</div>

<form action="" method="post">
<div class="data_wrapper">

<div class="data">
	<div><label for="name">考核项名称</label></div>
	<div class="readonly"><?php echo $tableitem->name?></div>
</div>

<hr/>

<div class="data">
	<div><label for="type">类型</label></div>
	<div class="readonly"><?php echo KpiItemType::to_string(KpiItemType::FOUJUE)?></div>
</div>

<div class="data">
	<div><label for="desc">指标解释</label></div>
	<div class="readonly"><?php echo $tableitem->desc?></div>
</div>

<div class="data">
	<div><label for="timeline">时间节点</label></div>
	<div class="readonly"><?php echo $tableitem->timeline?></div>
</div>

<div class="data">
	<div><label for="quality">质量要求</label></div>
	<div class="readonly"><?php echo $tableitem->quality?></div>
</div>

<div class="data">
	<div><label for="output">结果型输出</label></div>
	<div class="readonly"><?php echo $tableitem->output?></div>
</div>

<div class="data">
	<div><label for="standard">评分标准</label></div>
	<div class="readonly"><?php echo $tableitem->standard?></div>
</div>

<hr/>

<div class="data">
	<div><label for="score">评分</label></div>
	<div><input size="4" type="text" name="score" value="<?php echo get_score($dataitem, 0)?>"/>%</div>
</div>
</div>

<div class="actions">
<div class="actions-left"><input type="submit" value="保存" /></div>
<div class="actions-right">
<input type="button" value="返回" onclick="location.href='<?php echo $home.'/kpiitem?dataid='.$dataitem->kpi_data?>'" />
</div>
</div>

</form>
</div>
</div>

<?php 
		output_edit_success();
	}
?>
