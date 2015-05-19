<?php
function convertEmptyToNull($value){
	return (is_null($value) || trim($value) == "" || trim($value) == "-") ? null : $value;
}

function convertFormDateToDBFormat($value){
	$date = date_create($value);
	return date_format($date, 'Y-m-d H:i:s');
}

function displayNullNumber($value){
	return is_null($value) ? "-" : $value;
}

function displayDate($value){
	$date = date_create($value);
	return date_format($date, 'd-m-Y');
}

function convertTriState($value){
	if(!isset($value))
		return 'N/A';
	else
		return !empty($value) ? 'yes' : 'no';
}
?>