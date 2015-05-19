<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model {

	protected $table = 'patient';
	
	protected $primaryKey = 'HN';

	protected $guarded = [];

	public $timestamps = false;

	public function admissions() {
		return $this->hasMany('App\PatientAdmission', 'HN');
	}
	
	public function setAgeAttribute($value){
		$this->attributes['age'] = convertEmptyToNull($value);
	}
}
