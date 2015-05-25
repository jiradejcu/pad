<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPatientColumn2 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('patient', function(Blueprint $table)
		{
			$table->dropColumn('age');
			$table->integer('height')->unsigned()->nullable();
			$table->integer('apache_ii')->unsigned()->nullable();
			$table->string('privilege');
			$table->boolean('allergy')->nullable();
			$table->string('allergy_detail');
			$table->boolean('cancer_solid')->nullable();
			$table->string('cancer_solid_detail');
			$table->boolean('cancer_hemato')->nullable();
			$table->string('cancer_hemato_detail');
			$table->boolean('dm');
			$table->boolean('htm');
			$table->boolean('dlp');
			$table->boolean('ckd')->nullable();
			$table->string('ckd_detail');
			$table->boolean('cad')->nullable();
			$table->string('cad_detail');
			$table->boolean('af');
			$table->boolean('valvular');
			$table->boolean('cva');
			$table->boolean('seizure');
			$table->boolean('neuro')->nullable();
			$table->string('neuro_detail');
			$table->boolean('sle');
			$table->boolean('ra');
			$table->boolean('immune')->nullable();
			$table->string('immune_detail');
			$table->boolean('osteoporosis');
			$table->boolean('alzeimer');
			$table->boolean('psychi');
			$table->boolean('hypothyroid');
			$table->boolean('hyperthyroid');
			$table->boolean('asthma');
			$table->boolean('copd');
			$table->boolean('others')->nullable();
			$table->string('others_detail');
		});
		
		Schema::table('patient_admission', function(Blueprint $table)
		{
			$table->integer('age')->unsigned()->nullable()->after('HN');
			$table->string('previous_meds');
			$table->boolean('death');
			$table->boolean('septic_shock');
			$table->boolean('adrenal_shock');
			$table->boolean('hypovolemic_shock');
			$table->boolean('cardiogenic_shock');
			$table->boolean('asthma_exacerbation');
			$table->boolean('copd_exacerbation');
			$table->boolean('aki');
			$table->boolean('liver_shock');
			$table->boolean('seizure_shock');
			$table->boolean('others_active')->nullable();
			$table->string('others_active_detail');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('patient', function(Blueprint $table)
		{
			$table->integer('age')->unsigned()->nullable()->after('lastname');
			$table->dropColumn('height');
			$table->dropColumn('apache_ii');
			$table->dropColumn('privilege');
			$table->dropColumn('allergy');
			$table->dropColumn('allergy_detail');
			$table->dropColumn('cancer_solid');
			$table->dropColumn('cancer_solid_detail');
			$table->dropColumn('cancer_hemato');
			$table->dropColumn('cancer_hemato_detail');
			$table->dropColumn('dm');
			$table->dropColumn('htm');
			$table->dropColumn('dlp');
			$table->dropColumn('ckd');
			$table->dropColumn('ckd_detail');
			$table->dropColumn('cad');
			$table->dropColumn('cad_detail');
			$table->dropColumn('af');
			$table->dropColumn('valvular');
			$table->dropColumn('cva');
			$table->dropColumn('seizure');
			$table->dropColumn('neuro');
			$table->dropColumn('neuro_detail');
			$table->dropColumn('sle');
			$table->dropColumn('ra');
			$table->dropColumn('immune');
			$table->dropColumn('immune_detail');
			$table->dropColumn('osteoporosis');
			$table->dropColumn('alzeimer');
			$table->dropColumn('psychi');
			$table->dropColumn('hypothyroid');
			$table->dropColumn('hyperthyroid');
			$table->dropColumn('asthma');
			$table->dropColumn('copd');
			$table->dropColumn('others');
			$table->dropColumn('others_detail');
		});
		
		Schema::table('patient_admission', function(Blueprint $table)
		{
			$table->dropColumn('age');
			$table->dropColumn('death');
			$table->dropColumn('previous_meds');
			$table->dropColumn('septic_shock');
			$table->dropColumn('adrenal_shock');
			$table->dropColumn('hypovolemic_shock');
			$table->dropColumn('cardiogenic_shock');
			$table->dropColumn('asthma_exacerbation');
			$table->dropColumn('copd_exacerbation');
			$table->dropColumn('aki');
			$table->dropColumn('liver_shock');
			$table->dropColumn('seizure_shock');
			$table->dropColumn('others_active');
			$table->dropColumn('others_active_detail');
		});
	}

}
