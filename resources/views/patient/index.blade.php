@extends('app')

@section('content')
	<h1>Patient List</h1>	
	@forelse ($patientList as $patient)
		<h2><a class="btn btn-large btn-danger" data-toggle="confirmation" id="{{ $patient->HN }}">x</a>
		HN : <a href="{{ url('/patient/'.$patient->HN.'/edit') }}">{{ $patient->HN }}</a> <a href="{{ url('/patient/'.$patient->HN) }}">PAD</a></h2>
		{{ $patient->firstname }} {{ $patient->lastname }}
	@empty
	    <p>No patient</p>
	@endforelse
	<hr>
	<a href="{{ url('/patient/create') }}" tabindex="1">Add</a>
@stop

@section('footer')
	<script type="text/javascript">
	<!--
	$(function() {
		$('[data-toggle="confirmation"]').click(function(){
			var self = this;
			bootbox.confirm("Are you sure?",
				function(result){
					if(result){
						$.ajax({
				            url: '{{ url('/patient') }}/' + self.id,
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
	//-->
	</script>
@stop