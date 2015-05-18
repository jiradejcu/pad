@extends('app')

@section('content')
	<h1>Record PAD</h1>
	
	<hr/>
	
	{!! Form::open(['url'=>'pad']) !!}
		<div class="form-group">
			{!! Form::hidden('admission_id', $id)!!}
		</div>
		<div class="form-group">
			{!! Form::label('day', 'Date :') !!}
			{!! Form::input('date', 'date_assessed', date('Y-m-d'), ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('nr', 'Numeric Rating :') !!}
			{!! Form::text('nr', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('bps', 'Behavioral Pain :') !!}
			{!! Form::text('bps', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('rass', 'Sedation Assessment :') !!}
			{!! Form::text('rass', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('anxiety', 'Anxiety :') !!}
			{!! Form::hidden('anxiety', '0') !!}
			{!! Form::checkbox('anxiety') !!}
		</div>
		<div class="form-group">
			{!! Form::label('delirium', 'Delirium Assessment') !!}<br>
			{!! Form::radio('delirium', '-', true) !!}
			{!! Form::label('delirium', 'N/A') !!}
			{!! Form::radio('delirium', 1) !!}
			{!! Form::label('delirium', 'YES') !!}
			{!! Form::radio('delirium', 0) !!}
			{!! Form::label('delirium', 'NO') !!}
		</div>
		<div class="form-group">
			{!! Form::label('drug_interact', 'Drug Interactions :') !!}
			{!! Form::hidden('drug_interact', '0') !!}
			{!! Form::checkbox('drug_interact') !!}
		</div>
		<div class="form-group">
			{!! Form::submit('Add Record', ['class' => 'btn btn-primary form-control']) !!}
		</div>
	{!! Form::close() !!}
	
	@include('error')
@stop