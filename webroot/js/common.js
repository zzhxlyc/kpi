$(document).ready(function(){
	$(".remove_operation").click(function (){
		if($(this).hasClass("batch_remove")&& $("input[type='checkbox']:checked").length == 0){
			alert("请先选取删除项。");
			return false;
		}
		
		if(confirm('确定要删除吗？')){
			return true;
		}
		else{
			return false;
		}
	});
	
});



function table_item_init(){
	$(".table_item_type_select").change(function (){
		if(this.value == 4){
			$(".item_type_normal .error").html("");
			$(".item_type_normal").hide();
		}
		else{
			$(".item_type_normal").show();
		}
	});
	$(".table_item_type_select").change();
}

function big_table_init(){
	var length = ($("#data_table tr:first td").size() - 1) * 100 + 150;
	if(length < 780){
		length = 780;
	}
	$("#data_table").css('width', length + 'px');
}

function sourcedata_add_row(){
	$("input.unSaved").attr('readonly','readonly');
	$("input.unSaved").removeClass();
	
	var num = $("#columns").val();
	var html = '<tr>';
	for(var i = 0;i < num;i++){
		html += '<td><input class="unSaved" type="text"/></td>';
	}
	html += '</tr>';
	$("#data_table").append(html);
	
}

function sourcedata_save_row(){
	var columns = new Array();
	$("#column_row label").each(function (){
		var v = this.htmlFor;
		if(v == ''){
			v = $(this).attr('for');
		}
		columns.push(v);
	});
	var value = '';
	var empty = true;
	$("#data_table tr:last :text").each(function (i){
		if(i > 0){
			value += '&';
		}
		if(this.value != ''){
			empty = false;
		}
		value += columns[i] + '=' + this.value;
	});
	if(!empty){
		if(confirm('确定保存这一行？')){
			var url = window.ROOT_URL + '/sourcedata/addrow';
			var dsid = $("#dsid").val();
			$.ajax({
				type: "POST",
				url: url,
				data: value + "&dsid=" + dsid,
				success: function(msg){
					if(msg == '1'){
						sourcedata_add_row();
					}
					else{
						alert('出错了');
					}
				}
			});
		}
	}
	else{
		alert('数据都为空');
	}
}



