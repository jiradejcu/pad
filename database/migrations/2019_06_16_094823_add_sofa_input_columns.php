<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSofaInputColumns extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('patient_admission', function(Blueprint $table)
		{
			$table->integer('platelet')->nullable();
			$table->float('bilirubin')->nullable();
			$table->integer('map_or_vaso')->nullable();
			$table->integer('creatinine_or_urine')->nullable();
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
			$table->dropColumn('platelet');
			$table->dropColumn('bilirubin');
			$table->dropColumn('map_or_vaso');
			$table->dropColumn('creatinine_or_urine');
		});
	}

}
