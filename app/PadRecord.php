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
	
	public function setAstAttribute($value){
		$this->attributes['ast'] = convertEmptyToNull($value);
	}
	
	public function setAltAttribute($value){
		$this->attributes['alt'] = convertEmptyToNull($value);
	}
	
	public function setTbAttribute($value){
		$this->attributes['tb'] = convertEmptyToNull($value);
	}
	
	public function setDbAttribute($value){
		$this->attributes['db'] = convertEmptyToNull($value);
	}
	
	public function setAlbuminAttribute($value){
		$this->attributes['albumin'] = convertEmptyToNull($value);
	}
	
	public function setBunAttribute($value){
		$this->attributes['bun'] = convertEmptyToNull($value);
	}
	
	public function setScrAttribute($value){
		$this->attributes['scr'] = convertEmptyToNull($value);
	}
	
	public function setIAttribute($value){
		$this->attributes['i'] = convertEmptyToNull($value);
	}
	
	public function setUrineAttribute($value){
		$this->attributes['urine'] = convertEmptyToNull($value);
	}

	public function padMedRecords() {
		return $this->hasMany('App\PadMedRecord');
	}
}
