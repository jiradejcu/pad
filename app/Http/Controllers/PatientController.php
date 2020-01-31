<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Patient;
use App\PatientAdmission;

class PatientController extends Controller {

	private $rules, $patientField, $patientAdmissionField;

	public function __construct() {
		$this->middleware('auth');
		$this->rules = ['firstname' => 'required', 'lastname' => 'required', 'sex' => 'required'];

		$this->patientField = [
			'HN',
			'firstname',
			'lastname',
			'sex',
			'height',
			'apache_ii',
			'privilege',
			'allergy',
			'allergy_detail',
			'cancer_solid',
			'cancer_solid_detail',
			'cancer_hemato',
			'cancer_hemato_detail',
			'dm',
			'htm',
			'dlp',
			'ckd',
			'ckd_detail',
			'cad',
			'cad_detail',
			'af',
			'valvular',
			'cva',
			'seizure',
			'neuro',
			'neuro_detail',
			'sle',
			'ra',
			'immune',
			'immune_detail',
			'osteoporosis',
			'alzeimer',
			'psychi',
			'hypothyroid',
			'hyperthyroid',
			'asthma',
			'copd',
			'cirrhosis',
			'others',
			'others_detail'
		];

		$this->patientAdmissionField = [
			'HN',
			'age',
			'type',
			'hospital_admission_date_from',
			'hospital_admission_date_to',
			'hospital_admission_from',
			'icu_admission_date_from',
			'icu_admission_date_to',
			'icu_admission_from',
			'death',
			'ett_date_from',
			'ett_date_to',
			'reason',
			'previous_meds',
			'septic_shock',
			'adrenal_shock',
			'hypovolemic_shock',
			'cardiogenic_shock',
			'asthma_exacerbation',
			'copd_exacerbation',
			'aki',
			'liver_shock',
			'seizure_shock',
			'others_active',
			'others_active_detail',
			'ugib',
			'coagulopathy',
			'anemia',
			'temperature',
			'mean_arterial_pressure',
			'heart_rate',
			'respiratory_rate',
			'fio2',
			'aapo2',
			'pao2',
			'ph_choice',
			'ph',
			'hco3',
			'serum_na',
			'serum_k',
			'creatinine',
			'hematocrit',
			'wbc',
			'glasgow_coma',
			'chronic_health_problem',
			'platelet',
			'bilirubin',
			'map_or_vaso',
			'creatinine_or_urine',
			'apache_ii_score',
			'sofa_score',
			'predicted_mortality_rate'
		];
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request) {
		$patients = DB::table('patient');
		$detail = [];
		if ($request->get('detail')) {
			$detail = explode(',', $request->get('detail'));
			if (in_array('admission', $detail) || in_array('pad', $detail) || in_array('pad_med', $detail)) {
				$patients = $patients->leftJoin('patient_admission', 'patient.HN', '=', 'patient_admission.HN');
				if (in_array('pad', $detail) || in_array('pad_med', $detail)) {
					$patients = $patients->leftJoin('patient_pad_record', 'patient_pad_record.admission_id', '=', 'patient_admission.admission_id');
					if (in_array('pad_med', $detail)) {
						$patients = $patients->leftJoin('patient_pad_med_records', 'patient_pad_record.record_id', '=', 'patient_pad_med_records.pad_record_id');
					}
				}
			}
		}
		$patientList = $patients->get();

		if ($request->get('view')) {
			if ($request->get('view') == 'table') {
				return view('patient.table', compact('patientList', 'detail'));
			}
		}

		return view('patient.index', compact('patientList'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return view('patient.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		$this->rules = array_merge(['HN' => 'required|numeric|unique:patient'], $this->rules);
		$this->validate($request, $this->rules);
		Patient::create($request->only($this->patientField));
		if ($request->get('add_admission')) {
			PatientAdmission::create($request->only($this->patientAdmissionField));
		}

		return redirect('patient');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id) {
		$patient = Patient::findOrFail($id);

		return redirect('pad/' . $patient->admissions()->first()->admission_id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id) {
		$patient = Patient::findOrFail($id);
		$patientAdmission = $patient->admissions()->first();
		$patient->fill($patientAdmission->toArray());

		return view('patient.edit', compact('patient'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function update($id, Request $request) {
		$this->validate($request, $this->rules);
		$patient = Patient::findOrFail($id);
		$patient->update($request->only($this->patientField));
		$patientAdmission = $patient->admissions()->first();
		$patientAdmission->update($request->only($this->patientAdmissionField));

		return redirect('patient');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id) {
		Patient::destroy($id);

		return [];
	}

}
