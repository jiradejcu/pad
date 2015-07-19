<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPadMedColumns extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('patient_pad_med_records', function(Blueprint $table)
		{
			$table->float('med_dose_hr')->nullable()->after('med_dose');
			$table->time('med_time_from')->nullable()->after('med_dose_hr');
			$table->time('med_time_to')->nullable()->after('med_time_from');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('patient_pad_med_records', function(Blueprint $table)
		{
			$table->dropColumn('med_dose_hr');
			$table->dropColumn('med_time_from');
			$table->dropColumn('med_time_to');
		});
	}

}
