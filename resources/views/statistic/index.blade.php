@extends('app')

@section('content')
    <table width="100%">
        <tr>
            <td>type</td>
            <td>count</td>
            <td>%male</td>
            <td>avg age</td>
            <td>avg apache ii</td>
            <td>%septic shock</td>
            <td>%cardiogenic shock</td>
            <td>%aki</td>
            <td>%death</td>
            <td>%ards</td>
            <td>avg icu stay</td>
            <td>avg hospital stay</td>
        </tr>
        @forelse ($patients as $patient)
            <tr>
                <td>{{ $patient->type }}</td>
                <td>{{ $patient->cnt }}</td>
                <td>{{ number_format($patient->percent_male, 2) }}</td>
                <td>{{ number_format($patient->avg_age, 2) }}</td>
                <td>{{ number_format($patient->avg_apache_ii, 2) }}</td>
                <td>{{ number_format($patient->percent_septic_shock, 2) }}</td>
                <td>{{ number_format($patient->percent_cardiogenic_shock, 2) }}</td>
                <td>{{ number_format($patient->percent_aki, 2) }}</td>
                <td>{{ number_format($patient->percent_death, 2) }}</td>
                <td>{{ number_format($patient->percent_ards, 2) }}</td>
                <td>{{ number_format($patient->avg_icu_stay, 2) }}</td>
                <td>{{ number_format($patient->avg_hospital_stay, 2) }}</td>
            </tr>
        @empty
            <tr><td>No patient</td></tr>
        @endforelse
    </table>
    <br>
    <table width="100%">
        <tr>
            <td>type</td>
            <td>med name</td>
            <td>avg med dose per day</td>
        </tr>
        @forelse ($padMedRecords as $padMedRecord)
            <tr>
                <td>{{ $padMedRecord->type }}</td>
                <td>{{ $padMedRecord->med_name }}</td>
                <td>{{ number_format($padMedRecord->avg_med_dose_day, 2) }}</td>
            </tr>
        @empty
            <tr><td>No patient</td></tr>
        @endforelse
    </table>
@stop