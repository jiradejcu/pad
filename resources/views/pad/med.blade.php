		@if($isHidden)
		<div id="medRecordTemplate" style="display: none">
		@else
		<div class="med-record" id="medRecord{{ $padMedRecord->med_record_id }}">
		{!! Form::setModel($padMedRecord) !!}
		@endif
			<div class="form-inline">
				{!! Form::label('med_name', 'Name :') !!}
				{!! Form::select('med_name', $medicines, null, ['class' => 'form-control med-select med-record-field', 'style' => 'width: 15%']) !!}
				<span class="space-vertical"></span>
				<div class="form-group">
					{!! Form::label('med_channel', 'Channel :') !!}
					<label class="radio-inline">{!! Form::radio('med_channel', 'bolus', true, ['class' => 'med-record-field']) !!}Bolus</label>
					<label class="radio-inline">{!! Form::radio('med_channel', 'drip', null, ['class' => 'med-record-field']) !!}Drip</label>
				</div>
				<span class="divider-vertical"></span>
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
				<span class="divider-vertical"></span>
				{!! Form::label('remark', 'Remark :') !!}
				{!! Form::text('remark', null, ['class' => 'form-control med-record-field']) !!}
			</div>
			<div class="form-inline">
				@include('form_control.time_from_to', ['time_name' => 'med_time', 'form_class' => 'med-record-field'])
				<span class="space-vertical"></span>
				<div class="form-group">
					@include('form_control.checkbox', ['checkbox_name' => 'all_date', 'label_text' => 'All Day', 'form_class' => 'med-record-field'])
				</div>
				<span class="space-vertical"></span>
				<div class="form-group med_dose">
				{!! Form::label('med_dose', 'Dose :') !!}
				{!! Form::text('med_dose', null, ['class' => 'form-control med-record-field']) !!}
				</div>
				<div class="form-group med_dose_hr">
				{!! Form::label('med_dose_hr', 'Dose/Hr :') !!}
				{!! Form::text('med_dose_hr', null, ['class' => 'form-control med-record-field']) !!}
				</div>
				<div class="pull-right">
		  			{!! Form::button('--', ['class' => 'btn btn-danger remove-record']) !!}
		  			{!! Form::button('+', ['class' => 'btn add-record']) !!}
	  			</div>
			</div>
		<hr>
		</div>
