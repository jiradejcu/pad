@extends('app')

@section('content')
    <table width="100%" border="1px black">
    	<tbody>
            <tr>
                <td>admission id</td>
                <td>HN</td>
                <td>firstname</td>
                <td>lastname</td>
                <td>age</td>
                <td>icu from</td>
                <td>icu to</td>
                <td>icu stay</td>
                <td>hospital from</td>
                <td>hospital to</td>
                <td>hospital stay</td>
                <td>ett from</td>
                <td>ett to</td>
                <td>ett duration</td>
                <td>apache ii</td>
            </tr>
            @forelse ($patientOutliner as $patient)
                <tr>
                    <td>{{ $patient->admission_id }}</td>
                    <td><a href="{{ url('/patient/'.$patient->HN.'/edit') }}">{{ $patient->HN }}</a></td>
                    <td>{{ $patient->firstname }}</td>
                    <td>{{ $patient->lastname }}</td>
                    <td>{{ $patient->age }}</td>
                    <td>{{ $patient->icu_admission_date_from }}</td>
                    <td>{{ $patient->icu_admission_date_to }}</td>
                    <td>{{ number_format($patient->icu_stay, 2) }}</td>
                    <td>{{ $patient->hospital_admission_date_from }}</td>
                    <td>{{ $patient->hospital_admission_date_to }}</td>
                    <td>{{ number_format($patient->hospital_stay, 2) }}</td>
                    <td>{{ $patient->ett_date_from }}</td>
                    <td>{{ $patient->ett_date_to }}</td>
                    <td>{{ number_format($patient->ett_duration, 2) }}</td>
                    <td>{{ $patient->apache_ii }}</td>
                </tr>
            @empty
                <tr><td>No patient</td></tr>
            @endforelse
        </tbody>
    </table>
@stop