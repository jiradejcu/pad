<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRemarkColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('drp_med_records', function(Blueprint $table)
		{
			$table->string('med_remark')->after('med_to_dose');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('drp_med_records', function(Blueprint $table)
		{
			$table->dropColumn('med_remark');
		});
	}

}
