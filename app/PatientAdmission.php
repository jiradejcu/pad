<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientAdmission extends Model {

	protected $table = 'patient_admission';

	protected $primaryKey = 'admission_id';

	protected $guarded = [];

	public $timestamps = false;

	public function patient(){
		return $this->belongsTo('App\Patient', 'HN');
	}
	
	public function padRecords(){
		return $this->hasMany('App\PadRecord', 'admission_id');
	}
	
	public function setHospitalAdmissionDateFromAttribute($value){
		$this->attributes['hospital_admission_date_from'] = convertFormDateToDBFormat($value);
	}
	
	public function setHospitalAdmissionDateToAttribute($value){
		$this->attributes['hospital_admission_date_to'] = convertFormDateToDBFormat($value);
	}
	
	public function setIcuAdmissionDateFromAttribute($value){
		$this->attributes['icu_admission_date_from'] = convertFormDateToDBFormat($value);
	}
	
	public function setIcuAdmissionDateToAttribute($value){
		$this->attributes['icu_admission_date_to'] = convertFormDateToDBFormat($value);
	}
}
