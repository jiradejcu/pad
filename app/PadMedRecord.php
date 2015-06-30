<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PadMedRecord extends Model {

	protected $table = 'patient_pad_med_records';
	
	protected $primaryKey = 'med_record_id';

	protected $guarded = [
	'med_record_id',
	];

	public $timestamps = false;

	public function padRecord(){
		return $this->belongsTo('App\PadRecord');
	}

}
