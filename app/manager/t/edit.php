
<?php
if($error){
	output_error($error, $index_page);
}
else{
	?>
<div id="right">
<div class="box hasBlank">
<form action="<?php echo $home.'/edit?id='.$user->id?>" method="post">
<div class="header_main title">
<h2>编辑公司主管</h2>
</div>

<div class="data_wrapper">

<div class="data">
<div><label for="name">姓名</label></div>
<div><input size="20" type="text" name="name"
	value="<?php echo $user->name?>" /> <span class="error"><?php echo $errors['name']?></span></div>
</div>

<div class="data">
<div><label for="slug">登录名</label></div>
<div class="readonly"><label> <?php echo $user->slug?></label></div>
</div>

<div class="data">
<div><label for="depart">管理部门</label></div>
<div><?php 
foreach($depart_list as $o){
	if(is_array($user->depart)){
		$cond = in_array($o->id, $user->depart);
	}
	?>
<div class="subdata">
<div><label> <?php echo $o->name?> </label></div>
<div><input type="checkbox" name="depart[]" value="<?php echo $o->id?>"
<?php $HTML->if_checked($cond)?> /></div>
</div>
<?php
}
?> <span class="error"><?php echo $errors['depart']?></span></div>
</div>

<div class="data"><?php 
output_edit_success();
}
?></div>
</div>

<div class="actions">
<div class="actions-left"><input type="submit" value="保存" /></div>
<div class="actions-right"><input type="button" value="返回"
	onclick="location.href='<?php echo $home?>/index'" /></div>
<input type="hidden" name="id" value="<?php echo $user->id?>" /></div>
</form>
</div>
</div>
