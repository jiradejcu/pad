<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMortalityRateColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('patient_admission', function(Blueprint $table)
		{
			$table->float('predicted_mortality_rate')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('patient_admission', function(Blueprint $table)
		{
			$table->dropColumn('predicted_mortality_rate');
		});
	}

}
