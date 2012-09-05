
<div id="right">
<form action="" method="post">
<div class="box">

<div class="header_main title">
<h2>添加考核表</h2>
</div>

<div class="data_wrapper">

<div class="data">
<div class="first-child"><label for="name">考核表名称</label></div>
<div class="child"><input size="50" type="text" name="name"
	value="<?php echo $kpitable->name?>" /> <span class="error"><?php echo $errors['name']?></span></div>
</div>

<div class="data">
<div class="first-child"><label for="depart">所属部门</label></div>
<div class="child"><select name="depart">
	<option value="">选择部门</option>
	<?php
	if(is_array($departs)){
		foreach($departs as $depart){
			?>
	<option value="<?php echo $depart->id?>"
	<?php $HTML->selected($kpitable->depart, $depart->id)?>><?php echo $depart->name?></option>
	<?php
		}
	}
	?>
</select> <span class="error"><?php echo $errors['depart']?></span></div>
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


