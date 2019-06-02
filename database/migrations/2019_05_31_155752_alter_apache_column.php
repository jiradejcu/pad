<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterApacheColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('patient_admission', function(Blueprint $table)
		{
			$table->string('fio2')->nullable()->change();
			$table->string('ph_choice')->nullable()->after('pao2');
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
			$table->integer('fio2')->nullable()->change();
			$table->dropColumn('ph_choice');
		});
	}

}
