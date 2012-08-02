<?php

class DSData extends AppModel{

	public $table = 'ds_data';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('datasource', 'data', 'depart'),
			'length' => array(),
			'int' => array('datasource', 'data', 'depart'),
			'number' => array(),
			'word'=> array(),
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array(),
			'url'=>array(),
			'html'=>array()
		);
		return parent::escape($data, $escape_array, $ignore);
	}

}