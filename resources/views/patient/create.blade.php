@extends('app')

@section('content')
	<h1>Add Patient</h1>
	
	<hr/>
	
	{!! Form::open(['url'=>'patient']) !!}
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
			{!! Form::label('age', 'Age :') !!}
			{!! Form::text('age', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::radio('type', 'prospective', true) !!}
			{!! Form::label('type', 'Prospective') !!}
			{!! Form::radio('type', 'retrospective') !!}
			{!! Form::label('type', 'Retrospective') !!}
		</div>
		<div class="form-group">
			{!! Form::label('hospital_admission_date', 'Hospital Admission Date') !!}<br>
			{!! Form::label('from', 'From :') !!}
			<div class='input-group date'>
				{!! Form::input('text', 'hospital_admission_date_from', null, ['class' => 'form-control']) !!}
	            <span class="input-group-addon">
	            	<span class="glyphicon glyphicon-calendar"></span>
	            </span>
            </div>
			{!! Form::label('to', 'To :') !!}
			<div class='input-group date'>
				{!! Form::input('text', 'hospital_admission_date_to', null, ['class' => 'form-control']) !!}
	            <span class="input-group-addon">
	            	<span class="glyphicon glyphicon-calendar"></span>
	            </span>
            </div>
		</div>
		<div class="form-group">
			{!! Form::label('hospital_admission_from', 'Hospital Admission From :') !!}
			{!! Form::text('hospital_admission_from', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('icu_admission_date', 'ICU Admission Date') !!}<br>
			{!! Form::label('from', 'From :') !!}
			<div class='input-group date'>
				{!! Form::input('text', 'icu_admission_date_from', null, ['class' => 'form-control']) !!}
	            <span class="input-group-addon">
	            	<span class="glyphicon glyphicon-calendar"></span>
	            </span>
            </div>
			{!! Form::label('to', 'To :') !!}
			<div class='input-group date'>
				{!! Form::input('text', 'icu_admission_date_to', null, ['class' => 'form-control']) !!}
	            <span class="input-group-addon">
	            	<span class="glyphicon glyphicon-calendar"></span>
	            </span>
            </div>
		</div>
		<div class="form-group">
			{!! Form::label('icu_admission_from', 'ICU Admission From :') !!}
			{!! Form::text('icu_admission_from', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('reason', 'Reason for ICU Admission :') !!}
			{!! Form::text('reason', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::submit('Add Patient', ['class' => 'btn btn-primary form-control']) !!}
		</div>
		
	{!! Form::close() !!}
	
	@include('error')
@stop

@section('footer')
	@include('form')
@stop