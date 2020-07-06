<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMonitorPadColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('patient_pad_record', function(Blueprint $table)
		{
			$table->boolean('mechanical_ventilator');
			$table->string('mechanical_ventilator_detail');
			$table->boolean('sufficient_light');
			$table->boolean('night_light_off');
			$table->boolean('blindfold');
			$table->boolean('earplug');
			$table->boolean('reorentation');
			$table->boolean('family_participation');
			$table->boolean('early_ambulate');
			$table->boolean('rom');
			$table->boolean('stand_assist');
			$table->boolean('bed_side_chair');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('patient_pad_record', function(Blueprint $table)
		{
			$table->dropColumn('mechanical_ventilator');
			$table->dropColumn('mechanical_ventilator_detail');
			$table->dropColumn('sufficient_light');
			$table->dropColumn('night_light_off');
			$table->dropColumn('blindfold');
			$table->dropColumn('earplug');
			$table->dropColumn('reorentation');
			$table->dropColumn('family_participation');
			$table->dropColumn('early_ambulate');
			$table->dropColumn('rom');
			$table->dropColumn('stand_assist');
			$table->dropColumn('bed_side_chair');
		});
	}

}
