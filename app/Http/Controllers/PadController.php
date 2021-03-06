<?php namespace App\Http\Controllers;

use App\Http\Requests\PadRequest;
use App\PadRecord;
use App\PadMedRecord;
use App\PatientAdmission;
use App\Medicine;
use Carbon\Carbon;
use View;

class PadController extends Controller {

	private $numeric_fields = ['bw', 'ast', 'alt', 'tb', 'db', 'albumin', 'bun', 'scr', 'i', 'urine'];

	private $non_pharmaco_fields = [
		'sufficient_light'     => 'แสงสว่างเพียงพอ',
		'night_light_off'      => 'กลางคืนปิดไฟ',
		'blindfold'            => 'ใช้ผ้าปิดตา',
		'earplug'              => 'ใช้ที่อุดหู',
		'reorentation'         => 'Reorentation',
		'family_participation' => 'ญาติร่วมดูแล',
		'early_ambulate'       => 'Early Ambulate',
		'rom'                  => 'ROM',
		'stand_assist'         => 'พายืน',
		'bed_side_chair'       => 'นั่งเก้าอี้ข้างเตียง',
	];

	private $indications = [
		'Pain',
		'Sedation/Agitation',
		'Delirium',
		'Sleep Deprivation'
	];

	private function getPadRecord($admission_id = null) {
		$result = [];
		if (!empty($admission_id)) {
			$patientAdmission = PatientAdmission::findOrFail($admission_id);
			$patientAdmissions = [$patientAdmission];
		} else {
			$patientAdmissions = PatientAdmission::oldest('admission_id')->get();
		}
		foreach ($patientAdmissions as $patientAdmission) {
			$result[$patientAdmission->admission_id]['admission'] = $patientAdmission;
			$result[$patientAdmission->admission_id]['padRecord'] = $patientAdmission->padRecords()->get();
		}

		return $result;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$padRecordList = $this->getPadRecord();

		View::share('indications', $this->indications);
		View::share('non_pharmaco_fields', $this->non_pharmaco_fields);

		return view('pad.index', compact('padRecordList'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id) {
		$medicines = Medicine::lists('name', 'name');
		$padRecord = new PadRecord();
		$patientAdmission = PatientAdmission::findOrFail($id);
		$padRecord->date_assessed = $patientAdmission->icu_admission_date_from;
		$previousPadRecord = $patientAdmission->padRecords->last();
		if (!empty($previousPadRecord)) {
			$padRecord = $previousPadRecord;
			foreach ($this->numeric_fields as $field) {
				unset($padRecord->$field);
			}
			$padRecord->date_assessed = Carbon::createFromFormat(DISPLAY_DATE_FORMAT, $previousPadRecord->date_assessed)->addDay();
		}

		View::share('indications', $this->indications);
		View::share('non_pharmaco_fields', $this->non_pharmaco_fields);

		return view('pad.create', compact('id', 'medicines', 'padRecord'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(PadRequest $request) {
		$data = $request->except(['padMedRecords']);
		$padRecord = PadRecord::create($data);

		$padMedRecords = $request->only(['padMedRecords']);
		if (is_array($padMedRecords['padMedRecords'])) {
			foreach ($padMedRecords['padMedRecords'] as $padMedRecord) {
				$padMedRecord['pad_record_id'] = $padRecord->record_id;
				PadMedRecord::create($padMedRecord);
			}
		}

		return redirect('pad/' . $request->admission_id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id) {
		$padRecordList = $this->getPadRecord($id);

		View::share('indications', $this->indications);
		View::share('non_pharmaco_fields', $this->non_pharmaco_fields);

		return view('pad.index', compact('padRecordList'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id) {
		$padRecord = PadRecord::findOrFail($id);
		$medicines = Medicine::lists('name', 'name');

		View::share('indications', $this->indications);
		View::share('non_pharmaco_fields', $this->non_pharmaco_fields);

		return view('pad.edit', compact('padRecord', 'medicines'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function update($id, PadRequest $request) {
		$padRecord = PadRecord::findOrFail($id);

		$padRecord->padMedRecords()->delete();

		$data = $request->except(['padMedRecords']);
		$padRecord->update($data);

		$padMedRecords = $request->only(['padMedRecords']);
		if (is_array($padMedRecords['padMedRecords'])) {
			foreach ($padMedRecords['padMedRecords'] as $padMedRecord) {
				$padMedRecord['pad_record_id'] = $padRecord->record_id;
				PadMedRecord::create($padMedRecord);
			}
		}

		return redirect('pad/' . $padRecord->admission_id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id) {
		PadRecord::destroy($id);

		return [];
	}

}
