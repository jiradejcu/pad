<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddApacheInputColumns extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('patient_admission', function(Blueprint $table)
		{
			$table->float('temperature')->nullable();
			$table->integer('mean_arterial_pressure')->nullable();
			$table->integer('heart_rate')->nullable();
			$table->integer('respiratory_rate')->nullable();
			$table->integer('fio2')->nullable();
			$table->integer('aapo2')->nullable();
			$table->integer('pao2')->nullable();
			$table->float('ph')->nullable();
			$table->float('hco3')->nullable();
			$table->integer('serum_na')->nullable();
			$table->float('serum_k')->nullable();
			$table->float('creatinine')->nullable(); //acute renal failure => AKI
			$table->float('hematocrit')->nullable();
			$table->float('wbc')->nullable();
			$table->integer('glasgow_coma')->nullable();
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
			$table->dropColumn('temperature');
			$table->dropColumn('mean_arterial_pressure');
			$table->dropColumn('heart_rate');
			$table->dropColumn('respiratory_rate');
			$table->dropColumn('fio2');
			$table->dropColumn('aapo2');
			$table->dropColumn('pao2');
			$table->dropColumn('ph');
			$table->dropColumn('hco3');
			$table->dropColumn('serum_na');
			$table->dropColumn('serum_k');
			$table->dropColumn('creatinine');
			$table->dropColumn('hematocrit');
			$table->dropColumn('wbc');
			$table->dropColumn('glasgow_coma');
		});
	}

}
