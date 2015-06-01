<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class DrpMaster extends Model {

	protected $table = 'drp_master';
	
	protected $primaryKey = 'code';

	public function scopeProblemMaster($query)
	{
		return $query->where('code', 'like', 'P%');
	}
}
