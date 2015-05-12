@extends('app')

@section('content')
	<h1>PAD Record List</h1>
		<? $previous_id = 0; ?>
		@forelse ($padRecordList as $padRecord)
		<? if($padRecord->admission_id > $previous_id) { 
				$previous_id = $padRecord->admission_id;
		?>
		<h2>Admission No. {{ $padRecord->admission_id }}</h2>
		<? } ?>
		Day {{ $padRecord->day }} : Data1 -> {{ $padRecord->data1 }} <br>
	@empty
	    <p>No record</p>
	@endforelse
	
@stop