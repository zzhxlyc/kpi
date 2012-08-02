<?php

class KpiData extends AppModel{

	public $table = 'kpi_data';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('name', 'type', 'kpi_table', 'depart', 'manager', 'score'),
			'length' => array('name'=>250),
			'int' => array('type', 'kpi_table', 'depart', 'manager', 'score'),
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