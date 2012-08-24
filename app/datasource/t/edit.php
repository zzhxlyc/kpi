<?php 
	if($error){
		output_error($error, $index_page);
	}
	else{
?>
<div id="content">
	<form action="" method="post" >
		<div class="edit_panel">
			<div class="header_main title" >
			</div>	
<div class="data">
	<div><label for="name">表格名称</label></div>
	<input size="50" type="text" name="name" value="<?php echo $datasource->name?>" />
	<span class="error"><?php echo $errors['name']?></span>
</div>

<div class="data">
	<div><label for="slug">别名</label></div>
	<?php echo $datasource->slug?>
</div>

<div class="data">
	<div><label for="slug">添加属性</label></div>
	<input size="20" type="text" id="new_attr" />
	<a href="javascript:void(0)" onclick="add_data()">添加一行</a>
</div>

<div class="has_subdata">
	<div><label >修改属性</label></div>
	<div class="blank_div"></div>
</div>
<div class="ds_subdata">
	<div><label >标示：</label></div>
	<input size="20" type="text" id="old_column" />
</div>
<div class="ds_subdata">
	<div><label >新列名：</label></div>	
	<input size="20" type="text" id="new_comment" />
	<a href="javascript:void(0)" onclick="modify_data()">修改这一行</a>
</div>

<div class="data">
	<div><label for="attr">属性表</label></div>
</div>
<div class="ds_table_struct">
	<table id="ds_table_attrs">
		<tr><th align="left" width="50">标示</th>
		<th align="left" width="200">列名</th><th>操作</th></tr>
	</table>
</div>


<div class="data">
	<input type="submit" value="保存" />
	<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
	<input type="hidden" name="id" value="<?php echo $datasource->id?>" />
	<input type="hidden" id="column" name="column" />
	<input type="hidden" id="comment" name="comment" />
</div>

			</div>
	</form>
</div>

<script type="text/javascript">
<!--
<?php 
	foreach($datasource->column as $comment => $column){
		echo "_add('$column', '$comment');\n";
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
function modify_row(){
	var column = $('#old_column').val();
	var comment = $('#new_comment').val();
	if(column == ''){
		alert('标志为空');
	}
	else if(comment == ''){
		alert('新列名为空');
	}
	else{
		var has = false;
		var obj;
		$("#ds_table_attrs tr font").each(function (i){
			if($(this).html() == column){
				has = true;
				obj = this;
			}
		});
		if(has == false){
			alert('无此标志');
		}
		else{
			$(obj).parents('tr').find('span').html(comment);
			$('#old_column').val('');
			$('#new_comment').val('');
			set_value();
		}
	}
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
<?php 
		output_edit_success();
	}
?>
