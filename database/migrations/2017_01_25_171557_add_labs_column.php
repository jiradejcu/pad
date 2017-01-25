<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLabsColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('patient_pad_record', function(Blueprint $table)
		{
			$table->float('ph')->default(0);
			$table->float('pco2')->default(0);
			$table->float('po2')->default(0);
			$table->float('hco3')->default(0);
			$table->float('po2_fi')->default(0);
			$table->float('ca')->default(0);
			$table->float('mg')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('patient_pad_record', function(Blueprint $table)
		{
			$table->dropColumn('ph');
			$table->dropColumn('pco2');
			$table->dropColumn('po2');
			$table->dropColumn('hco3');
			$table->dropColumn('po2_fi');
			$table->dropColumn('ca');
			$table->dropColumn('mg');
		});
	}

}
