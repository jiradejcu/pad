<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPadMedColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('patient_pad_med_records', function(Blueprint $table)
		{
			$table->float('med_dose')->nullable()->change();
			$table->boolean('bp_drop');
			$table->boolean('slow_hr');
			$table->boolean('constipation');
			$table->boolean('prolong_sedation');
			$table->string('remark');
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
			$table->dropColumn('bp_drop');
			$table->dropColumn('slow_hr');
			$table->dropColumn('constipation');
			$table->dropColumn('prolong_sedation');
			$table->dropColumn('remark');
		});
	}

}
