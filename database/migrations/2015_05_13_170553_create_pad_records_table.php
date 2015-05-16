<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePadRecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('patient_pad_record', function(Blueprint $table)
		{
			$table->increments('record_id');
			$table->integer('admission_id')->unsigned();
			$table->integer('day')->unsigned();
			$table->string('data1');
			$table->timestamps();
			
			$table->foreign('admission_id')
			->references('admission_id')
			->on('patient_admission')
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
		Schema::drop('patient_pad_record');
	}

}
