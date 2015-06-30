<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePadMedRecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('patient_pad_med_records', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('med_record_id');
			$table->integer('pad_record_id')->unsigned();
			$table->string('med_name');
			$table->string('med_channel');
			$table->float('med_dose');
				
			$table->foreign('pad_record_id')
			->references('record_id')
			->on('patient_pad_record')
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
		Schema::drop('patient_pad_med_records');
	}

}
