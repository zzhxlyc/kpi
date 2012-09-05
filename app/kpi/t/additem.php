
<div id="right">
<form action="" method="post">
<div class="box">
<div class="header_main title">
<h2>添加KPI考核记录</h2>
</div>

<div class="data_wrapper">

<div class="data">
	<div class="first-child"><label for="name">考核表名称</label></div>
	<div class="child"><div class="readonly"><?php echo $kpitable->name?></div></div>
</div>

<div class="data">
	<div class="first-child"><label for="depart">所属部门</label></div>
	<div class="child"><div class="readonly"><?php echo $manager->department?></div></div>
</div>

<div class="data">
	<div class="first-child"><label for="name">名称</label></div>
	<div class="child"><input size="50" type="text" name="name" value="<?php echo $tableitem->name?>" />
	<span class="error"><?php echo $errors['name']?></span></div>
</div>

<div class="data">
	<div class="first-child"><label for="kind">属性</label></div>
	<div class="child"><select name="kind">
		<option value="1" <?php $HTML->selected('1', $tableitem->kind)?>>全厂统一</option>
		<option value="2" <?php $HTML->selected('2', $tableitem->kind)?>>部门相关</option>
	</select>
	<span class="error"><?php echo $errors['kind']?></span></div>
</div>

<div class="data">
	<div class="first-child"><label for="type">考核项类型</label></div>
	<div class="child"><select name="type">
		<option value="">选择类型</option>
		<option value="1" <?php $HTML->selected('1', $tableitem->type)?>>经济</option>
		<option value="2" <?php $HTML->selected('2', $tableitem->type)?>>管理</option>
		<option value="3" <?php $HTML->selected('3', $tableitem->type)?>>管理支持</option>
		<option value="4" <?php $HTML->selected('4', $tableitem->type)?>>否决</option>
	</select>
	<span class="error"><?php echo $errors['type']?></span></div>
</div>

<div class="data">
	<div class="first-child"><label for="weight">权重</label></div>
	<div class="child"><input size="5" type="text" name="weight" value="<?php echo $tableitem->weight?>" /> %
	<span class="error"><?php echo $errors['weight']?></span></div>
</div>

<div class="data">
	<div class="first-child"><label for="desc">指标解释</label></div>
	<div class="child"><textarea rows="5" cols="60" name="desc"><?php echo $tableitem->desc?></textarea>
	<span class="error"><?php echo $errors['desc']?></span></div>
</div>

<div class="data">
	<div class="first-child"><label for="timeline">时间节点</label></div>
	<div class="child"><input size="50" type="text" name="timeline" value="<?php echo $tableitem->timeline?>" />
	<span class="error"><?php echo $errors['timeline']?></span></div>
</div>

<div class="data">
	<div class="first-child"><label for="quality">质量要求</label></div>
	<div class="child"><input size="100" type="text" name="quality" value="<?php echo $tableitem->quality?>" />
	<span class="error"><?php echo $errors['quality']?></span></div>
</div>

<div class="data">
	<div class="first-child"><label for="output">结果型输出</label></div>
	<div class="child"><input size="100" type="text" name="output" value="<?php echo $tableitem->output?>" />
	<span class="error"><?php echo $errors['output']?></span></div>
</div>

<div class="data">
	<div class="first-child"><label for="standard">评分标准</label></div>
	<div class="child"><input size="100" type="text" name="standard" value="<?php echo $tableitem->standard?>" />
	<span class="error"><?php echo $errors['standard']?></span></div>
</div>

<div class="data">
	<div class="first-child"><label for="datasource">数据来源</label></div>
	<div class="child"><select name="datasource">
		<option value="">选择数据来源表</option>
		<?php 
			foreach($ds_list as $ds){
		?>
		<option value="<?php echo $ds->id?>" <?php $HTML->selected($ds->id, $tableitem->datasource)?>><?php echo $ds->name?></option>
		<?php }?>
	</select>
	<span class="error"><?php echo $errors['datasource']?></span></div>
</div>

<div class="data">
	<div class="first-child"><label for="staff">办事员</label></div>
	<div class="child"><select name="staff">
		<option value="">选择办事员</option>
		<?php 
			foreach($staff_list as $staff){
		?>
		<option value="<?php echo $staff->id?>" <?php $HTML->selected($staff->id, $tableitem->staff)?>><?php echo $staff->name?>（<?php echo $staff->slug?>）</option>
		<?php }?>
	</select>
	<span class="error"><?php echo $errors['staff']?></span></div>
</div>

<div class="data">
	<div class="first-child"><label for="modified">审核</label></div>
	<div class="child"><input type="checkbox" name="modified" value="1" <?php $HTML->checked(1, $tableitem->modified)?> />
	<span class="error"><?php echo $errors['modified']?></span></div>
</div>
</div>

<div class="actions">
<div class="actions-left"><input type="submit" value="保存" /></div>
<div class="actions-right"><input type="button" value="返回"
	onclick="history.back()" /></div>
<input type="hidden" name="kpi_table" value="<?php echo $kpitable->id?>" />
</div>

</div>
</form>
</div>


