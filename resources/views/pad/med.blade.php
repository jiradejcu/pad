		@if($isHidden)
		<div class="form-inline" id="medRecordTemplate" style="display: none">
		@else
		<div class="form-inline med-record" id="medRecord{{ $id }}">
		@endif
			{!! Form::label('med_name', 'Name :') !!}
			{!! Form::select('padMedRecords[%id%][med_name]', $medicines, null, ['class' => 'form-control med-select', 'style' => 'width: 22%']) !!}
			<div class="form-group">
				{!! Form::label('padMedRecords[%id%][med_channel]', 'Channel :') !!}
				<label class="radio-inline">{!! Form::radio('padMedRecords[%id%][med_channel]', 'bolus') !!}Bolus</label>
				<label class="radio-inline">{!! Form::radio('padMedRecords[%id%][med_channel]', 'drip') !!}Drip</label>
			</div>
			{!! Form::label('med_dose', 'Dose :') !!}
			{!! Form::text('padMedRecords[%id%][med_dose]', null, ['class' => 'form-control']) !!}
			
  			{!! Form::button('+', ['class' => 'btn add-record']) !!}
  			{!! Form::button('--', ['class' => 'btn btn-danger remove-record']) !!}
		</div>
		@include('form_control.med', ['medRecordName' => 'padMedRecords'])