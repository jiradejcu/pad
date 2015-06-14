		@if($isHidden)
		<div class="form-inline" id="medRecordTemplate" style="display: none">
		@else
		<div class="form-inline med-record" id="medRecord{{ $id }}">
		@endif
			{!! Form::label('medFrom', 'From :') !!}
			{!! Form::text('drpMedRecords[%id%][medFrom]', null, ['class' => 'form-control']) !!}
			{!! Form::label('medTo', 'To :') !!}
			{!! Form::text('drpMedRecords[%id%][medTo]', null, ['class' => 'form-control']) !!}
			
  			{!! Form::button('+', ['class' => 'btn add-record']) !!}
  			{!! Form::button('--', ['class' => 'btn btn-danger remove-record']) !!}
		</div>