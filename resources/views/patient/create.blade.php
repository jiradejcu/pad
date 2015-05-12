@extends('app')

@section('content')
	<h1>Add Patient</h1>
	
	<hr/>
	
	{!! Form::open() !!}
		<div class="form-group">
			{!! Form::label('HN', 'HN :') !!}
			{!! Form::text('HN', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('firstname', 'First Name :') !!}
			{!! Form::text('firstname', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('lastname', 'Last Name :') !!}
			{!! Form::text('lastname', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::submit('Add Patient', ['class' => 'btn btn-primary form-control']) !!}
		</div>
	{!! Form::close() !!} 
@stop