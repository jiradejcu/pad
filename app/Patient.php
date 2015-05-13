<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model {

	protected $table = 'patient';

	protected $fillable = [
	'HN',
	'firstname',
	'lastname',
	];

	public $timestamps = false;

	public function admissions() {
		return $this->hasMany('App\PatientAdmission');
	}
}
