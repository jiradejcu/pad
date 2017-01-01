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
				'HN'  => $row['hn'],
				'sex' => $row['gender'] == 'ชาย' ? 'm' : 'f',
			];

			$patient_admission_data = [
				'admission_id'                 => $row['an'],
				'HN'                           => $row['hn'],
				'age'                          => $row['age'],
				'hospital_admission_date_from' => $row['admit_date'],
				'hospital_admission_date_to'   => $row['discharge_date']
			];

			$patient = Patient::firstOrNew($patient_data);
			$patient->save();

			$patient_admission = PatientAdmission::firstOrNew($patient_admission_data);

			if ($row['transfer_ward_date_icu_to_others_ward'] && $patient_admission->icu_admission_date_from) {
				$patient_admission->icu_admission_date_to = $row['transfer_ward_date_icu_to_others_ward'];
				$patient_admission->icu_admission_date_from = $row['transfer_ward_date_icu_to_others_ward']->subHours($row['icu_stay_hours']);
			}

			$patient_admission->save();
		}
	}

}
