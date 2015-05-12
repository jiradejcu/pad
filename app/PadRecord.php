<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PadRecord extends Model {

	protected $table = 'patient_pad_record';
	
	protected $fillable = [
		'admission_id',
		'day',
		'data1',
	];

	public $timestamps = false;
	
}