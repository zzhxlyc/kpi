

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
					<div class="data_wrapper">
					<div class="data">
						<label for="password">新密码</label>
						<div><input size="20" type="password" name="password" /></div>
						<span class="error"><?php echo $errors['password']?></span>
					</div>

					<div class="data">
						<label for="password2">确认密码</label>
						<div><input size="20" type="password" name="password2" /></div>
						<span class="error"><?php echo $errors['password2']?></span>
					</div>
					</div>
					<div class="actions">
						<div class="actions-left"><input type="submit" value="保存" /></div>
						<div class="actions-right"><input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" /></div>
					</div>

					</div>
						
				</div>
			</form>
		</div>	
<?php 
	}
?>
