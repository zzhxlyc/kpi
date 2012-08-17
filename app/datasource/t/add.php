
<form action="" method="post" >

<div class="row">
	<label for="name">表格名称</label>
	<input size="50" type="text" name="name" value="<?php echo $datasource->name?>" />
	<span class="error"><?php echo $errors['name']?></span>
</div>

<div class="row">
	<label for="slug">别名</label>
	<input size="20" type="text" name="slug" value="<?php echo $datasource->slug?>" />
	<span class="error"><?php echo $errors['slug']?></span>
	推荐用英文单词、拼音首字母，此后不能修改
</div>

<div class="row">
	<label for="slug">添加属性</label>
	<input size="20" type="text" id="new_attr" />
	<a href="javascript:void(0)" onclick="add_row()">添加一行</a>
</div>

<div class="row">
	<label for="attr">属性表</label>
	<table id="ds_table_attrs">
		<tr><th align="left" width="50">标示</th>
			<th align="left" width="200">列名</th><th>操作</th></tr>
	</table>
</div>

<div class="row" style="margin: 20px 0">
	<input type="submit" value="保存" />
	<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
	<input type="hidden" id="column" name="column" />
	<input type="hidden" id="comment" name="comment" />
</div>

</form>

<script type="text/javascript">
<!--
<?php 
	if(is_array($datasource->column)){
		foreach($datasource->column as $comment => $column){
			echo "_add('$column', '$comment');\n";
		}
	}
?>
function add_row(){
	var attr = $("#new_attr").val();
	if(attr != ''){
		var patrn = /[,]/;
		if (patrn.exec(attr)){
			alert('不能含有,字符');
		}
		else{
			_add('', attr);
		}
	}
	else{
		alert('不能为空');
	}
}
function _add(column, comment){
	var row = '<tr><td height="30">' +
		'<font>' + column + '</font></td>' + 
		'<td><span>' + comment + '</span></td><td>' + 
		'<a href="javascript:void(0)" onclick="remove_row(this)">删除</a></td></tr>';
	$('#ds_table_attrs').append(row);
	$("#new_attr").val('');
	set_value();
}
function remove_row(obj){
	$(obj).parents("tr").remove();
	set_value();
}
function set_value(){
	var comment = '';
	$("#ds_table_attrs tr span").each(function (i){
		if(i > 0){
			comment += ',';
		}
		comment += $(this).html();
	});
	$("#comment").val(comment);
	var column = '';
	$("#ds_table_attrs tr font").each(function (i){
		if(i > 0){
			column += ',';
		}
		var html = $(this).html();
		if(html == '') html = 'new';
		column += html;
	});
	$("#column").val(column);
}
//-->
</script>


