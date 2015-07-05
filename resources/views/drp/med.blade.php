		@if($isHidden)
		<div class="form-inline" id="medRecordTemplate" style="display: none">
		@else
		<div class="form-inline med-record" id="medRecord{{ $drpMedRecord->med_record_id }}">
		{!! Form::setModel($drpMedRecord) !!}
		@endif
			{!! Form::label('med_from', 'From :') !!}
			{!! Form::select('med_from', $medicines, null, ['class' => 'form-control med-select med-record-field', 'style' => 'width: 18%']) !!}
			{!! Form::label('med_from_dose', 'Dose :') !!}
			{!! Form::text('med_from_dose', null, ['class' => 'form-control med-record-field', 'style' => 'width: 10%']) !!}
			{!! Form::label('med_to', 'To :') !!}
			{!! Form::select('med_to', $medicines, null, ['class' => 'form-control med-select med-record-field', 'style' => 'width: 18%']) !!}
			{!! Form::label('med_to_dose', 'Dose :') !!}
			{!! Form::text('med_to_dose', null, ['class' => 'form-control med-record-field', 'style' => 'width: 10%']) !!}
			{!! Form::label('med_remark', 'Remark :') !!}
			{!! Form::text('med_remark', null, ['class' => 'form-control med-record-field']) !!}
			
  			{!! Form::button('+', ['class' => 'btn add-record']) !!}
  			{!! Form::button('--', ['class' => 'btn btn-danger remove-record']) !!}
		</div>