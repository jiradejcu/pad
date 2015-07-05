		@if($isHidden)
		<div class="form-inline" id="medRecordTemplate" style="display: none">
		@else
		<div class="form-inline med-record" id="medRecord{{ $padMedRecord->med_record_id }}">
		{!! Form::setModel($padMedRecord) !!}
		@endif
			{!! Form::label('med_name', 'Name :') !!}
			{!! Form::select('med_name', $medicines, null, ['class' => 'form-control med-select med-record-field', 'style' => 'width: 15%']) !!}
			<div class="form-group">
				{!! Form::label('med_channel', 'Channel :') !!}
				<label class="radio-inline">{!! Form::radio('med_channel', 'bolus', true, ['class' => 'med-record-field']) !!}Bolus</label>
				<label class="radio-inline">{!! Form::radio('med_channel', 'drip', null, ['class' => 'med-record-field']) !!}Drip</label>
			</div>
			{!! Form::label('med_dose', 'Dose :') !!}
			{!! Form::text('med_dose', null, ['class' => 'form-control med-record-field', 'style' => 'width: 5%']) !!}
			
			<div class="form-group">
				@include('form_control.checkbox', ['checkbox_name' => 'bp_drop', 'label_text' => 'BP Drop', 'form_class' => 'med-record-field'])
			</div>
			<div class="form-group">
				@include('form_control.checkbox', ['checkbox_name' => 'slow_hr', 'label_text' => 'Slow HR', 'form_class' => 'med-record-field'])
			</div>
			<div class="form-group">
				@include('form_control.checkbox', ['checkbox_name' => 'constipation', 'label_text' => 'Constipation', 'form_class' => 'med-record-field'])
			</div>
			<div class="form-group">
				@include('form_control.checkbox', ['checkbox_name' => 'prolong_sedation', 'label_text' => 'Prolong Sedation', 'form_class' => 'med-record-field'])
			</div>
			
			{!! Form::label('remark', 'Remark :') !!}
			{!! Form::text('remark', null, ['class' => 'form-control med-record-field', 'style' => 'width: 10%']) !!}
		
  			{!! Form::button('+', ['class' => 'btn add-record']) !!}
  			{!! Form::button('--', ['class' => 'btn btn-danger remove-record']) !!}
		</div>
