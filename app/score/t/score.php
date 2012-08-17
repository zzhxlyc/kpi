<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>

<div class="row">
	<label for="name">部门</label>
	<?php echo $depart->name?>
</div>

<div class="row">
	<label for="name">考核表名称</label>
	<?php echo $kpitable->name?>
</div>

<hr/>

<div class="row">
	<label for="name">考核项名称</label>
	<?php echo $tableitem->name?>
</div>

<div class="row">
	<label for="type">类型</label>
	<?php echo KpiItemType::to_string($tableitem->type)?>
</div>

<div class="row">
	<label for="weight">权重</label>
	<?php echo $tableitem->weight?>%
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

<div class="row">
	<label for="datasource">数据来源</label>
	<a target="_blank" href="<?php echo DATA_HOME.'/index?datasource='.$tableitem->datasource?>">查看数据来源</a>
</div>

<hr/>

<form action="" method="post">

<div class="row">
	<label for="score">评分</label>
	<?php 
		$score = $dataitem->score;
		if($score == -1) $score = '';
	?>
	<input type="text" name="score" value="<?php echo $score?>" />
</div>

<div class="row" style="margin: 20px 0">
	<input type="submit" value="提交" />
	<input type="button" value="返回" onclick="location.href='<?php echo $home."/index"?>'" />
	<input type="hidden" name="id" value="<?php echo $dataitem->id?>"/>
</div>

</form>

<?php 
		output_edit_success();
	}
?>
