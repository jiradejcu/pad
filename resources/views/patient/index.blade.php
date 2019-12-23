@extends('app')

@section('content')
    <h1>
        <div class="pull-right">
            <a class="btn btn-large btn-primary" href="{{ url('/patient/create') }}" tabindex="1">+</a>
        </div>
        Patient List
    </h1>
    <a href="{{ url('/?view=table') }}">Table View</a>
	@forelse ($patientList as $patient)
		<h2><a class="btn btn-large btn-danger" data-toggle="confirmation" id="{{ $patient->HN }}">x</a>
		Code : <a href="{{ url('/patient/'.$patient->HN.'/edit') }}">{{ $patient->HN }}</a> <a href="{{ url('/patient/'.$patient->HN) }}">PAD</a></h2>
	@empty
	    <p>No patient</p>
	@endforelse
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