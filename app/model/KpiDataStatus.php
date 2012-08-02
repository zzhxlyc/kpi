<?php

class KpiDataStatus {

	const OPEN = 1;
	const SUBMIT = 2;
	const PASS = 3;
	const MODIFY = 4;
	const CLOSED = 5;
	
	public static function to_string($type){
		if($type == self::OPEN){
			return '进行中';
		}
		else if($type == self::SUBMIT){
			return '已提交';
		}
		else if($type == self::PASS){
			return '已通过';
		}
		else if($type == self::MODIFY){
			return '需修改';
		}
		else if($type == self::CLOSED){
			return '已关闭';
		}
	}
	
}