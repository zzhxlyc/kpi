
<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>
		<div id="right">
			
				<div class="box _edit">
					<div class="header_main title">
					</div>
					<form action="" method="post" >
					<div class="data_wrapper">
						<div class="data">
							<div><label for="name">部门名称</label></div>
							<div>
							<input size="20" type="text" name="name" value="<?php echo $depart->name?>" />
							<span class="error"><?php echo $errors['name']?></span></div>
						</div>	
						<div class="data">
						<?php 
							output_edit_success();
						?>
						</div>	
					</div>
					<div class="actions">
							
							<div class="actions-left"><input type="submit" value="保存" /></div>
							<div class="actions-right"><input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" /></div>
							<input type="hidden" name="id" value="<?php echo $depart->id?>" />
					</div>

					</form>
				</div>
			
		</div>		
<?php
	}
?>
