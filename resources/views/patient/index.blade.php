@extends('app')

@section('content')
	<h1>Patient List</h1>

	@forelse ($patientList as $patient)
		<h2>{{ $patient->HN }}</h2>
		{{ $patient->firstname }} {{ $patient->lastname }}
	@empty
	    <p>No patient</p>
	@endforelse

@stop