@extends('app')

@section('content')
	<h1>Edit Patient</h1>
	
	<hr/>
	
	{!! Form::model($patient, ['method' => 'PATCH', 'action'=>['PatientController@update', $patient->HN]]) !!}
		@include('patient.form', ['disableKey' => true, 'submitButtonText' => 'Update Patient'])
	{!! Form::close() !!}
	
	@include('error')
@stop

@section('footer')
	@include('form')
@stop