<?php

class AppModel extends Model{
	
	public function check(&$data, array $check_arrays, array $ignore = array()){
		$errors = &parent::check($data, $check_arrays);
		return $errors;
	}
	
	public function check_file($array, array $ext_array = array()){
		$error = '';
		$ext = FileSystem::get_ext($array['name']);
		if(count($ext_array) == 0){
			$ext_array = array('doc', 'docx', 'xls', 'xlsx', 
								'ppt', 'pptx', 'txt', 'zip', 'rar', 
								'pdf', 'jpg', 'png', 'bmp', 'gif');
		}
		if(!in_array($ext, $ext_array)){
			$error = '文件格式不允许';
		}
		if($array['size'] >= 2 * 1024 * 1024){
			$error = '文件不能大于2M';
		}
		return $error;
	}
	
}