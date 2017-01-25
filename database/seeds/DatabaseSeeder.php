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
		$import_diagnosis = true;
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

		$diagnosis_under_mapping = [
			'J80'                              => 'ards',
			'J960'                             => 'arf',
			'J189'                             => 'hap',
			'J958'                             => 'vap',
			'J1[2-8]'                          => 'pneumonia',
			'A4[0-1]'                          => 'sepsis',
			'J45'                              => 'asthma',
			'J449'                             => 'copd',
			'L89'                              => 'decubitus',
			'C([0-7][0-9]|80)'                 => 'cancer_solid',
			'C(8[1-9]|9[0-6])'                 => 'cancer_hemato',
			'E(0[[8-9]|1[0-3]|78)'             => 'metabolic',
			'B20'                              => 'hiv',
			'M32'                              => 'sle',
			'F[0-9]+'                          => 'psychi',
			'G([0-5][0-9]|6[0-5]|[8-9][0-9])'  => 'neuro',
			'G7[0-3]'                          => 'neuromuscular',
			'I[0-9][0-9]'                      => 'circulatory',
			'K7[0-7]'                          => 'liver',
			'N18'                              => 'ckd',
			'S[0-9][0-9]|T([0-7][0-9]|8[0-8])' => 'injury',
			'(V|Y)[0-9][0-9]'                  => 'morbidity'
		];

		$diagnosis_active_mapping = [
			'D(5[0-9]|6[0-4])' => 'anemia',
			'D6[5-9]'          => 'coagulopathy',
			'N17'              => 'aki'
		];

		$med_mapping = [
			'PACR-I-' => 'P',
			'ESMR-I-' => 'E',
			'NIMB1I-' => 'N',
			'TRAC-I1' => 'T'
		];

		$lab_mapping = [
			'ALT'              => 'alt',
			'AST'              => 'ast',
			'Creatinine'       => 'scr',
			'pH@37'            => 'ph',
			'pCO2@37'          => 'pco2',
			'pO2@37'           => 'po2',
			'HCO3-'            => 'hco3',
			'PO2/FI'           => 'po2_fi',
			'Ca++(pH_:ACTUAL)' => 'ca',
			'MG++(pH_:ACTUAL)' => 'mg'
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
					'hospital_admission_from'      => $row['ward'],
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

		if ($import_diagnosis) {

			$diagnosis_list = Excel::load(public_path() . '/data/Diagnosis.xlsx')->get();

			foreach ($diagnosis_list as $row) {
				$patient = Patient::find($row['hn']);
				$patient_admission = PatientAdmission::find($row['an']);

				if ($patient) {
					foreach ($diagnosis_under_mapping as $key => $value) {
						if (preg_match('/' . $key . '/', $row['icd10'])) {
							$patient->$value = 1;
							$patient->save();
						}
					}
				}

				if ($patient_admission) {
					foreach ($diagnosis_active_mapping as $key => $value) {
						if (preg_match('/' . $key . '/', $row['icd10'])) {
							$patient_admission->$value = 1;
							$patient_admission->save();
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
