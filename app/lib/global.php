<?php

function img($image){
	echo UPLOAD_HOME.'/'.$image;
}

function download($file){
	echo UPLOAD_HOME.'/'.$file;
}

function get_user($session = Null){
	if($session && is_object($session)){
		return intval($session->get('user'));
	}
	return 0;
}

function output_error($error, $home){
	echo '<p>'.$error.'</p>';
	echo '<a href="'.$home.'">返回</a>';
}

function output_edit_success(){
	if(isset($_GET['succ'])){
		echo '<p><span>修改成功</span></p>';
	}
}

function get_score($o, $percent = 1){
	if(is_object($o)){
		$score = $o->score;
		$f = is_foujue($o);
	}
	else{
		$score = $o;
		$f = false;
	}
	if(!$f){
		if($score == -1){
			return '未评分';
		}
		return $score;
	}
	else{
		if($percent){
			return $score.'%';
		}
		else{
			return $score;
		}
	}
}

function get_weight($o){
	if($o->type == KpiItemType::FOUJUE){
		return '-';
	}
	else{
		return $o->weight.'%';
	}
}

function is_foujue($o){
	if($o->type == KpiItemType::FOUJUE){
		return true;
	}
	return false;
}