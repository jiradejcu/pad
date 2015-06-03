<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class DrpMaster extends Model {

	protected $table = 'drp_master';
	
	protected $primaryKey = 'code';

	public function scopeMaster($query, $code)
	{
		$codeLength = " and length(code) ";
		$codeLength .= strlen($code) == 1 ? "= 2" : "> 2";
		return $query->whereRaw("code like '".$code."%'" . $codeLength);
	}
}
