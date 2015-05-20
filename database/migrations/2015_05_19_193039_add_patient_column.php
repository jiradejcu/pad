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
			$table->integer('age')->unsigned()->nullable()->after('lastname');
		});
		
		Schema::table('patient_admission', function(Blueprint $table)
		{
			$table->dropColumn('date');
			$table->string('type');
			$table->dateTime('hospital_admission_date_from');
			$table->dateTime('hospital_admission_date_to');
			$table->string('hospital_admission_from');
			$table->dateTime('icu_admission_date_from');
			$table->dateTime('icu_admission_date_to');
			$table->string('icu_admission_from');
			$table->dateTime('ett_date_from');
			$table->dateTime('ett_date_to');
			$table->string('reason');
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
			$table->dropColumn('type');
			$table->dropColumn('hospital_admission_date_from');
			$table->dropColumn('hospital_admission_date_to');
			$table->dropColumn('hospital_admission_from');
			$table->dropColumn('icu_admission_date_from');
			$table->dropColumn('icu_admission_date_to');
			$table->dropColumn('icu_admission_from');
			$table->dropColumn('ett_date_from');
			$table->dropColumn('ett_date_to');
			$table->dropColumn('reason');
			$table->date('date')->after('HN');
		});
	}

}
