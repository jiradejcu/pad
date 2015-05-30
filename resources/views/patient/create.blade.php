@extends('app')

@section('content')
	<h1>Add Patient</h1>
	
	<hr/>
	
	{!! Form::open(['url'=>'patient']) !!}
		@include('patient.form', ['submitButtonText' => 'Add Patient'])
	{!! Form::close() !!}
	
	@include('error')
@stop

@section('footer')
	@include('form')
@stop