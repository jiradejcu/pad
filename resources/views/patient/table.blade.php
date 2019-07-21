@extends('app')

@section('content')
    <h1>
        Patient List
    </h1>
    @if (!empty($patientList))
    <table width="100%" border="1px black">
    	<thead>
            <tr>
                @foreach ($patientList[0]->toArray() as $key => $value)
                    <td>{{ $key }}</td>
                @endforeach
                @foreach ($patientList[0]->admissions()->first()->toArray() as $key => $value)
                    <td>{{ $key }}</td>
                @endforeach
            </tr>
        </thead>
    	<tbody>
            @foreach ($patientList as $patient)
            <tr>
                @foreach ($patient->toArray() as $key => $value)
                    <td>{{ $value }}</td>
                @endforeach
                @foreach ($patient->admissions()->first()->toArray() as $key => $value)
                    <td>{{ $value }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
	@else
	    <p>No patient</p>
	@endif
@stop

@section('footer')
    <script src="{{ asset('/js/score.js') }}"></script>
@stop