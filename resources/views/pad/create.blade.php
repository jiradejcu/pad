@extends('app')

@section('content')
	<h1>Record PAD</h1>
	
	<hr/>
	
	{!! Form::open(['url'=>'pad']) !!}
		<div class="form-group">
			{!! Form::hidden('admission_id', $id)!!}
		</div>
		<div class="form-group">
			{!! Form::label('day', 'Day :') !!}
			{!! Form::text('day', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('data1', 'Data1 :') !!}
			{!! Form::text('data1', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::submit('Add Record', ['class' => 'btn btn-primary form-control']) !!}
		</div>
	{!! Form::close() !!} 
	
	@include('error')
@stop