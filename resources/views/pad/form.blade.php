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
			{!! Form::label('bw', 'Body Weight :') !!}
			{!! Form::text('bw', null, ['class' => 'form-control']) !!}
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
			@include('form_control.tri_state', ['radio_name' => 'bis', 'label_text' => 'BIS'])
			@include('form_control.tetra_state', ['radio_name' => 'delirium', 'label_text' => 'Delirium Assessment'])
		<div class="form-group">
			{!! Form::label('ast', 'AST :') !!}
			{!! Form::text('ast', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('alt', 'ALT :') !!}
			{!! Form::text('alt', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('tb', 'TB :') !!}
			{!! Form::text('tb', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('db', 'DB :') !!}
			{!! Form::text('db', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('albumin', 'Albumin :') !!}
			{!! Form::text('albumin', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('bun', 'BUN :') !!}
			{!! Form::text('bun', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('scr', 'Scr :') !!}
			{!! Form::text('scr', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('i', 'Intake :') !!}
			{!! Form::text('i', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('urine', 'Urine :') !!}
			{!! Form::text('urine', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			@include('form_control.checkbox', ['checkbox_name' => 'drug_interact', 'label_text' => 'Drug Interactions', 'detail_text' => 1])
		</div>
		<div class="form-group">
			@include('form_control.checkbox', ['checkbox_name' => 'hepato', 'label_text' => 'Acute Liver Failure (Cause)', 'detail_text' => 1])
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
			<label class="radio-inline">{!! Form::radio('renal_impairment', 'no', true) !!}No</label>
			<label class="radio-inline">{!! Form::radio('renal_impairment', 'mild') !!}Mild</label>
			<label class="radio-inline">{!! Form::radio('renal_impairment', 'mod') !!}Moderate</label>
			<label class="radio-inline">{!! Form::radio('renal_impairment', 'severe') !!}Severe</label>
			<label class="radio-inline">{!! Form::radio('renal_impairment', 'esrd') !!}ESRD</label>
		</div>
		<div class="form-group">
			@include('form_control.checkbox', ['checkbox_name' => 'mechanical_ventilator', 'label_text' => 'Mechanical Ventilator (Mode of Ventilator) : ', 'detail_text' => 1])
		</div>
		<div class="form-group">
			{!! Form::label('non_pharmaco', 'Non Pharmaco :') !!}
		</div>
		<div class="form-group">
            @foreach($non_pharmaco_fields as $key => $value)
			    @include('form_control.checkbox', ['checkbox_name' => $key, 'label_text' => $value])
            @endforeach
		</div>
		<hr>
		<div class="form-group">
		    <h2>Medication Lists {!! Form::button('+', ['class' => 'btn btn-primary add-record']) !!}</h2>
			<hr>
			@include('pad.med', ['isHidden' => 1, 'medicines' => $medicines])
			
			@if(!empty($padRecord))
				@foreach($padRecord->padMedRecords as $padMedRecord)
					@include('pad.med', ['isHidden' => 0, 'medicines' => $medicines])
				@endforeach
			@endif

			@include('form_control.med', ['medRecordName' => 'padMedRecords'])
		</div>
		<div class="form-group">
			{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
		</div>
		
		<script type="text/javascript">
		<!--
		$('input[type=submit]').click(function(e) {
			$('.all_day').remove();
		});
		
		function bindOptionalEvent(medForm){
			setMedChannel(medForm);
			setAllDay(medForm);
	        medForm.find("#med_channel").change(function(){
    	        setMedChannel(medForm);
    			setAllDay(medForm);
    	    });
	        medForm.find(".all_day :checkbox").change(function(){
    			setAllDay(medForm);
    	    });
		}

		function setMedChannel(medForm) {
			var medChannel = medForm.find("#med_channel:checked").get(0) || medForm.find("#med_channel[checked]").get(0);
			var allDay = medForm.find(".all_day :checkbox");
			if(medChannel.value == 'bolus'){
				allDay.prop('checked', false);
	        	medForm.find(".all_day").addClass('hide');
	        	medForm.find(".med_time_to").addClass('hide');
	        	medForm.find(".med_dose_hr").addClass('hide');
	        	// medForm.find(".med_dose").removeClass('hide');
	        } else if(medChannel.value == 'drip') {
	        	medForm.find(".all_day").removeClass('hide');
	        	medForm.find(".med_time_to").removeClass('hide');
	        	medForm.find(".med_dose_hr").removeClass('hide');
	        	// medForm.find(".med_dose").addClass('hide');
	        }
		}

		function setAllDay(medForm) {
			var allDay = medForm.find(".all_day :checkbox").get(0);
			if(allDay.checked){
	        	medForm.find(".med_time_from :text").prop("disabled", true).val('');
	        	medForm.find(".med_time_to :text").prop("disabled", true).val('');
			} else {
	        	medForm.find(".med_time_from :text").prop("disabled", false);
	        	medForm.find(".med_time_to :text").prop("disabled", false);
			}
		}
		//-->
		</script>