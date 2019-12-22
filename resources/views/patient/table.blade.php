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
        $patientAdmissionDisplayColumn = ['hospital_admission_date_from', 'hospital_admission_date_to', 'hospital_admission_from', 'icu_admission_date_from', 'icu_admission_date_to', 'icu_admission_from', 'ett_date_from', 'ett_date_to'];
        $patientAdmissionDisplayColumn = array_merge($patientAdmissionDisplayColumn, ['age', 'temperature', 'mean_arterial_pressure', 'heart_rate', 'respiratory_rate']);
		$patientAdmissionDisplayColumn = array_merge($patientAdmissionDisplayColumn, ['fio2', 'aapo2', 'pao2', 'ph_choice', 'ph', 'hco3', 'serum_na', 'serum_k']);
		$patientAdmissionDisplayColumn = array_merge($patientAdmissionDisplayColumn, ['creatinine', 'hematocrit', 'wbc', 'glasgow_coma', 'chronic_health_problem']);
		$patientAdmissionDisplayColumn = array_merge($patientAdmissionDisplayColumn, ['platelet', 'bilirubin', 'map_or_vaso', 'creatinine_or_urine']);
		$patientAdmissionDisplayColumn = array_merge($patientAdmissionDisplayColumn, ['apache_ii_score', 'sofa_score']);
		$patientPadDisplayColumn = ['record_id','date_assessed','bw','nr','bps','rass','bis','anxiety','delirium','fio2','peep','rr','bp_h','bp_l','o2sat','ast','alt','alp','ggt','tb','db'];
		$patientPadDisplayColumn = array_merge($patientPadDisplayColumn, ['albumin','bun','scr','i','o','urine','stool','hd','hd_mode','drug_interact','drug_interact_detail','hepato','hepato_detail']);
		$patientPadDisplayColumn = array_merge($patientPadDisplayColumn, ['cholestasis','liver_disease','renal_impairment','ph','pco2','po2','hco3','po2_fi','ca','mg','mechanical_ventilator','mechanical_ventilator_detail']);
		$patientPadDisplayColumn = array_merge($patientPadDisplayColumn, ['sufficient_light','night_light_off','blindfold','earplug','reorentation','family_participation','early_ambulate','rom','stand_assist','bed_side_chair']);
		$patientPadMedDisplayColumn = ['med_record_id','med_name','med_channel','med_dose','med_dose_hr','med_time_from','med_time_to','bp_drop','slow_hr','constipation','prolong_sedation','indication','remark'];
		$displayColumn = array_merge([], $patientDisplayColumn);
		if(in_array('admission', $detail))$displayColumn = array_merge($displayColumn, $patientAdmissionDisplayColumn);
		if(in_array('pad', $detail))$displayColumn = array_merge($displayColumn, $patientPadDisplayColumn);
		if(in_array('pad_med', $detail))$displayColumn = array_merge($displayColumn, $patientPadMedDisplayColumn);
	?>
    @if (count($patientList) > 0)
    <table id="patient_table" width="100%" border="1px black" style="margin-top: 10px">
    	<thead>
            <tr>
                @foreach ($patientList[0] as $key => $value)
                    @if(in_array($key, $displayColumn))
                    <td>{{ $key }}</td>
                    @endif
                @endforeach
            </tr>
        </thead>
    	<tbody>
            @foreach ($patientList as $patient)
            <tr>
                @foreach ($patient as $key => $value)
                    @if(in_array($key, $displayColumn))
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