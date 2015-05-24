<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Patient;
use App\PatientAdmission;
use Carbon\Carbon;

class PatientController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$patientList = Patient::all();
		return view('patient.index', compact('patientList'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('patient.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$rules = ['HN' => 'required|numeric|unique:patient', 'firstname' => 'required', 'lastname' => 'required'];
		$this->validate($request, $rules);
		Patient::create($request->only(['HN', 'firstname', 'lastname', 'allergy', 'allergy_detail']));
		$patientAdmissionField = ['HN', 'age', 'type', 'hospital_admission_date_from', 'hospital_admission_date_to', 'hospital_admission_from'];
		$patientAdmissionField = array_merge($patientAdmissionField, ['icu_admission_date_from', 'icu_admission_date_to', 'icu_admission_from']);
		$patientAdmissionField = array_merge($patientAdmissionField, ['ett_date_from', 'ett_date_to', 'reason']);
		$patientAdmission = PatientAdmission::create($request->only($patientAdmissionField));
		return redirect('patient');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$patient = Patient::findOrFail($id);
		return redirect('pad/'.$patient->admissions()->first()->admission_id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Patient::destroy($id);
		return [];
	}

}
