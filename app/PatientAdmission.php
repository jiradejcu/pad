<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientAdmission extends Model {

	protected $table = 'patient_admission';

	protected $fillable = [
	'admission_id',
	'HN',
	'date',
	];

	public $timestamps = false;

	public function patient(){
		return $this->belongsTo('App\Patient');
	}
	
	public function padRecords(){
		return $this->hasMany('App\PadRecord');
	}
}
