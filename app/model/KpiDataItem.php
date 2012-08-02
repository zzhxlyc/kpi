<?php

class KpiDataItem extends AppModel{

	public $table = 'kpi_data_item';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('kpi_data', 'kpi_table_item', 'score', 'verify', 'modified'),
			'length' => array(),
			'int' => array('kpi_data', 'kpi_table_item', 'score', 'verify', 'modified'),
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