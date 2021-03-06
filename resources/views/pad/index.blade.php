@extends('app')

@section('content')
<h1>PAD Record List</h1>
@forelse ($padRecordList as $admission_id => $padRecords)
<?php $patient = $padRecords['admission']->patient; ?> 
<h2>HN : {{ $patient->HN }} {{ $patient->firstname }} {{ $patient->lastname }}</h2>

@if(count($padRecords['padRecord']) > 0)
<table id="padTable" class="table table-striped table-bordered">
	<tbody>
		<tr>
			<td></td>
			<td></td>
			<td>Date</td>
			<td>Body Weight</td>
			<td>Numeric Rating</td>
			<td>Behavioral Pain Scale</td>
			<td>Sedation Assessment</td>
			<td>BIS</td>
			<td>Delirium Assessment</td>
			<td>AST</td>
			<td>ALT</td>
			<td>TB</td>
			<td>DB</td>
			<td>Albumin</td>
			<td>BUN</td>
			<td>Scr</td>
			<td>Intake</td>
			<td>Urine</td>
			<td>Drug Interaction</td>
			<td>Drug Interaction Detail</td>
			<td>Acute Liver Failure</td>
			<td>Acute Liver Failure Cause</td>
			<td>Cholestasis Jaundice</td>
			<td>Mixed Pattern of Liver Disease</td>
			<td>HD</td>
			<td>Renal Impairment</td>
			<td>Mechanical Ventilator</td>
			<td>Mode of Ventilator</td>
			<td>Non Pharmaco</td>
			<td>Medication List</td>
		</tr>
		@foreach ($padRecords['padRecord'] as $padRecord)
		<tr>
			<td><a class="btn btn-large btn-danger" data-toggle="confirmation" id="{{ $padRecord->record_id }}">x</a></td>
			<td><a href="{{ url('/pad/'.$padRecord->record_id.'/edit') }}">Edit</a></td>
			<td>{{ displayDate($padRecord->date_assessed) }}</td>
			<td>{{ displayNullNumber($padRecord->bw) }}</td>
			<td>{{ displayNullNumber($padRecord->nr) }}</td>
			<td>{{ displayNullNumber($padRecord->bps) }}</td>
			<td>{{ displayNullNumber($padRecord->rass) }}</td>
			<td>{{ convertTriState($padRecord->bis) }}</td>
			<td>{{ convertTetraState($padRecord->delirium) }}</td>
			<td>{{ displayNullNumber($padRecord->ast) }}</td>
			<td>{{ displayNullNumber($padRecord->alt) }}</td>
			<td>{{ displayNullNumber($padRecord->tb) }}</td>
			<td>{{ displayNullNumber($padRecord->db) }}</td>
			<td>{{ displayNullNumber($padRecord->albumin) }}</td>
			<td>{{ displayNullNumber($padRecord->bun) }}</td>
			<td>{{ displayNullNumber($padRecord->scr) }}</td>
			<td>{{ displayNullNumber($padRecord->i) }}</td>
			<td>{{ displayNullNumber($padRecord->urine) }}</td>
			<td>{{ convertTriState($padRecord->drug_interact) }}</td>
			<td>{{ $padRecord->drug_interact_detail }}</td>
			<td>{{ convertTriState($padRecord->hepato) }}</td>
			<td>{{ $padRecord->hepato_detail }}</td>
			<td>{{ convertTriState($padRecord->cholestasis) }}</td>
			<td>{{ convertTriState($padRecord->liver_disease) }}</td>
			<td>{{ convertTriState($padRecord->hd) }}</td>
			<td>{{ $padRecord->renal_impairment }}</td>
			<td>{{ convertTriState($padRecord->mechanical_ventilator) }}</td>
			<td>{{ $padRecord->mechanical_ventilator_detail }}</td>
			<td>{{ convertCheckboxArray($padRecord, $non_pharmaco_fields) }}</td>
			<td>
				<table id="padMedTable" class="table table-striped table-bordered">
					<tbody>
					<tr>
						<td>Name</td>
						<td>Channel</td>
						<td>Dose</td>
						<td>BP Drop</td>
						<td>Slow HR</td>
						<td>Constipation</td>
						<td>Prolong Sedation</td>
						<td>Indication</td>
						<td>Remark</td>
					</tr>
					@foreach ($padRecord->padMedRecords->all() as $padMedRecord)
					<tr>
						<td>{{ $padMedRecord->med_name }}</td>
						<td>{{ $padMedRecord->med_channel }}</td>
						<td>{{ displayNullNumber($padMedRecord->med_dose) . ' mg' }}</td>
						<td>{{ convertTriState($padMedRecord->bp_drop) }}</td>
						<td>{{ convertTriState($padMedRecord->slow_hr) }}</td>
						<td>{{ convertTriState($padMedRecord->constipation) }}</td>
						<td>{{ convertTriState($padMedRecord->prolong_sedation) }}</td>
						<td>{{ $indications[$padMedRecord->indication] }}</td>
						<td>{{ $padMedRecord->remark }}</td>
					</tr>
					@endforeach
					</tbody>
				</table>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@else
<p>No record</p>
@endif

<a href="{{ url('/pad/'.$admission_id.'/create') }}" tabindex="1">Add</a>
@empty
<p>No record</p>
@endforelse

@stop

@section('footer')

<script type="text/javascript">
<!--
$(function() {

	transposeTable();
    
    $('[data-toggle="confirmation"]').click(function(){
		var self = this;
		bootbox.confirm("Are you sure?",
			function(result){
				if(result){
					 $.ajax({
				            url: '{{ url('/pad') }}/' + self.id,
				            type: 'DELETE',
				            dataType: 'json',
				            data: {
				                '_token': '{{ csrf_token() }}'
				            },
				            success: function ()
				            {
				            	location.reload();
				            }
					});
				}
		});
	});
});

function transposeTable(){
    var t = $('#padTable tbody').eq(0);
    var r = t.children('tr');
    var cols= r.length;
    var rows= r.eq(0).children('td').length;
    var cell, next, tem, i = 0;
    var tb= $('<tbody></tbody>');
 
    while(i<rows){
        cell= 0;
        tem= $('<tr></tr>');
        while(cell<cols){
            next= r.eq(cell++).children('td').eq(0);
            tem.append(next);
        }
        tb.append(tem);
        ++i;
    }
    $('#padTable').append(tb);
    $('#padTable').show();
}
//-->
</script>

@stop
