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