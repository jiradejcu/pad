@extends('app')

@section('content')
<h1>DRP Record List</h1>

@if(count($drpRecordList) > 0)
<table id="drpTable" class="table table-striped table-bordered table-hover">
	<tbody>
		<tr>
			<td></td>
			<td></td>
			<td>Date</td>
			<td>HN</td>
			<td>Problem</td>
			<td>Cause</td>
			<td>Intervention</td>
			<td>Outcome</td>
			<td>Medication Reconciliation</td>
			<td>Recorded By</td>
			<td>Verified By</td>
		</tr>
		@foreach ($drpRecordList as  $drpRecord)
		<tr>
			<td><a class="btn btn-large btn-danger" data-toggle="confirmation" id="{{ $drpRecord->record_id }}">x</a></td>
			<td><a href="{{ url('/drp/'.$drpRecord->record_id.'/edit') }}">Edit</a></td>
			<td>{{ displayDate($drpRecord->date_recorded) }}</td>
			<td>{{ $drpRecord->HN }}</td>
			<td>{{ $drpRecord->problem }}</td>
			<td>{{ $drpRecord->cause }}</td>
			<td>{{ $drpRecord->intervention }}</td>
			<td>{{ $drpRecord->outcome }}</td>
			<td>{{ $drpRecord->med_recon }}</td>
			<td>{{ $drpRecord->recorded_by }}</td>
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
