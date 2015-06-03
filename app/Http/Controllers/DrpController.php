<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\DrpRecord;
use App\Patient;

use Illuminate\Http\Request;
use App\DrpMaster;

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
		$problem_master = $this->getDrpMaster('P');
		$cause_master = $this->getDrpMaster('C');
		$intervention_master = $this->getDrpMaster('I');
		$outcome_master = $this->getDrpMaster('O');
		return view('drp.create', compact('problem_master', 'cause_master', 'intervention_master', 'outcome_master'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$fallbackFields = ['problem', 'cause', 'intervention', 'outcome'];
		$data = $request->all();
		foreach($fallbackFields as $field){
			if(empty($data[$field]))
				$data[$field] = $data[$field.'_main'];
			unset($data[$field.'_main']);
		}
		
		DrpRecord::create($data);
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

}
