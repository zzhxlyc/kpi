<?php
if($error){
	output_error($error, $index_page);
}
else{
	?>
<div id="right">
<form action="" method="post">
<div class="box">
<div class="header_main title"></div>

<div class="data_wrapper"><?php 
if(is_array($list)){
	foreach($list as $o){
		$name = $o->COLUMN_NAME;
		$comment = $o->COLUMN_COMMENT;
		if($name != 'id'){
			?>
<div class="data">
<div class="first-child"><label for="<?php echo $name?>"><?php echo $comment?></label></div>
<div class="child"><?php echo $data[$name]?></div>
</div>
			<?php
		}
	}
}
?></div>

<div class="actions">
<div class="actions-right"><input type="button" value="返回"
	onclick="history.back()" /></div>
</div>

</div>
</form>
</div>
<?php
}
?>


