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
			$table->integer('nr')->nullable();
			$table->integer('bps')->nullable();
			$table->integer('rass')->nullable();
			$table->boolean('anxiety');
			$table->boolean('delirium')->nullable();
			$table->integer('fio2')->default(0);
			$table->integer('peep')->default(0);
			$table->integer('rr')->default(0);
			$table->integer('bp_h')->default(0);
			$table->integer('bp_l')->default(0);
			$table->integer('hr')->default(0);
			$table->integer('o2sat')->default(0);
			$table->integer('ast')->default(0);
			$table->integer('alt')->default(0);
			$table->integer('alp')->default(0);
			$table->integer('ggt')->default(0);
			$table->integer('tb')->default(0);
			$table->integer('db')->default(0);
			$table->integer('bun')->default(0);
			$table->integer('scr')->default(0);
			$table->integer('i')->default(0);
			$table->integer('o')->default(0);
			$table->integer('urine')->default(0);
			$table->integer('stool')->default(0);
			$table->string('hd_mode')->default('');
			$table->boolean('drug_interact');
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
