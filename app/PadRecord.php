<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PadRecord extends Model {

	protected $table = 'patient_pad_record';
	
	protected $primaryKey = 'record_id';

	protected $guarded = [
	'record_id',
	];

	public function patientAdmission(){
		return $this->belongsTo('App\PatientAdmission', 'admission_id');
	}
	
	public function setDateAssessedAttribute($value){
		$this->attributes['date_assessed'] = convertFormDateToDBFormat($value);
	}
	
	public function getDateAssessedAttribute($value){
		return displayDateTime($value);
	}
	
	public function setNrAttribute($value){
		$this->attributes['nr'] = convertEmptyToNull($value);
	}
	
	public function setBpsAttribute($value){
		$this->attributes['bps'] = convertEmptyToNull($value);
	}
	
	public function setRassAttribute($value){
		$this->attributes['rass'] = convertEmptyToNull($value);
	}
	
	public function setDeliriumAttribute($value){
		$this->attributes['delirium'] = convertEmptyToNull($value);
	}
}
