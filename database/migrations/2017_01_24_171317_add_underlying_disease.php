<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUnderlyingDisease extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('patient', function(Blueprint $table)
		{
			$table->boolean('ards');
			$table->boolean('arf');
			$table->boolean('hap');
			$table->boolean('vap');
			$table->boolean('pneumonia');
			$table->boolean('sepsis');
			$table->boolean('decubitus');
			$table->boolean('metabolic');
			$table->boolean('hiv');
			$table->boolean('neuromuscular');
			$table->boolean('circulatory');
			$table->boolean('liver');
			$table->boolean('injury');
			$table->boolean('morbidity');
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
			$table->dropColumn('ards');
			$table->dropColumn('arf');
			$table->dropColumn('hap');
			$table->dropColumn('vap');
			$table->dropColumn('pneumonia');
			$table->dropColumn('sepsis');
			$table->dropColumn('decubitus');
			$table->dropColumn('metabolic');
			$table->dropColumn('hiv');
			$table->dropColumn('neuromuscular');
			$table->dropColumn('circulatory');
			$table->dropColumn('liver');
			$table->dropColumn('injury');
			$table->dropColumn('morbidity');
		});
	}

}
