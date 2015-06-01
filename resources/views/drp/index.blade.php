@extends('app')

@section('content')
<h1>DRP Record List</h1>

@if(!empty($drpRecordList->count))
<table id="drpTable">
	<tbody>
		<tr>
			<td width="200px"></td>
			<td></td>
			<td>Date</td>
			<td>HN</td>
			<td>Problem</td>
			<td>Cause</td>
			<td>Intervention</td>
			<td>Outcome of Intervention</td>
			<td>Medication Reconciliation</td>
			<td>Collected By</td>
			<td>Verified By</td>
		</tr>
		@foreach ($drpRecordList as  $drpRecord)
		<tr>
			<td width="100px" height="50px"><a class="btn btn-large btn-danger" data-toggle="confirmation" id="{{ $padRecord->record_id }}">x</a></td>
			<td><a href="{{ url('/drp/'.$drpRecord->record_id.'/edit') }}">Edit</a></td>
			<td>{{ displayDate($drpRecord->date_recorded) }}</td>
			<td>{{ $drpRecord->hn }}</td>
			<td>{{ $drpRecord->problem }}</td>
			<td>{{ $drpRecord->cause }}</td>
			<td>{{ $drpRecord->intervention }}</td>
			<td>{{ $drpRecord->outcome }}</td>
			<td>{{ $drpRecord->med_recon }}</td>
			<td>{{ $drpRecord->collected_by }}</td>
			<td>{{ $drpRecord->verified_by }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@else
<p>No record</p>
@endif
	
<hr>
<a href="{{ url('/drp/create') }}" tabindex="1">Add</a>
@stop

@section('footer')
@stop
