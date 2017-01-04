<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMedicinesColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('medicines', function(Blueprint $table)
		{
			$table->string('trade_name')->default('');
			$table->string('format')->default('');
			$table->string('unit')->default('');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('medicines', function(Blueprint $table)
		{
			$table->dropColumn('trade_name');
			$table->dropColumn('format');
			$table->dropColumn('unit');
		});
	}

}
