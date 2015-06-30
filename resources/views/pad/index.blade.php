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
			<td>Numeric Rating</td>
			<td>Behavioral Pain Scale</td>
			<td>Sedation Assessment</td>
			<td>Anxiety</td>
			<td>Delirium Assessment</td>
			<td>Drug Interaction</td>
			<td>Medication List</td>
		</tr>
		@foreach ($padRecords['padRecord'] as $padRecord)
		<tr>
			<td><a class="btn btn-large btn-danger" data-toggle="confirmation" id="{{ $padRecord->record_id }}">x</a></td>
			<td><a href="{{ url('/pad/'.$padRecord->record_id.'/edit') }}">Edit</a></td>
			<td>{{ displayDate($padRecord->date_assessed) }}</td>
			<td>{{ displayNullNumber($padRecord->nr) }}</td>
			<td>{{ displayNullNumber($padRecord->bps) }}</td>
			<td>{{ displayNullNumber($padRecord->rass) }}</td>
			<td>{{ convertTriState($padRecord->anxiety) }}</td>
			<td>{{ convertTriState($padRecord->delirium) }}</td>
			<td>{{ convertTriState($padRecord->drug_interact) }}</td>
			<td>
				<table id="padMedTable" class="table table-striped table-bordered">
					<tbody>
					@foreach ($padRecord->padMedRecords->all() as $padMedRecord)
					<tr>
						<td>{{ $padMedRecord->med_name }}</td>
						<td>{{ $padMedRecord->med_channel }}</td>
						<td>{{ $padMedRecord->med_dose . ' mg' }}</td>
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
