<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHepatoDetailColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('patient_pad_record', function(Blueprint $table)
		{
			$table->string('hepato_detail')->after('hepato');
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
			$table->dropColumn('hepato_detail');
		});
	}

}
