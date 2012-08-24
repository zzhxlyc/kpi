
<div id="content">
	<form action="" method="post" >
		<div class="edit_panel">
			<div class="header_main title" >
				<h2>添加公司主管</h2>
			</div>
			
			<div class="data_wrapper">
			<div class="data">
				<div><label for="name">姓名</label></div>
				<div><input size="20" type="text" name="name" value="<?php echo $user->name?>" /></div>
				<span class="error"><?php echo $errors['name']?></span>
			</div>

			<div class="data">
				<div><label for="slug">登录名</label></div>
				<div>
				<input size="20" type="text" name="slug" value="<?php echo $user->slug?>" />
				<label class="input_rule">只能使用用英文数字下划线，推荐姓名拼音或员工编号，此后不能修改</label>
				</div>
				<span class="error"><?php echo $errors['slug']?></span>
				
			</div>
			
			
			<div class="data">
				<label for="password">密码</label>
				<div><input size="20" type="password" name="password" /></div>
				<span class="error"><?php echo $errors['password']?></span>
			</div>

			<div class="has_subdata">
				<label for="depart">管理部门</label>
				<div class="blank_div"></div>
			</div>
				<?php 
					foreach($depart_list as $o){
						if(is_array($user->depart)){
							$cond = in_array($o->id, $user->depart);
						}
				?>
			<div class="subdata">
				<label> <?php echo $o->name?> </label>
				<input type="checkbox" name="depart[]" value="<?php echo $o->id?>"
				<?php $HTML->if_checked($cond)?> />
			</div>
				
				<?php 
					}
				?>
				<span class="error"><?php echo $errors['depart']?></span>
			</div>
			<div class="actions">
				<div class="actions-left"><input type="submit" value="保存" /></div>
				<div class="actions-right"><input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" /></div>
			</div>

	</form>
</div>
	


