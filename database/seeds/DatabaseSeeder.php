<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Patient;
use App\PatientAdmission;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Model::unguard();

		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		DB::table('patient_pad_med_records')->truncate();
		DB::table('patient_pad_record')->truncate();
		DB::table('patient_admission')->truncate();
		DB::table('patient')->truncate();
		DB::table('medicines')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

		$reports = Excel::load(public_path() . '/data/Test.xlsx')->get();

		foreach ($reports as $row) {
			$patient_data = [
				'HN' => $row['hn']
			];

			$patient = Patient::firstOrNew($patient_data);
			$patient->save();
		}
	}

}
