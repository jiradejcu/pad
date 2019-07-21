@extends('app')

@section('content')
    <div class="pull-right">
        <button onclick="exportTableToExcel('patient_table')">Export</button>
    </div>
    <h1>
        Patient List
    </h1>
    <a href="{{ url('/') }}">List View</a>
    <?php
        $patientDisplayColumn = ['HN', 'firstname', 'lastname', 'sex'];
        $patientAdmissionDisplayColumn = ['age', 'temperature', 'mean_arterial_pressure', 'heart_rate', 'respiratory_rate'];
		$patientAdmissionDisplayColumn = array_merge($patientAdmissionDisplayColumn, ['fio2', 'aapo2', 'pao2', 'ph_choice', 'ph', 'hco3', 'serum_na', 'serum_k']);
		$patientAdmissionDisplayColumn = array_merge($patientAdmissionDisplayColumn, ['creatinine', 'hematocrit', 'wbc', 'glasgow_coma', 'chronic_health_problem']);
		$patientAdmissionDisplayColumn = array_merge($patientAdmissionDisplayColumn, ['platelet', 'bilirubin', 'map_or_vaso', 'creatinine_or_urine']);
		$patientAdmissionDisplayColumn = array_merge($patientAdmissionDisplayColumn, ['apache_ii_score', 'sofa_score']);
	?>
    @if (!empty($patientList))
    <table id="patient_table" width="100%" border="1px black" style="margin-top: 10px">
    	<thead>
            <tr>
                @foreach ($patientList[0]->toArray() as $key => $value)
                    @if(in_array($key, $patientDisplayColumn))
                    <td>{{ $key }}</td>
                    @endif
                @endforeach
                @foreach ($patientList[0]->admissions()->first()->toArray() as $key => $value)
                    @if(in_array($key, $patientAdmissionDisplayColumn))
                    <td>{{ $key }}</td>
                    @endif
                @endforeach
            </tr>
        </thead>
    	<tbody>
            @foreach ($patientList as $patient)
            <tr>
                @foreach ($patient->toArray() as $key => $value)
                    @if(in_array($key, $patientDisplayColumn))
                    <td>{{ $value }}</td>
                    @endif
                @endforeach
                @foreach ($patient->admissions()->first()->toArray() as $key => $value)
                    @if(in_array($key, $patientAdmissionDisplayColumn))
                    <td>{{ $value }}</td>
                    @endif
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
    <script>
        function exportTableToExcel(tableID, filename){
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

            filename = filename ? filename + '.xls' : 'data.xls';

            downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if(navigator.msSaveOrOpenBlob){
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob( blob, filename);
            }else{
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
                downloadLink.download = filename;
                downloadLink.click();
            }
        }
    </script>
@stop