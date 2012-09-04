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

$(function(){
//$(".data>div:first-child").css("border", "1px solid orange");
//$(".box .data>div:first-child").css("_width", "16%");
//$(".box .data>div label").css("_display", "inline");
//$(".box .data>div label").css("border", "1px solid orange");
/*
 
 $(".box .data>div").css("_border-left","1px solid blue");
$(".box .data>div").css("_float", "right");
$(".box .data>div").css("_width", "75%");
$(".box .data>div").css("_margin-left", "5px");


$(".box .data>div input").css("_display", "inline");
 
$(".box .data>div:first-child").css("_float", "left");

$(".box .data>div:first-child").css("_margin-top", "6px");
$(".box .data>div:first-child").css("_margin-left", "5px");
$(".box .data>div:first-child").css("_line-height", "36px");
 
$(".box .data>div").css("_padding", "0 5px");
$(".box .data>div").css("_padding-right", "5px");*/
	
});

$(function() {
	$( "#fromDataPicker" ).datepicker();
	$( "#toDataPicker" ).datepicker();
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
		html += '<td><input class="unSaved" style="width:80px" type="text"/></td>';
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



