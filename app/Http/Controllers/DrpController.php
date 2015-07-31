<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\DrpRecord;
use App\Patient;
use App\Medicine;

use Illuminate\Http\Request;
use App\DrpMaster;
use App\DrpMedRecord;

class DrpController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$drpRecordList = DrpRecord::all();
		return view('drp.index', compact('drpRecordList'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$ward_master = $this->getWardMaster();
		$problem_master = $this->getDrpMaster('P');
		$cause_master = $this->getDrpMaster('C');
		$intervention_master = $this->getDrpMaster('I');
		$outcome_master = $this->getDrpMaster('O');
		$medicines = Medicine::lists('name', 'name');
		return view('drp.create', compact('ward_master', 'problem_master', 'cause_master', 'intervention_master', 'outcome_master', 'medicines'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$fallbackFields = ['problem', 'cause', 'intervention', 'outcome'];
		$data = $request->except(['drpMedRecords']);
		foreach($fallbackFields as $field){
			if(empty($data[$field]))
				$data[$field] = $data[$field.'_main'];
			unset($data[$field.'_main']);
		}

		$drpRecord = DrpRecord::create($data);

		$drpMedRecords = $request->only(['drpMedRecords']);
		if(is_array($drpMedRecords['drpMedRecords'])){
			foreach($drpMedRecords['drpMedRecords'] as $drpMedRecord){
				$drpMedRecord['drp_record_id'] = $drpRecord->record_id;
				DrpMedRecord::create($drpMedRecord);
			}
		}

		return redirect('drp');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
		DrpRecord::destroy($id);
		return [];
	}

	public function getDrpMaster($code)
	{
		$masters = DrpMaster::master($code)->get();
		$results = [];
		foreach($masters as $master){
			$results[$master->code] = $master->code . ' : ' . $master->description;
		}
		return $results;
	}
	
	public function getWardMaster(){
		return ['9IC'=>'9IC', '4IT'=>'4IT', '8IK'=>'8IK', 'CVT'=>'CVT'];
	}

}
