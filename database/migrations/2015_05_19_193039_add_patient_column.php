<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPatientColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('patient', function(Blueprint $table)
		{
			$table->integer('age')->unsigned()->after('lastname');
		});
		
		Schema::table('patient_admission', function(Blueprint $table)
		{
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
			$table->dropColumn('age');
		});
		
		Schema::table('patient_admission', function(Blueprint $table)
		{
		});
	}

}
