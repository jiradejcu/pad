@extends('app')

@section('content')
	<h1>Record PAD</h1>
	
	<hr/>
	
	{!! Form::open(['url'=>'pad']) !!}
		<div class="form-group">
			{!! Form::hidden('admission_id', $id)!!}
		</div>
		@include('pad.form', ['submitButtonText' => 'Add Record'])
	{!! Form::close() !!}
	
	@include('error')
@stop

@section('footer')
	@include('form')
@stop