@extends('app')

@section('content')
    <div class="pull-right">
        <button onclick="exportTableToExcel('patient_table')">Export</button>
    </div>
    <h1>
        Patient List
    </h1>
    <a href="{{ url('/') }}">List View</a>
    @if (!empty($patientList))
    <table id="patient_table" width="100%" border="1px black" style="margin-top: 10px">
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