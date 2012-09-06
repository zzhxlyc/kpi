<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>
<div id="right">
<form action="<?php echo $home.'/edit?id='.$user->id?>" method="post">
<div class="box">
<div class="header_main title">
</div>

<div class="data_wrapper">
	
<div class="data">
	<div class="first-child"><label for="name">姓名</label></div>
	<div class="child"><input size="20" type="text" name="name" value="<?php echo $user->name?>" />
	<span class="error"><?php echo $errors['name']?></span></div>
</div>

<div class="data">
	<div class="first-child"><label for="slug">别名</label></div>
	<div class="child"><div class="readonly"><?php echo $user->slug?></div></div>
</div>

<div class="data">
	<div class="first-child"><label for="depart">所属部门</label></div>
	<div class="child"><div class="readonly"><?php echo $depart->name?></div></div>
</div>


</div>

<div class="actions">
<div class="actions-left"><input type="submit" value="保存" /></div>
<div class="actions-right">
<input type="button" value="返回" onclick="location.href='<?php echo $home."/show?depart=$depart->id"?>'" />
</div>
<input type="hidden" name="id" value="<?php echo $user->id?>" /></div>

<?php 
output_edit_success();
}
?>


</div>
</form>
</div>
