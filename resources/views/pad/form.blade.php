		<div class="form-group">
			{!! Form::label('date_assessed', 'Date :') !!}
			<div class='input-group date'>
				{!! Form::input('text', 'date_assessed', null, ['class' => 'form-control']) !!}
	            <span class="input-group-addon">
	            	<span class="glyphicon glyphicon-calendar"></span>
	            </span>
            </div>
		</div>
		<div class="form-group">
			{!! Form::label('nr', 'Numeric Rating :') !!}
			{!! Form::text('nr', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('bps', 'Behavioral Pain :') !!}
			{!! Form::text('bps', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('rass', 'Sedation Assessment :') !!}
			{!! Form::text('rass', null, ['class' => 'form-control']) !!}
		</div>
			@include('form_control.tri_state', ['radio_name' => 'delirium', 'label_text' => 'Delirium Assessment'])
		<div class="form-group">
			@include('form_control.checkbox', ['checkbox_name' => 'drug_interact', 'label_text' => 'Drug Interactions'])
		</div>
		<div class="form-group">
			@include('form_control.checkbox', ['checkbox_name' => 'hr', 'label_text' => 'HR (SE จากยา)'])
		</div>
		<div class="form-group">
			@include('form_control.checkbox', ['checkbox_name' => 'hepato', 'label_text' => 'Hepatocellular Disease'])
		</div>
		<div class="form-group">
			@include('form_control.checkbox', ['checkbox_name' => 'cholestasis', 'label_text' => 'Cholestasis Jaundice'])
		</div>
		<div class="form-group">
			@include('form_control.checkbox', ['checkbox_name' => 'liver_disease', 'label_text' => 'Mixed Pattern of Liver Disease'])
		</div>
		<div class="form-group">
			@include('form_control.checkbox', ['checkbox_name' => 'hd', 'label_text' => 'HD'])
		</div>
		<div class="form-group">
			{!! Form::label('renal_impairment', 'Renal Impairment') !!}<br>
			<label class="radio-inline">{!! Form::radio('renal_impairment', 'mild') !!}Mild</label>
			<label class="radio-inline">{!! Form::radio('renal_impairment', 'mod') !!}Moderate</label>
			<label class="radio-inline">{!! Form::radio('renal_impairment', 'severe') !!}Severe</label>
		</div>
		<div class="form-group">
			{!! Form::label('padMedRecords', 'Medication Lists') !!}
			@include('pad.med', ['id' => 0, 'isHidden' => 1, 'medicines' => $medicines])
		</div>
		<div class="form-group">
			{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
		</div>