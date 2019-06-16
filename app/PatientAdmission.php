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
		return $this->hasMany('App\PadRecord', 'admission_id')->orderBy('date_assessed');
	}

	public function setAgeAttribute($value){
		$this->attributes['age'] = convertEmptyToNull($value);
	}

	public function setTypeAttribute($value){
		$this->attributes['type'] = convertNullToEmpty($value);
	}
	
	public function setHospitalAdmissionDateFromAttribute($value){
		$this->attributes['hospital_admission_date_from'] = convertFormDateToDBFormat($value);
	}
	
	public function getHospitalAdmissionDateFromAttribute($value){
		return displayDateTime($value);
	}
	
	public function setHospitalAdmissionDateToAttribute($value){
		$this->attributes['hospital_admission_date_to'] = convertFormDateToDBFormat($value);
	}
	
	public function getHospitalAdmissionDateToAttribute($value){
		return displayDateTime($value);
	}

	public function setHospitalAdmissionFromAttribute($value){
		$this->attributes['hospital_admission_from'] = convertNullToEmpty($value);
	}
	
	public function setIcuAdmissionDateFromAttribute($value){
		$this->attributes['icu_admission_date_from'] = convertFormDateToDBFormat($value);
	}
	
	public function getIcuAdmissionDateFromAttribute($value){
		return displayDateTime($value);
	}
	
	public function setIcuAdmissionDateToAttribute($value){
		$this->attributes['icu_admission_date_to'] = convertFormDateToDBFormat($value);
	}
	
	public function getIcuAdmissionDateToAttribute($value){
		return displayDateTime($value);
	}
	
	public function setEttDateFromAttribute($value){
		$this->attributes['ett_date_from'] = convertFormDateToDBFormat($value);
	}
	
	public function getEttDateFromAttribute($value){
		return displayDateTime($value);
	}
	
	public function setEttDateToAttribute($value){
		$this->attributes['ett_date_to'] = convertFormDateToDBFormat($value);
	}
	
	public function getEttDateToAttribute($value){
		return displayDateTime($value);
	}

	public function setTemperatureAttribute($value){
		$this->attributes['temperature'] = convertEmptyToNull($value);
	}

	public function setMeanArterialPressureAttribute($value){
		$this->attributes['mean_arterial_pressure'] = convertEmptyToNull($value);
	}

	public function setHeartRateAttribute($value){
		$this->attributes['heart_rate'] = convertEmptyToNull($value);
	}

	public function setRespiratoryRateAttribute($value){
		$this->attributes['respiratory_rate'] = convertEmptyToNull($value);
	}

	public function setFio2Attribute($value){
		$this->attributes['fio2'] = convertEmptyToNull($value);
	}

	public function setAapo2Attribute($value){
		$this->attributes['aapo2'] = convertEmptyToNull($value);
	}

	public function setPao2Attribute($value){
		$this->attributes['pao2'] = convertEmptyToNull($value);
	}

	public function setPhAttribute($value){
		$this->attributes['ph'] = convertEmptyToNull($value);
	}

	public function setHco3Attribute($value){
		$this->attributes['hco3'] = convertEmptyToNull($value);
	}

	public function setSerumNaAttribute($value){
		$this->attributes['serum_na'] = convertEmptyToNull($value);
	}

	public function setSerumKAttribute($value){
		$this->attributes['serum_k'] = convertEmptyToNull($value);
	}

	public function setCreatinineAttribute($value){
		$this->attributes['creatinine'] = convertEmptyToNull($value);
	}

	public function setHematocritAttribute($value){
		$this->attributes['hematocrit'] = convertEmptyToNull($value);
	}

	public function setWbcAttribute($value){
		$this->attributes['wbc'] = convertEmptyToNull($value);
	}

	public function setGlasgowComaAttribute($value){
		$this->attributes['glasgow_coma'] = convertEmptyToNull($value);
	}

	public function setPlateletAttribute($value){
		$this->attributes['platelet'] = convertEmptyToNull($value);
	}

	public function setBilirubinAttribute($value){
		$this->attributes['bilirubin'] = convertEmptyToNull($value);
	}
}
