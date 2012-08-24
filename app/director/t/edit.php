
<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>
<div id="content">
	<form action="" method="post" >
		<div class="edit_panel">
			<div class="header_main title" >
			</div>
	
			<div class="data">
				<div><label for="name">姓名</label></div>
				<input size="20" type="text" name="name" value="<?php echo $user->name?>" />
				<span class="error"><?php echo $errors['name']?></span>
			</div>

			<div class="data">
				<div><label for="slug">别名</label></div>
				<div class="readonly"><label > <?php echo $user->slug?></label></div>
			</div>


			<div class="data">
				<div><label for="depart">管理部门</label></div>
				<div class="readonly">
			
				<select name="depart">
				<?php 
					foreach($depart_list as $o){
						if(is_array($user->depart)){
							$cond = in_array($o->id, $user->depart);
						}
				?>
				<?php echo $o->name?>
				
				<option value="<?php echo $o->id?>" 
					<?php $HTML->selected($o->id, $user->depart)?> ><?php echo $o->name?></option>
					
				
					
				<?php 
					}
				?>
				</select>
				</div>
			</div>
				<span class="error"><?php echo $errors['depart']?></span>
			

			<div class="data">
				<input type="submit" value="保存" />
				<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
				<input type="hidden" name="id" value="<?php echo $user->id?>" />
			</div>

		</div>
	</form>
</div>	
<?php 
		output_edit_success();
	}
?>