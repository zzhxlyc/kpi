<?php

class User extends AppModel{

	public $table = 'user';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('name', 'password', 'slug', 'type', 'limit'),
			'length' => array('name'=>250, 'slug'=>250, 'password'=>250),
			'int' => array('type', 'limit'),
			'number' => array(),
			'word'=> array(),
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('name', 'slug'),
			'url'=>array(),
			'html'=>array()
		);
		return parent::escape($data, $escape_array, $ignore);
	}

}