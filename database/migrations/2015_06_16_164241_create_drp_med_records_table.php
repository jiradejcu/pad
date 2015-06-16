<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrpMedRecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('drp_med_records', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('med_record_id');
			$table->string('med_from');
			$table->float('med_from_dose');
			$table->string('med_to');
			$table->float('med_to_dose');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('drp_med_records');
	}

}
