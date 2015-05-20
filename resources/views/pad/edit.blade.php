@extends('app')

@section('content')
	<h1>Edit PAD Record</h1>
	
	<hr/>
	
	{!! Form::model($padRecord, ['method' => 'PATCH', 'action'=>['PadController@update', $padRecord->record_id]]) !!}
		@include('pad.form', ['submitButtonText' => 'Update Record'])
	{!! Form::close() !!}
	
	@include('error')
@stop

@section('footer')
	@include('form')
@stop