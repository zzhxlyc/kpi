<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>
<<<<<<< HEAD
<form action="<?php echo $home.'/edit?id='.$kpitable->id?>" method="post" >
=======
<div id="content">
	<form action="" method="post" >
		<div class="edit_panel">
			<div class="header_main title" >
			</div>
>>>>>>> 1e3fe3ed71e9088fed0f8fea9649106e219d3e5a
	
<div class="data">
	<div><label for="name">考核表名称</label></div>
	<input size="20" type="text" name="name" value="<?php echo $kpitable->name?>" />
	<span class="error"><?php echo $errors['name']?></span>
</div>

<div class="data">
	<div><label for="depart">所属部门</label></div>
	<select name="depart">
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

<div class="data">
	<input type="submit" value="保存" />
	<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
	<input type="hidden" name="id" value="<?php echo $kpitable->id?>" />
</div>

			</div>
	</form>
</div>
<?php 
		output_edit_success();
	}
?>
