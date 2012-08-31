<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>
<div id="right">
	<div class="box _edit noBlank">
		<div class="header_main title" >
		<h2>编辑考核表</h2>
		</div>
		<form action="<?php echo $home.'/edit?id='.$kpitable->id?>" method="post" >
			<div class="data_wrapper">
	
<div class="data">
	<div><label for="name">考核表名称</label></div>
	<div><input size="20" type="text" name="name" value="<?php echo $kpitable->name?>" />
	<span class="error"><?php echo $errors['name']?></span></div>
</div>

<div class="data">
	<div><label for="depart">所属部门</label></div>
	<div>
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
	<span class="error"><?php echo $errors['depart']?></span></div>
</div>

				<div class="data">
					<?php 
						output_edit_success();
					}
					?>
				</div>
			</div>						
			<div class="actions">
					<div class="actions-left"><input type="submit" value="保存" /></div>
					<div class="actions-right"><input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" /></div>
					<input type="hidden" name="id" value="<?php echo $kpitable->id?>" />
			</div>
		</form>
	</div>
</div>				
