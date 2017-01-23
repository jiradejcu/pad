<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Patient;
use App\PatientAdmission;
use App\PadRecord;
use App\PadMedRecord;
use App\Medicine;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Model::unguard();

		ini_set("memory_limit", -1);

		$import_patient = true;
		$import_drug = true;
		$import_lab = true;

		DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		if ($import_drug) {
			DB::table('patient_pad_med_records')->truncate();
			DB::table('patient_pad_record')->truncate();
			DB::table('medicines')->truncate();
		}

		if ($import_patient) {
			DB::table('patient_admission')->truncate();
			DB::table('patient')->truncate();
		}

		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

		$med_mapping = [
			'MIDA-I-' => 'M',
			'DOXA2T-' => 'D'
		];

		$lab_mapping = [
			'ALT'  => 'alt',
			'AST'  => 'ast',
			'FIO2' => 'fio2'
		];

		if ($import_patient) {
			$patients = Excel::load(public_path() . '/data/Patients.xlsx')->get();

			foreach ($patients as $row) {

				$patient_data = [
					'HN'        => $row['hn'],
					'sex'       => $row['gender'] == 'ชาย' ? 'm' : 'f',
					'apache_ii' => 0
				];

				$patient_admission_data = [
					'admission_id'                 => $row['an'],
					'HN'                           => $row['hn'],
					'age'                          => $row['age'],
					'type'                         => 'unknown',
					'hospital_admission_date_from' => $row['admit_date'],
					'hospital_admission_date_to'   => $row['discharge_date'],
					'death'                        => $row['type_of_discharge'] == 'Death (ตาย)' ? 1 : 0
				];

				$patient = Patient::firstOrNew($patient_data);
				$patient->save();

				$patient_admission = PatientAdmission::firstOrNew($patient_admission_data);

				if ($row['transfer_ward_date_icu_to_others_ward']) {
					$existing_icu_stay = 0;
					if ($patient_admission->icu_admission_date_from && $patient_admission->icu_admission_date_to) {
						$icu_admission_date_from = new Carbon($patient_admission->icu_admission_date_from);
						$icu_admission_date_to = new Carbon($patient_admission->icu_admission_date_to);
						$existing_icu_stay = $icu_admission_date_from->diffInHours($icu_admission_date_to);
					}
					$patient_admission->icu_admission_date_to = $row['transfer_ward_date_icu_to_others_ward'];
					$patient_admission->icu_admission_date_from = $row['transfer_ward_date_icu_to_others_ward']->subHours($row['icu_stay_hours'] + $existing_icu_stay);
				}

				$patient_admission->save();
			}

			$files = [
				'Patients_7NW',
				'Patients_9IC'
			];

			foreach ($files as $file) {
				$apache_scores = Excel::load(public_path() . '/data/' . $file . '.xlsx')->get();

				foreach ($apache_scores as $row) {
					$patient_admission = PatientAdmission::find($row['an']);

					if (!empty($patient_admission)) {
						$patient = Patient::find($patient_admission->HN);

						if (!empty($patient)) {
							$patient->apache_ii = $row['apache'];
							$patient->save();
						}
					}
				}
			}
		}

		if ($import_drug) {

			$drugs = Excel::load(public_path() . '/data/DrugMaster.xlsx')->get();

			foreach ($drugs as $row) {
				if ($row['name'] != '-') {
					$medicine_data = [
						'name' => $row['code']
					];

					$medicine = Medicine::firstOrNew($medicine_data);
					$medicine->trade_name = $row['name'];
					$medicine->format = $row['format'];
					$medicine->unit = $row['unit'];
					$medicine->save();
				}
			}

			$drugs = Excel::load(public_path() . '/data/Drugs.xlsx')->get();

			foreach ($drugs as $row) {
				$pad_record_data = [
					'admission_id'  => $row['an'],
					'date_assessed' => $row['payment_date']->toDateString()
				];

				$pad_record = PadRecord::firstOrNew($pad_record_data);
				$pad_record->save();

				$pad_med_record_data = [
					'pad_record_id' => $pad_record->record_id,
					'med_name'      => $row['code'],
					'med_channel'   => 'bolus',
					'med_dose'      => $row['dose']
				];

				PadMedRecord::create($pad_med_record_data);

				if (array_key_exists($row['code'], $med_mapping)) {
					$patient_admission = PatientAdmission::find($row['an']);
					$patient_admission->type = $med_mapping[$row['code']];
					$patient_admission->save();
				}
			}
		}

		if ($import_lab) {
			$labs = Excel::load(public_path() . '/data/Labs.xlsx')->get();

			foreach ($labs as $row) {
				$pad_record_data = [
					'admission_id'  => $row['an'],
					'date_assessed' => $row['assess_date']->toDateString()
				];

				$pad_record = PadRecord::firstOrNew($pad_record_data);

				if (array_key_exists($row['code_test'], $lab_mapping)) {
					$pad_record[$lab_mapping[$row['code_test']]] = $row['result'];
				}

				$pad_record->save();
			}
		}
	}

}
