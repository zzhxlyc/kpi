
<?php
if($error){
	output_error($error, $index_page);
}
else{
	?>
<div id="right">
<form action="<?php echo $home.'/edit?id='.$depart->id?>" method="post">
<div class="box" >

<div class="header_main title">
<h2>编辑部门</h2>
</div>

<div class="data_wrapper">

<div class="data">
<div class="first-child"><label for="name">部门名称</label></div>
<div class="child"><input size="20" type="text" name="name"
	value="<?php echo $depart->name?>" /> <span class="error"><?php echo $errors['name']?></span></div>
</div>



</div>
<div class="actions">
<div class="actions-left"><input type="submit" value="保存" /></div>
<div class="actions-right"><input type="button" value="返回"
	onclick="location.href='<?php echo $home?>/index'" /></div>
<input type="hidden" name="id" value="<?php echo $depart->id?>" /></div>

<?php 
output_edit_success();
?>
</div>
</form>
</div>
<?php
}
?>
