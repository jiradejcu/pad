<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPadColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{		
		Schema::table('patient_pad_record', function(Blueprint $table)
		{
			$table->boolean('anxiety')->nullable()->change();
			$table->boolean('hr')->after('drug_interact')->change();
			$table->boolean('hepato')->after('hr');
			$table->boolean('cholestasis')->after('hepato');
			$table->boolean('liver_disease')->after('cholestasis');
			$table->boolean('hd')->after('stool');
			$table->string('renal_impairment')->after('liver_disease');
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
			$table->integer('hr')->default(0)->after('bp_l')->change();
			$table->dropColumn('hepato');
			$table->dropColumn('cholestasis');
			$table->dropColumn('liver_disease');
			$table->dropColumn('hd');
			$table->dropColumn('renal_impairment');
		});
	}

}
