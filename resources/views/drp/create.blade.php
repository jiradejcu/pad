@extends('app')

@section('content')
	<h1>Record DRP</h1>
	
	<hr/>
	
	{!! Form::open(['url'=>'drp']) !!}
		@include('drp.form', ['submitButtonText' => 'Add Record'])
	{!! Form::close() !!}
	
	@include('error')
@stop

@section('footer')
	@include('form')
@stop