<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrpMastersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('drp_master', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->string('code',5);
			$table->string('description');
			$table->string('detail');
			$table->string('supplement');
			$table->primary('code');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('drp_master');
	}

}
