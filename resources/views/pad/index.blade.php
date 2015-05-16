@extends('app')

@section('content')
	<h1>PAD Record List</h1>
	@forelse ($padRecordList as $admission_id => $padRecords)
	<h2>HN : {{ $padRecords['admission']->patient->HN }}</h2>
	
	@forelse ($padRecords['padRecord'] as $padRecord)
	Day {{ $padRecord->day }} : Data1 -> {{ $padRecord->data1 }} <br>
	@empty
    <p>No record</p>
	@endforelse
	<hr>
	<a href="{{ url('/pad/'.$admission_id.'/create') }}" tabindex="1">Add</a>
	@empty
	    <p>No record</p>
	@endforelse	
@stop