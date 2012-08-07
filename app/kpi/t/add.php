
<form action="" method="post" >

<div class="row">
	<label for="name">考核表名称</label>
	<input size="80" type="text" name="name" value="<?php echo $kpidata->name?>" />
	<span class="error"><?php echo $errors['name']?></span>
</div>

<div class="row">
	<label for="depart">KPI考核表</label>
	<select name="kpi_table">
		<option value="">选择考核表</option>
		<?php 
			foreach($kpi_table_list as $table){
		?>
		<option value="<?php echo $table->id?>" <?php $HTML->selected($table->id, $kpidata->kpi_table)?>><?php echo $table->name?></option>
		<?php 
			}
		?>
	</select>
	<span class="error"><?php echo $errors['kpi_table']?></span>
</div>

<div class="row">
	<label for="type">时间类型</label>
	<select name="type" onchange="change_type(this)">
		<option value="">选择时间类型</option>
		<option value="1" <?php $HTML->selected(1, $kpidata->type)?>>月度</option>
		<option value="2" <?php $HTML->selected(2, $kpidata->type)?>>季度</option>
		<option value="3" <?php $HTML->selected(3, $kpidata->type)?>>半年度</option>
		<option value="5" <?php $HTML->selected(4, $kpidata->type)?>>年度</option>
	</select>
	<span class="error"><?php echo $errors['type']?></span>
</div>

<div class="row">
	<label for="year">年份</label>
	<?php 
		if(isset($kpidata->year)){
			$year = $kpidata->year;
		}
		else{
			$year = idate('Y');
		}
	?>
	<input size="4" type="text" name="year" value="<?php echo $year?>" />
	<span class="error"><?php echo $errors['year']?></span>
</div>

<div class="row">
	<label for="month">月份</label>
	<input size="2" type="text" name="month" value="<?php echo $kpidata->month?>" />月
	<span id="text_month2">
		<span class="error"><?php echo $errors['month']?></span> 至
		<input size="2" type="text" name="month2" value="<?php echo $kpidata->month2?>" />月
		<span class="error"><?php echo $errors['month2']?></span>
	</span>
</div>

<div class="row" style="margin: 20px 0">
	<input type="submit" value="保存" />
	<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
</div>

</form>

<script type="text/javascript">
<!--
function change_type(select){
	if(select.value == 1){
		$("#text_month2").hide();
	}
	else{
		$("#text_month2").show();
	}
}
//-->
</script>
