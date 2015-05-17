<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PadRecord extends Model {

	protected $table = 'patient_pad_record';

	protected $guarded = [
	'record_id',
	];

	public function patientAdmission(){
		return $this->belongsTo('App\PatientAdmission', 'admission_id');
	}
	
	public function setNrAttribute($value){
		$this->attributes['nr'] = self::convertEmptyToNull($value);
	}
	
	public function setBpsAttribute($value){
		$this->attributes['bps'] = self::convertEmptyToNull($value);
	}
	
	public function setRassAttribute($value){
		$this->attributes['rass'] = self::convertEmptyToNull($value);
	}
	
	private static function convertEmptyToNull($value){
		return (is_null($value) || $value == "") ? null : $value;
	}
	
	public static function displayDate($value){
		$date = date_create($value);
		return date_format($date, 'd-m-Y');
	}
	
	public static function convertTriState($value){
		if(!isset($value))
			return 'N/A';
		else
			return !empty($value) ? 'yes' : 'no';
	}
}
