<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model {

	protected $table = 'medicines';
	
	protected $primaryKey = 'name';
	
	protected $guarded = [
	'name',
	];

}
