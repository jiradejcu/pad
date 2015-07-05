<?php namespace App\Http\Controllers;

use App\Http\Requests\PadRequest;
use App\Http\Controllers\Controller;
use App\PadRecord;
use App\PadMedRecord;
use App\PatientAdmission;
use App\Medicine;
use Carbon\Carbon;

class PadController extends Controller {

	private function getPadRecord($admission_id = null)
	{
		$result = [];
		if(!empty($admission_id)) {
			$patientAdmission = PatientAdmission::findOrFail($admission_id);
			$patientAdmissions = [$patientAdmission];
		} else {
			$patientAdmissions = PatientAdmission::oldest('admission_id')->get();
		}
		foreach($patientAdmissions as $patientAdmission){
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
	public function index()
	{
		$padRecordList = $this->getPadRecord();
		return view('pad.index', compact('padRecordList'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		$medicines = Medicine::lists('name', 'name');
		$padRecord = new PadRecord();
		$patientAdmission = PatientAdmission::findOrFail($id);
		$padRecord->date_assessed = $patientAdmission->icu_admission_date_from;
		$previousPadRecord = $patientAdmission->padRecords->last();
		if(!empty($previousPadRecord))
			$padRecord->date_assessed = Carbon::createFromFormat(DISPLAY_DATE_FORMAT, $previousPadRecord->date_assessed)->addDay();
		
		return view('pad.create', compact('id', 'medicines', 'padRecord'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(PadRequest $request)
	{
		$data = $request->except(['padMedRecords']);
		$padRecord = PadRecord::create($data);

		$padMedRecords = $request->only(['padMedRecords']);
		if(is_array($padMedRecords['padMedRecords'])){
			foreach($padMedRecords['padMedRecords'] as $padMedRecord){
				$padMedRecord['pad_record_id'] = $padRecord->record_id;
				PadMedRecord::create($padMedRecord);
			}
		}
		return redirect('pad/'.$request->admission_id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$padRecordList = $this->getPadRecord($id);
		return view('pad.index', compact('padRecordList'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$padRecord = PadRecord::findOrFail($id);
		$medicines = Medicine::lists('name', 'name');
		return view('pad.edit', compact('padRecord', 'medicines'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, PadRequest $request)
	{
		$padRecord = PadRecord::findOrFail($id);

		$padRecord->padMedRecords()->delete();

		$data = $request->except(['padMedRecords']);
		$padRecord->update($data);

		$padMedRecords = $request->only(['padMedRecords']);
		if(is_array($padMedRecords['padMedRecords'])){
			foreach($padMedRecords['padMedRecords'] as $padMedRecord){
				$padMedRecord['pad_record_id'] = $padRecord->record_id;
				PadMedRecord::create($padMedRecord);
			}
		}

		return redirect('pad/'.$padRecord->admission_id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		PadRecord::destroy($id);
		return [];
	}

}
