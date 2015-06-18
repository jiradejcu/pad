		@if($isHidden)
		<div class="form-inline" id="medRecordTemplate" style="display: none">
		@else
		<div class="form-inline med-record" id="medRecord{{ $id }}">
		@endif
			{!! Form::label('med_from', 'From :') !!}
			{!! Form::select('drpMedRecords[%id%][med_from]', $medicines, null, ['class' => 'form-control']) !!}
			{!! Form::label('med_from_dose', 'Dose :') !!}
			{!! Form::text('drpMedRecords[%id%][med_from_dose]', null, ['class' => 'form-control']) !!}
			{!! Form::label('med_to', 'To :') !!}
			{!! Form::select('drpMedRecords[%id%][med_to]', $medicines, null, ['class' => 'form-control']) !!}
			{!! Form::label('med_to_dose', 'Dose :') !!}
			{!! Form::text('drpMedRecords[%id%][med_to_dose]', null, ['class' => 'form-control']) !!}
			
  			{!! Form::button('+', ['class' => 'btn add-record']) !!}
  			{!! Form::button('--', ['class' => 'btn btn-danger remove-record']) !!}
		</div>