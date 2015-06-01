<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class DrpRecord extends Model {

	protected $table = 'drp_records';
	
	protected $primaryKey = 'record_id';
	
	protected $guarded = [
	'record_id',
	];
	
	public function setDateRecordedAttribute($value){
		$this->attributes['date_recorded'] = convertFormDateToDBFormat($value);
	}
	
	public function getDateRecordedAttribute($value){
		return displayDateTime($value);
	}

}
