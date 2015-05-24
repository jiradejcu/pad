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
			$table->dropColumn('age');
			$table->boolean('allergy')->nullable();
			$table->string('allergy_detail');
		});
		
		Schema::table('patient_admission', function(Blueprint $table)
		{
			$table->integer('age')->unsigned()->nullable()->after('HN');
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
			$table->integer('age')->unsigned()->nullable()->after('lastname');
			$table->dropColumn('allergy');
			$table->dropColumn('allergy_detail');
		});
		
		Schema::table('patient_admission', function(Blueprint $table)
		{
			$table->dropColumn('age');
		});
	}

}
