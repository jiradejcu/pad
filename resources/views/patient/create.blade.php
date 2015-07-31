@extends('app')

@section('content')
	<h1>Add Patient</h1>
	
	<hr/>
	
	{!! Form::open(['url'=>'patient']) !!}
		<div class="form-group">
			@include('form_control.checkbox', ['checkbox_name' => 'add_admission', 'label_text' => 'Also add patient admission'])
		</div>
		@include('patient.form', ['submitButtonText' => 'Add Patient'])
	{!! Form::close() !!}
	
	@include('error')
@stop

@section('footer')
	@include('form')
@stop