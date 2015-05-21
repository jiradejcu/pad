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
	<hr/>
	<h2>Date</h2>
	<hr/>
		@include('form_control.datetime_from_to', ['datetime_name' => 'hospital_admission_date', 'label_text' => 'Hospital Admission Date'])
		<div class="form-group">
			{!! Form::label('hospital_admission_from', 'Hospital Admission From :') !!}
			{!! Form::text('hospital_admission_from', null, ['class' => 'form-control']) !!}
		</div>
		@include('form_control.datetime_from_to', ['datetime_name' => 'icu_admission_date', 'label_text' => 'ICU Admission Date'])
		<div class="form-group">
			{!! Form::label('icu_admission_from', 'ICU Admission From :') !!}
			{!! Form::text('icu_admission_from', null, ['class' => 'form-control']) !!}
		</div>
		@include('form_control.datetime_from_to', ['datetime_name' => 'ett_date', 'label_text' => 'ETT Date'])
	<hr/>
	<h2>Medical History</h2>
	<hr/>
		<div class="form-group">
			{!! Form::label('reason', 'Reason for ICU Admission :') !!}
			{!! Form::text('reason', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('previous_meds', 'Previous Meds :') !!}
			{!! Form::text('previous_meds', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('allergy', 'Allergy :') !!}<br>
			{!! Form::radio('allergy', '-', true) !!}
			{!! Form::label('allergy', 'N/A') !!}
			{!! Form::radio('allergy', 0) !!}
			{!! Form::label('allergy', 'NO') !!}
			{!! Form::radio('allergy', 1) !!}
			{!! Form::label('allergy', 'YES') !!}
			{!! Form::text('allergy_detail', null, ['class' => 'form-control']) !!}
		</div>
	<hr/>
	<h2>Underlying Diseases</h2>
	<hr/>
		@include('form_control.checkbox_detail', ['checkbox_name' => 'cancer_solid', 'label_text' => 'Cancer(solid) :'])
	<hr/>
	<h2>Active Problems</h2>
	<hr/>
		@include('form_control.checkbox_detail', ['checkbox_name' => 'seizure_shock', 'label_text' => 'Seizure Shock :'])
	<hr/>
		<div class="form-group">
			{!! Form::submit('Add Patient', ['class' => 'btn btn-primary form-control']) !!}
		</div>
		
	{!! Form::close() !!}
	
	@include('error')
@stop

@section('footer')
	@include('form')
@stop