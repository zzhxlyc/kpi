
<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>
		<div id="content">
			<form action="" method="post" >
				<div class="edit_panel">
					<div class="header_main title">
						<h5></h5>
					</div>
					<div class="data">
						<div><label for="name">部门名称</label></div>
						<input size="20" type="text" name="name" value="<?php echo $depart->name?>" />
						<span class="error"><?php echo $errors['name']?></span>
					</div>	
					<div class="data">
						<input type="submit" value="保存" />
						<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
						<input type="hidden" name="id" value="<?php echo $depart->id?>" />
					</div>
					
						<?php 
							output_edit_success();
						?>
				</div>
			</form>
		</div>		
<?php
	}
?>
