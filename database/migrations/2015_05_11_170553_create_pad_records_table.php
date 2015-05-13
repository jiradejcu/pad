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
			$table->integer('admission_id');
			$table->integer('day');
			$table->string('data1');
			$table->timestamps();
			$table->primary(['admission_id','day']);
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
