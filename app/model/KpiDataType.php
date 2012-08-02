<?php

class KpiDataType {

	const MONTH = 1;
	const SEASON = 2;
	const HALFYEAR = 3;
	const YEAR = 4;
	
	public static function to_string($type){
		if($type == self::MONTH){
			return '月度';
		}
		else if($type == self::SEASON){
			return '季度';
		}
		else if($type == self::HALFYEAR){
			return '半年度';
		}
		else if($type == self::YEAR){
			return '年度';
		}
	}

}