<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>
<div id="right">
<div class="box special">

<div class="header_main title">
</div>

<div class="data_wrapper">

<div class="data">
	<div class="first-child"><label for="name">考核项名称</label></div>
	<div class="child"><div class="readonly"><?php echo $tableitem->name?></div></div>
</div>


<div class="data">
	<div class="first-child"><label for="type">类型</label></div>
	<div class="child"><div class="readonly"><?php echo KpiItemType::to_string($tableitem->type)?></div></div>
</div>

<div class="data">
	<div class="first-child"><label for="weight">权重</label></div>
	<div class="child"><div class="readonly"><?php echo $tableitem->weight?><label>%</label></div></div>
</div>

<div class="data">
	<div class="first-child"><label for="desc">指标解释</label></div>
	<div class="child"><div class="readonly"><?php echo $tableitem->desc?></div></div>
</div>

<div class="data">
	<div class="first-child"><label for="timeline">时间节点</label></div>
	<div class="child"><div class="readonly"><?php echo $tableitem->timeline?></div></div>
</div>

<div class="data">
	<div class="first-child"><label for="quality">质量要求</label></div>
	<div class="child"><div class="readonly"><?php echo $tableitem->quality?></div></div>
</div>

<div class="data">
	<div class="first-child"><label for="output">结果型输出</label></div>
	<div class="child"><div class="readonly"><?php echo $tableitem->output?></div></div>
</div>

<div class="data">
	<div class="first-child"><label for="standard">评分标准</label></div>
	<div class="child"><div class="readonly"><?php echo $tableitem->standard?></div></div>
</div>


<div class="data">
	<div class="first-child"><label for="standard">数据源表</label></div>
	<div class="child"><div class="readonly"><?php echo $datasource->name?></div></div>
</div>

<div class="data">
	<div class="first-child"><label for="standard">评分部门</label></div>
	<div class="child"><div class="readonly"><?php echo $depart->name?></div></div>
</div>

<div class="data">
	<div class="first-child"><label for="standard">办事员</label></div>
	<div class="child"><div class="readonly"><?php echo $staff->name?>（<?php echo $staff->slug?>）</div></div>
</div>


<div class="data">
	<div class="first-child"><label for="score">评分</label></div>
	<div class="child"><div class="readonly"><?php echo get_score($dataitem)?></div></div>
</div>
</div>

<div class="actions">
<div class="actions-left"><input type="button" value="返回" onclick="history.back()" /></div>
</div>

</div>
</div>
<?php 
	}
?>
