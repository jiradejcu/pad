<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientAdmissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('patient_admission', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('admission_id');
			$table->integer('HN')->unsigned();
			$table->date('date');
				
			$table->foreign('HN')
			->references('HN')
			->on('patient')
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
		Schema::drop('patient_admission');
	}

}
