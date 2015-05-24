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
	
	public function setHeightAttribute($value){
		$this->attributes['height'] = convertEmptyToNull($value);
	}
	
	public function setApacheIiAttribute($value){
		$this->attributes['apache_ii'] = convertEmptyToNull($value);
	}
}
