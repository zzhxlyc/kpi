

<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>
		<div id="content">
			<form action="" method="post" >
				<div class="edit_panel">
					<div class="header_main title" ></div>
					<div class="data">
						<div><label for="password">新密码</label></div>
						<input size="20" type="password" name="password" />
						<span class="error"><?php echo $errors['password']?></span>
					</div>

					<div class="data">
						<div><label for="password2">确认密码</label></div>
						<input size="20" type="password" name="password2" />
						<span class="error"><?php echo $errors['password2']?></span>
					</div>

					<div class="data">
						<input type="submit" value="保存" />
						<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
						<input type="hidden" name="id" value="<?php echo $user->id?>" />
					</div>

					</div>
						
				</div>
			</form>
		</div>	
<?php 
	}
?>
