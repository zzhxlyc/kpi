
<form action="" method="post" >

<div class="row">
	<label for="name">考核表名称</label>
	<input size="20" type="text" name="name" value="<?php echo $kpitable->name?>" />
	<span class="error"><?php echo $errors['name']?></span>
</div>

<div class="row">
	<label for="depart">所属部门</label>
	<select name="depart">
		<option value="">选择部门</option>
		<?php 
			if(is_array($departs)){
				foreach($departs as $depart){
		?>
		<option value="<?php echo $depart->id?>" <?php $HTML->selected($kpitable->depart, $depart->id)?>><?php echo $depart->name?></option>
		<?php
				} 
			}
		?>
	</select>
	<span class="error"><?php echo $errors['depart']?></span>
</div>

<div class="row" style="margin: 20px 0">
	<input type="submit" value="保存" />
	<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
</div>

</form>


