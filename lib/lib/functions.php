<?php

function p($text, $exit = true){
	if($exit){
		header('Content-Type: text/plain');
	}
	print_r($text);
	if($exit){
		exit;
	}
}