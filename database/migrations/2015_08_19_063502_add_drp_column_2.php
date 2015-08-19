<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDrpColumn2 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::table('drp_records', function(Blueprint $table)
        {
            $table->boolean('intervene')->after('med_recon');
            $table->string('intervene_detail')->after('intervene');
            $table->boolean('intervention_accepted')->after('intervene_detail');
            $table->string('intervention_accepted_detail')->after('intervention_accepted');
            $table->boolean('intervene_to_physician')->after('intervention_accepted_detail');
            $table->boolean('intervene_to_nurse')->after('intervene_to_physician');
            $table->boolean('intervene_to_other')->after('intervene_to_nurse');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('drp_records', function(Blueprint $table)
        {
            $table->dropColumn('intervene');
            $table->dropColumn('intervene_detail');
            $table->dropColumn('intervention_accepted');
            $table->dropColumn('intervention_accepted_detail');
            $table->dropColumn('intervene_to_physician');
            $table->dropColumn('intervene_to_nurse');
            $table->dropColumn('intervene_to_other');
        });
    }

}
