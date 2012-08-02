<?php

class Depart extends AppModel{

	public $table = 'department';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('name'),
			'length' => array('name'=>250),
			'int' => array(),
			'number' => array(),
			'word'=> array(),
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('name'),
			'url'=>array(),
			'html'=>array()
		);
		return parent::escape($data, $escape_array, $ignore);
	}

}