<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>
<form action="" method="post" >

<?php 
	if(is_array($list)){
		foreach($list as $o){
			$name = $o->COLUMN_NAME;
			$comment = $o->COLUMN_COMMENT;
			if($name != 'id'){
?>
<div class="row">
	<label for="<?php echo $name?>"><?php echo $comment?></label>
	<?php echo $data[$name]?>
</div>
<?php 
			}
		}
	}
?>

<div class="row" style="margin: 20px 0">
	<input type="button" value="返回" onclick="history.back()" />
</div>

</form>
<?php 
	}
?>


