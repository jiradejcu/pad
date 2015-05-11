@extends('app')

@section('content')
	<h1>PAD Record List</h1>

	@foreach ($padRecordList as $padRecord)
		<h2>{{ $padRecord->admission_id }}</h2>
		{{ $padRecord->day }} {{ $padRecord->data1 }}
	@endforeach
@stop