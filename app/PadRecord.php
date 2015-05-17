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
}
