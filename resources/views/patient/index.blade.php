@extends('app')

@section('content')
	<h1>Patient List</h1>

	@forelse ($patientList as $patient)
		<h2><a href="{{ url('/patient/'.$patient->HN) }}">{{ $patient->HN }}</a></h2>
		{{ $patient->firstname }} {{ $patient->lastname }}
	@empty
	    <p>No patient</p>
	@endforelse

@stop