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

	public function getAnxietyAttribute($value){
		return self::convertTriState($value);
	}

	public function getDeliriumAttribute($value){
		return self::convertTriState($value);
	}

	public function getDrugInteractAttribute($value){
		return self::convertTriState($value);
	}
	
	private static function convertTriState($value){
		if(!isset($value))
			return 'N/A';
		else
			return !empty($value) ? 'yes' : 'no';
	}
}
