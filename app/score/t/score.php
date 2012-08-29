<?php
if($error){
	output_error($error, $index_page);
}
else{
	?>
<div id="right">
<div class="box noBlank">
<div class="header_main title"></div>

<form action="" method="post">
<div class="data_wrapper">

<div class="data">
<div><label for="name">部门</label></div>
<div class="readonly"><?php echo $depart->name?></div>
</div>

<div class="data">
<div><label for="name">考核表名称</label></div>
<div class="readonly"><?php echo $kpitable->name?></div>
</div>

<div class="data">
<div><label for="name">考核项名称</label></div>
<div class="readonly"><?php echo $tableitem->name?></div>
</div>

<div class="data">
<div><label for="type">类型</label></div>
<div class="readonly"><?php echo KpiItemType::to_string($tableitem->type)?></div>
</div>

<div class="data">
<div><label for="weight">权重</label></div>
<div class="readonly"><?php echo $tableitem->weight?>%</div>
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

<div class="data">
<div><label for="datasource">数据来源</label></div>
<div class="readonly"><a target="_blank"
	href="<?php echo DATA_HOME.'/index?datasource='.$tableitem->datasource?>">查看数据来源</a></div>
</div>

<hr />

<div class="data">
<div><label for="score">评分</label></div>
	<?php
	$score = $dataitem->score;
	if($score == -1) $score = '';
	?>
<div><input type="text" name="score" value="<?php echo $score?>" /></div>
</div>

<div class="data"><?php 
output_edit_success();
}
?></div>

</div>

<div class="actions">
<div class="actions-left"><input type="submit" value="保存" /></div>
<div class="actions-right"><input type="button" value="返回"
	onclick="location.href='<?php echo $home?>/index'" /></div>
<input type="hidden" name="id" value="<?php echo $dataitem->id?>" /></div>

</form>
</div>
</div>
