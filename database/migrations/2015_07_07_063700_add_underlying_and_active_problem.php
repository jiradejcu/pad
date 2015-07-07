<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUnderlyingAndActiveProblem extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('patient', function(Blueprint $table)
		{
			$table->boolean('cirrhosis')->after('copd');
		});
		
		Schema::table('patient_admission', function(Blueprint $table)
		{
			$table->boolean('ugib')->after('seizure_shock');
			$table->boolean('coagulopathy')->after('ugib');
			$table->boolean('anemia')->after('coagulopathy');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('patient', function(Blueprint $table)
		{
			$table->dropColumn('cirrhosis');
		});
		
		Schema::table('patient_admission', function(Blueprint $table)
		{
			$table->dropColumn('ugib');
			$table->dropColumn('coagulopathy');
			$table->dropColumn('anemia');
		});
	}

}
