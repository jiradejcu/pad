<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDrugInteractionDetail extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('patient_pad_record', function(Blueprint $table)
		{
			$table->string('drug_interact_detail')->after('drug_interact');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('patient_pad_record', function(Blueprint $table)
		{
			$table->dropColumn('drug_interact_detail');
		});
	}

}
