@extends('app')

@section('content')
<h1>PAD Record List</h1>
@forelse ($padRecordList as $admission_id => $padRecords)
<?php $patient = $padRecords['admission']->patient; ?> 
<h2>HN : {{ $patient->HN }} {{ $patient->firstname }} {{ $patient->lastname }}</h2>

<table id="padTable">
	<tbody>
		<tr>
			<td width="200px"></td>
			<td>Date</td>
			<td>Numeric Rating</td>
			<td>Behavioral Pain Scale</td>
			<td>Sedation Assessment</td>
			<td>Anxiety</td>
			<td>Delirium Assessment</td>
			<td>Drug Interaction</td>
		</tr>
		@forelse ($padRecords['padRecord'] as $padRecord)
		<tr>
			<td width="100px" height="50px">{!! Form::input('button',
				'delete_record', 'x', ['id' => $padRecord->record_id]) !!}</td>
			<td>{{ displayDate($padRecord->date_assessed) }}</td>
			<td>{{ displayNullNumber($padRecord->nr) }}</td>
			<td>{{ displayNullNumber($padRecord->bps) }}</td>
			<td>{{ displayNullNumber($padRecord->rass) }}</td>
			<td>{{ convertTriState($padRecord->anxiety) }}</td>
			<td>{{ convertTriState($padRecord->delirium) }}</td>
			<td>{{ convertTriState($padRecord->drug_interact) }}</td>
		</tr>
		@empty
		<p>No record</p>
		@endforelse
	</tbody>
</table>
<hr>
<a href="{{ url('/pad/'.$admission_id.'/create') }}" tabindex="1">Add</a>
@empty
<p>No record</p>
@endforelse

<script type="text/javascript">
<!--
$(function() {
    var t = $('#padTable tbody').eq(0);
    var r = t.find('tr');
    var cols= r.length;
    var rows= r.eq(0).find('td').length;
    var cell, next, tem, i = 0;
    var tb= $('<tbody></tbody>');
 
    while(i<rows){
        cell= 0;
        tem= $('<tr></tr>');
        while(cell<cols){
            next= r.eq(cell++).find('td').eq(0);
            tem.append(next);
        }
        tb.append(tem);
        ++i;
    }
    $('#padTable').append(tb);
    $('#padTable').show();

	$("input:button[name='delete_record']").click(function() {
		 $.ajax({
	            url: '{{ url('/pad') }}/' + this.id,
	            type: 'DELETE',
	            dataType: 'json',
	            data: {
	                'id': this.id,
	                '_token': '{{ csrf_token() }}'
	            },
	            success: function ()
	            {
	            	location.reload();
	            }
		});
	});
});
//-->
</script>

@stop
