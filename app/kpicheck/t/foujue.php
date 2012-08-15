<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>
<form action="" method="post" >

<div class="row">
	<label for="name">考核项名称</label>
	<?php echo $tableitem->name?>
</div>

<hr/>

<div class="row">
	<label for="type">类型</label>
	<?php echo KpiItemType::to_string(KpiItemType::FOUJUE)?>
</div>

<div class="row">
	<label for="desc">指标解释</label>
	<?php echo $tableitem->desc?>
</div>

<div class="row">
	<label for="timeline">时间节点</label>
	<?php echo $tableitem->timeline?>
</div>

<div class="row">
	<label for="quality">质量要求</label>
	<?php echo $tableitem->quality?>
</div>

<div class="row">
	<label for="output">结果型输出</label>
	<?php echo $tableitem->output?>
</div>

<div class="row">
	<label for="standard">评分标准</label>
	<?php echo $tableitem->standard?>
</div>

<hr/>

<div class="row">
	<label for="score">评分</label>
	<input size="4" type="text" name="score" value="<?php echo get_score($dataitem, 0)?>"/>%
</div>

<div class="row" style="margin: 20px 0">
	<input type="submit" value="保存" />
	<input type="button" value="返回" onclick="location.href='<?php echo $home.'/kpiitem?dataid='.$dataitem->kpi_data?>'" />
</div>

</form>

<?php 
		output_edit_success();
	}
?>