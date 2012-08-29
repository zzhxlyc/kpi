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

<form action="" method="post">
<div class="data_wrapper">
<?php 
	if(is_array($list)){
		foreach($list as $o){
			$name = $o->COLUMN_NAME;
			$comment = $o->COLUMN_COMMENT;
			if($name != 'id'){
?>
<div class="data">
	<div><label for="<?php echo $name?>"><?php echo $comment?></label></div>
	<?php echo $data[$name]?>
</div>
<?php 
			}
		}
	}
?>
</div>

<div class="actions">
<div class="actions-left"><input type="button" value="返回" onclick="history.back()" /></div>
</div>

</form>
</div>
</div>
<?php 
	}
?>


