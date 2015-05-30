@extends('app')

@section('content')
	<h1>Patient List</h1>

	@forelse ($patientList as $patient)
		<h2>{!! Form::input('button', 'delete_record', 'x', ['id' => $patient->HN]) !!}
		HN : <a href="{{ url('/patient/'.$patient->HN.'/edit') }}">{{ $patient->HN }}</a> <a href="{{ url('/patient/'.$patient->HN) }}">PAD</a></h2>
		{{ $patient->firstname }} {{ $patient->lastname }}
	@empty
	    <p>No patient</p>
	@endforelse
	<hr>
	<a href="{{ url('/patient/create') }}" tabindex="1">Add</a>
	
	<script type="text/javascript">
	<!--
	$(function() {
		$("input:button[name='delete_record']").click(function() {
			 $.ajax({
		            url: '{{ url('/patient') }}/' + this.id,
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