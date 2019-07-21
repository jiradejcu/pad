<?php
define('DISPLAY_DATE_FORMAT', 'd-m-Y g:i A');
define('DISPLAY_TIME_FORMAT', 'g:i A');

function convertNullToEmpty($value){
	return is_null($value) ? "" : $value;
}

function convertEmptyToNull($value){
	return (is_null($value) || is_nan((float)$value) || trim($value) == "" || trim($value) == "-") ? null : $value;
}

function convertFormDateToDBFormat($value){
	return !empty($value) ? convertDateFormat($value, 'Y-m-d H:i:s') : null;
}

function convertFormTimeToDBFormat($value){
	return !empty($value) ? convertDateFormat($value, 'H:i:s') : null;
}

function displayNullNumber($value){
	return is_null($value) ? "-" : $value;
}

function displayDate($value){
	return convertDateFormat($value, 'd-m-Y');
}

function displayDateTime($value){
	return !empty($value) ? convertDateFormat($value, DISPLAY_DATE_FORMAT) : null;
}

function displayTime($value){
	return !empty($value) ? convertDateFormat($value, DISPLAY_TIME_FORMAT) : null;
}

function convertDateFormat($value, $format){
	$date = date_create($value);
	return date_format($date, $format);
}

function convertTriState($value){
	if(!isset($value))
		return 'N/A';
	else
		return !empty($value) ? 'Yes' : 'No';
}

function convertTetraState($value){
	if(!isset($value))
		return 'N/A';
	else if(!empty($value)){
		if($value == 1)
			return 'Positive';
		else if($value == -1)
			return 'Negative';
	}
	return 'Not Eval';
}