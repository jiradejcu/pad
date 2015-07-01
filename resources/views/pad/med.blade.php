		@if($isHidden)
		<div class="form-inline" id="medRecordTemplate" style="display: none">
		@else
		<div class="form-inline med-record" id="medRecord{{ $id }}">
		@endif
			{!! Form::label('med_name', 'Name :') !!}
			{!! Form::select('padMedRecords[%id%][med_name]', $medicines, null, ['class' => 'form-control med-select', 'style' => 'width: 15%']) !!}
			<div class="form-group">
				{!! Form::label('padMedRecords[%id%][med_channel]', 'Channel :') !!}
				<label class="radio-inline">{!! Form::radio('padMedRecords[%id%][med_channel]', 'bolus', true) !!}Bolus</label>
				<label class="radio-inline">{!! Form::radio('padMedRecords[%id%][med_channel]', 'drip') !!}Drip</label>
			</div>
			{!! Form::label('med_dose', 'Dose :') !!}
			{!! Form::text('padMedRecords[%id%][med_dose]', null, ['class' => 'form-control', 'style' => 'width: 5%']) !!}
			
			<div class="form-group">
				@include('form_control.checkbox', ['checkbox_name' => 'padMedRecords[%id%][bp_drop]', 'label_text' => 'BP Drop'])
			</div>
			<div class="form-group">
				@include('form_control.checkbox', ['checkbox_name' => 'padMedRecords[%id%][slow_hr]', 'label_text' => 'Slow HR'])
			</div>
			<div class="form-group">
				@include('form_control.checkbox', ['checkbox_name' => 'padMedRecords[%id%][constipation]', 'label_text' => 'Constipation'])
			</div>
			<div class="form-group">
				@include('form_control.checkbox', ['checkbox_name' => 'padMedRecords[%id%][prolong_sedation]', 'label_text' => 'Prolong Sedation'])
			</div>
			
			{!! Form::label('remark', 'Remark :') !!}
			{!! Form::text('padMedRecords[%id%][remark]', null, ['class' => 'form-control', 'style' => 'width: 10%']) !!}
		
  			{!! Form::button('+', ['class' => 'btn add-record']) !!}
  			{!! Form::button('--', ['class' => 'btn btn-danger remove-record']) !!}
		</div>
		@include('form_control.med', ['medRecordName' => 'padMedRecords'])