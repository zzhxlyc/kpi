<?php

class KpiItemType {

	const JINGJI = 1;
	const GUANLI = 2;
	const ZHICHI = 3;
	const FOUJUE = 4;
	
	public static function to_string($type){
		if($type == self::JINGJI){
			return '经济';
		}
		else if($type == self::GUANLI){
			return '管理';
		}
		else if($type == self::ZHICHI){
			return '管理支持';
		}
		else if($type == self::FOUJUE){
			return '否决指标';
		}
	}
	
}