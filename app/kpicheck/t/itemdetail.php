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
	<label for="modified">审核</label>
	<?php if($tableitem->modified == 1){echo '可修改';}else{echo '不可修改';}?>
</div>

<div class="row">
	<label for="standard">数据源表</label>
	<?php echo $datasource->name?>
</div>

<div class="row">
	<label for="standard">办事员</label>
	<?php echo $staff->name?>（<?php echo $staff->slug?>）
</div>

<hr/>

<div class="row">
	<label for="score">评分</label>
	<?php echo $dataitem->score?>
</div>

<div class="row" style="margin: 20px 0">
	<input type="button" value="返回" onclick="history.back()" />
</div>

</form>

<?php 
	}
?>
