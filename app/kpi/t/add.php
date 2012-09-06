
<div id="right">
<form action="" method="post">
<div class="box">
<div class="header_main title">
<h2>添加KPI考核记录</h2>
</div>

<div class="data_wrapper">

<div class="data">
<div class="first-child"><label for="name">考核表名称</label></div>
<div class="child"><input size="80" type="text" name="name"
	value="<?php echo $kpidata->name?>" /> <span class="error"><?php echo $errors['name']?></span></div>
</div>

<div class="data">
<div class="first-child"><label for="depart">KPI考核表</label></div>
<div class="child"><select name="kpi_table">
	<option value="">选择考核表</option>
	<?php
	foreach($kpi_table_list as $table){
		?>
	<option value="<?php echo $table->id?>"
	<?php $HTML->selected($table->id, $kpidata->kpi_table)?>><?php echo $table->name?></option>
	<?php
	}
	?>
</select> <span class="error"><?php echo $errors['kpi_table']?></span></div>
</div>

<div class="data">
<div class="first-child"><label for="type">时间类型</label></div>
<div class="child"><select name="type" id="time_type" onchange="change_type()">
	<option value="">选择时间类型</option>
	<option value="1" <?php $HTML->selected(1, $kpidata->type)?>>月度</option>
	<option value="2" <?php $HTML->selected(2, $kpidata->type)?>>季度</option>
	<option value="3" <?php $HTML->selected(3, $kpidata->type)?>>半年度</option>
	<option value="4" <?php $HTML->selected(4, $kpidata->type)?>>年度</option>
</select> <span class="error"><?php echo $errors['type']?></span></div>
</div>

<div class="data">
<div class="first-child"><label for="year">年份</label></div>
	<?php
	if(isset($kpidata->year)){
		$year = $kpidata->year;
	}
	else{
		$year = idate('Y');
	}
	?>
<div class="child"><input size="4" type="text" name="year" value="<?php echo $year?>" />
<span class="error"><?php echo $errors['year']?></span></div>
</div>

<div class="data">
<div class="first-child"><label for="month">月份</label></div>
<div class="child"><input size="2" type="text" name="month"
	value="<?php echo $kpidata->month?>" /> <label>月</label>  <span id="text_month2"> <span
	class="error"><?php echo $errors['month']?></span> <label style="padding:0 5px;">至</label>  <input size="2"
	type="text" name="month2" value="<?php echo $kpidata->month2?>" /> <label>月</label>  <span
	class="error"><?php echo $errors['month2']?></span> </span></div>
</div>
</div>

<div class="actions">
<div class="actions-left"><input type="submit" value="保存" /></div>
<div class="actions-right"><input type="button" value="返回"
	onclick="location.href='<?php echo $home?>/index'" /></div>
</div>

</div>
</form>
</div>

<script type="text/javascript">
<!--
change_type();
function change_type(){
	var v = $('#time_type').val();
	if(v == 1){
		$("#text_month2").hide();
	}
	else{
		$("#text_month2").show();
	}
}
//-->
</script>
