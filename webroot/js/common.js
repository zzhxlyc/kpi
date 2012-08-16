
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
	var num = $("#columns").val();
	var html = '<tr>';
	for(var i = 0;i < num;i++){
		html += '<td><input style="width:80px" type="text"/></td>';
	}
	html += '</tr>';
	$("#data_table").append(html);
}

function sourcedata_save_row(){
	var columns = [];
	$("#column_row label").each(function (){
		columns += $(this).attr('for');
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

