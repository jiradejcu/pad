<?php
function convertEmptyToNull($value){
	return (is_null($value) || trim($value) == "" || trim($value) == "-") ? null : $value;
}

function convertFormDateToDBFormat($value){
	return convertDateFormat($value, 'Y-m-d H:i:s');
}

function displayNullNumber($value){
	return is_null($value) ? "-" : $value;
}

function displayDate($value){
	return convertDateFormat($value, 'd-m-Y');
}

function displayDateTime($value){
	return convertDateFormat($value, 'd-m-Y g:i A');
}

function convertDateFormat($value, $format){
	$date = date_create($value);
	return date_format($date, $format);
}

function convertTriState($value){
	if(!isset($value))
		return 'N/A';
	else
		return !empty($value) ? 'yes' : 'no';
}
?>