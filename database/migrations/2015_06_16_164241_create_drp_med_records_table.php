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
			$table->integer('drp_record_id')->unsigned();
			$table->string('med_from');
			$table->float('med_from_dose');
			$table->string('med_to');
			$table->float('med_to_dose');
				
			$table->foreign('drp_record_id')
			->references('record_id')
			->on('drp_records')
			->onDelete('cascade');
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
