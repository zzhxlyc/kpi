<?php
if($error){
	output_error($error, $index_page);
}
else{
	?>
<div id="right">
<div class="box">
<form action="" method="post">
<div class="header_main title"></div>

<div class="data_wrapper">

<div class="data"><div><label for="name">考核表名称</label></div> <div class="readonly"><?php echo $kpitable->name?></div>
</div>

<!-- <hr /> -->

<div class="data"><div><label for="name">考核项名称</label></div> <div class="readonly"><?php echo $tableitem->name?></div>
</div>

<div class="data"><div><label for="type">类型</label></div> <div class="readonly"><?php echo KpiItemType::to_string($tableitem->type)?></div>
</div>

<div class="data"><div><label for="weight">权重</label></div> <div class="readonly"><?php echo $tableitem->weight?>%</div>
</div>

<div class="data"><div><label for="desc">指标解释</label></div> <div class="readonly"><?php echo $tableitem->desc?></div>
</div>

<div class="data"><div><label for="timeline">时间节点</label></div> <div class="readonly"><?php echo $tableitem->timeline?></div>
</div>

<div class="data"><div><label for="quality">质量要求</label></div> <div class="readonly"><?php echo $tableitem->quality?></div>
</div>

<div class="data"><div><label for="output">结果型输出</label></div> <div class="readonly"><?php echo $tableitem->output?></div>
</div>

<div class="data"><div><label for="standard">评分标准</label></div> <div class="readonly"><?php echo $tableitem->standard?></div>
</div>

<div class="data"><div><label for="datasource">数据来源</label></div> <div class="readonly"><?php echo $tableitem->ds_name?></div>
</div>

<div class="data"><div><label for="staff">办事员</label></div> <div class="readonly"><?php echo $tableitem->username?>（<?php echo $tableitem->slug?>）</div>
</div>

<!--<div class="data">
	<div><label for="modified">审核</label></div>
	<?php if($tableitem->modified == 1){echo '可修改';}else{echo '不可修改';}?>
</div>-->
</div>

<div class="actions">
<div class="actions-left"><input type="button" value="修改"
	onclick="location.href='<?php echo $home.'/edititem?id='.$tableitem->id?>'" />
</div>
<div class="actions-right"><input type="button" value="返回"
	onclick="history.back()" /></div>
<input type="hidden" name="id" value="<?php echo $depart->id?>" />
</div>

</form>
</div>
</div>

	<?php
}
?>
