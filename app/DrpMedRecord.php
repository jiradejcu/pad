<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class DrpMedRecord extends Model {

	protected $table = 'drp_med_records';
	
	protected $primaryKey = 'med_record_id';
	
	protected $guarded = [
	'med_record_id',
	];

	public $timestamps = false;

	public function drpRecord(){
		return $this->belongsTo('App\DrpRecord');
	}

}
