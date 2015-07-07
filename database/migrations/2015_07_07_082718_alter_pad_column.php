<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPadColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('patient_pad_record', function(Blueprint $table)
		{
			$table->float('bw')->nullable()->change();
			$table->float('tb')->nullable()->change();
			$table->float('db')->nullable()->change();
			$table->float('albumin')->nullable()->change();
			$table->float('scr')->nullable()->change();
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
			$table->integer('bw')->nullable()->change();
			$table->integer('tb')->nullable()->change();
			$table->integer('db')->nullable()->change();
			$table->integer('albumin')->nullable()->change();
			$table->integer('scr')->nullable()->change();
		});
	}

}
