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
			$table->dropColumn('hr');
			$table->boolean('anxiety')->nullable()->change();

			$table->integer('ast')->nullable()->change();
			$table->integer('alt')->nullable()->change();
			$table->integer('tb')->nullable()->change();
			$table->integer('db')->nullable()->change();
			$table->integer('bun')->nullable()->change();
			$table->integer('scr')->nullable()->change();
			$table->integer('i')->nullable()->change();
			$table->integer('urine')->nullable()->change();

			$table->integer('albumin')->nullable()->after('db');
			$table->boolean('hepato')->after('drug_interact');
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
			$table->integer('hr')->default(0)->after('bp_l');
			$table->dropColumn('albumin');
			$table->dropColumn('hepato');
			$table->dropColumn('cholestasis');
			$table->dropColumn('liver_disease');
			$table->dropColumn('hd');
			$table->dropColumn('renal_impairment');
		});
	}

}
