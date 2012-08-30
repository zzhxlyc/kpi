
<div id="right">
	<div class="box _edit">
		<div class="header_main title" >
			<h2>添加部门主管</h2>
		</div>
		<form action="" method="post" >
			<div class="data_wrapper">
			<div class="data">
				<div><label for="name">姓名</label></div>
				<div><input size="20" type="text" name="name" value="<?php echo $user->name?>" />
				<span class="error"><?php echo $errors['name']?></span></div>
			</div>

			<div class="data">
				<div><label for="slug">登录名</label></div>
				<div>
				<input size="20" type="text" name="slug" value="<?php echo $user->slug?>" />
				<label class="input_rule">只能使用英文、数字、下划线，推荐姓名拼音或员工编号，此后不能修改</label>
				<br><span class="error"><?php echo $errors['slug']?></span></div>
				
			</div>
			
			
			<div class="data">
				<div><label for="password">密码</label></div>
				<div><input size="20" type="password" name="password" />
				<span class="error"><?php echo $errors['password']?></span></div>
			</div>

			<div class="data">
				<div><label for="depart">管理部门</label></div>
				<div>
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
					<span class="error"><?php echo $errors['depart']?></span>		
				</div>	
			</div>
			
			</div>
			
			<div class="actions">
				<div class="actions-left"><input type="submit" value="保存" /></div>
				<div class="actions-right"><input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" /></div>
			</div>

	</form>
</div>
</div>
	


