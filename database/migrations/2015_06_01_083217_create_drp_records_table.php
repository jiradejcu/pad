<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrpRecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('drp_records', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('record_id');
			$table->integer('HN')->unsigned();
			$table->string('problem');
			$table->string('cause');
			$table->string('intervention');
			$table->string('outcome');
			$table->boolean('med_recon');
			$table->integer('collected_by')->unsigned()->nullable();
			$table->integer('verified_by')->unsigned()->nullable();
			$table->timestamps();
				
			$table->foreign('HN')
			->references('HN')
			->on('patient')
			->onDelete('cascade');
		});
		

		Schema::create('drp_master', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->string('code');
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
		Schema::drop('drp_records');
		Schema::drop('drp_master');
	}

}
