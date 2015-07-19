<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PadMedRecord extends Model {

	protected $table = 'patient_pad_med_records';
	
	protected $primaryKey = 'med_record_id';

	protected $guarded = [
	'med_record_id',
	];

	public $timestamps = false;
	
	public function setMedDoseAttribute($value){
		$this->attributes['med_dose'] = convertEmptyToNull($value);
	}
	
	public function setMedDoseHrAttribute($value){
		$this->attributes['med_dose_hr'] = convertEmptyToNull($value);
	}
	
	public function setMedTimeFromAttribute($value){
		$this->attributes['med_time_from'] = convertFormTimeToDBFormat($value);
	}
	
	public function getMedTimeFromAttribute($value){
		return displayTime($value);
	}
	
	public function setMedTimeToAttribute($value){
		$this->attributes['med_time_to'] = convertFormTimeToDBFormat($value);
	}
	
	public function getMedTimeToAttribute($value){
		return displayTime($value);
	}

	public function padRecord(){
		return $this->belongsTo('App\PadRecord');
	}

}
