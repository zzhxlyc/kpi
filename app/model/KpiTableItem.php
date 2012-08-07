<?php

class KpiTableItem extends AppModel{

	public $table = 'kpi_table_item';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('name', 'kpi_table', 'type', 'weight'),
			'length' => array('name'=>250, 'desc'=>450, 'timeline'=>50, 'quality'=>250, 
								'output'=>250, 'standard'=>450),
			'int' => array('kpi_table', 'type', 'weight', 
								'datasource', 'staff', 'modified'),
			'number' => array(),
			'word'=> array(),
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('name', 'desc', 'timeline', 'quality', 'output', 'standard'),
			'url'=>array(),
			'html'=>array()
		);
		return parent::escape($data, $escape_array, $ignore);
	}

}