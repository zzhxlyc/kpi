
<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>
<<<<<<< HEAD
<form action="<?php echo $home.'/edit?id='.$depart->id?>" method="post" >
	
<div class="row">
	<label for="name">部门名称</label>
	<input size="20" type="text" name="name" value="<?php echo $depart->name?>" />
	<span class="error"><?php echo $errors['name']?></span>
</div>	

<div class="row">
	<input type="submit" value="保存" />
	<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
	<input type="hidden" name="id" value="<?php echo $depart->id?>" />
</div>
=======
		<div id="content">
			
				<div class="edit_panel">
					<div class="header_main title">
					</div>
					<form action="" method="post" >
					<div class="data_wrapper">
						<div class="data">
							<label for="name">部门名称</label>
							<div>
							<input size="20" type="text" name="name" value="<?php echo $depart->name?>" />
							<span class="error"><?php echo $errors['name']?></span></div>
						</div>	
					
						<?php 
							output_edit_success();
						?>
					</div>
					<div class="actions">
							
							<div class="actions-left"><input type="submit" value="保存" /></div>
							<div class="actions-right"><input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" /></div>
							<input type="hidden" name="id" value="<?php echo $depart->id?>" />
						</div>
>>>>>>> 1e3fe3ed71e9088fed0f8fea9649106e219d3e5a

					</form>
				</div>
			
		</div>		
<?php
	}
?>
