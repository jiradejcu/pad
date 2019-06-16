<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LoosenPatientAdmissionColumnRestriction extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('patient_admission', function(Blueprint $table)
		{
			$table->dateTime('hospital_admission_date_from')->nullable()->change();
			$table->dateTime('hospital_admission_date_to')->nullable()->change();
			$table->dateTime('ett_date_from')->nullable()->change();
			$table->dateTime('ett_date_to')->nullable()->change();
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
			$table->dateTime('hospital_admission_date_from')->change();
			$table->dateTime('hospital_admission_date_to')->change();
			$table->dateTime('ett_date_from')->change();
			$table->dateTime('ett_date_to')->change();
		});
	}

}
