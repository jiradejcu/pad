		<div class="form-group">
			{!! Form::label('HN', 'HN :') !!}
			<?php
				$pkFieldAttr = ['class' => 'form-control'];
				if(!empty($disableKey)) $pkFieldAttr[] = 'readonly';
			?>
			{!! Form::text('HN', null, $pkFieldAttr) !!}
		</div>
		<div class="form-group">
			{!! Form::label('firstname', 'First Name :') !!}
			{!! Form::text('firstname', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('lastname', 'Last Name :') !!}
			{!! Form::text('lastname', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('age', 'Age :') !!}
			{!! Form::text('age', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('height', 'Height :') !!}
			{!! Form::text('height', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('apache_ii', 'Apache II :') !!}
			{!! Form::text('apache_ii', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('privilege', 'สิทธิ์ :') !!}
			{!! Form::text('privilege', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			<label class="radio-inline">{!! Form::radio('type', 'prospective', true) !!}Prospective</label>
			<label class="radio-inline">{!! Form::radio('type', 'retrospective') !!}Retrospective</label>
		</div>
		<hr/>
		<h2>Date</h2>
		<hr/>
			@include('form_control.datetime_from_to', ['datetime_name' => 'icu_admission_date', 'label_text' => 'ICU Admission Date'])
			<div class="form-group">
			@include('form_control.checkbox', ['checkbox_name' => 'death', 'label_text' => 'Death'])
			</div>
			<div class="form-group">
				{!! Form::label('icu_admission_from', 'ICU Admission From :') !!}
				{!! Form::text('icu_admission_from', null, ['class' => 'form-control']) !!}
			</div>
			@include('form_control.datetime_from_to', ['datetime_name' => 'hospital_admission_date', 'label_text' => 'Hospital Admission Date'])
			<div class="form-group">
				{!! Form::label('hospital_admission_from', 'Hospital Admission From :') !!}
				{!! Form::text('hospital_admission_from', null, ['class' => 'form-control']) !!}
			</div>
			@include('form_control.datetime_from_to', ['datetime_name' => 'ett_date', 'label_text' => 'ETT Date'])
		<hr/>
		<h2>Medical History</h2>
		<hr/>
			<div class="form-group">
				{!! Form::label('reason', 'Reason for ICU Admission :') !!}
				{!! Form::text('reason', null, ['class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('previous_meds', 'Previous Meds :') !!}
				{!! Form::text('previous_meds', null, ['class' => 'form-control']) !!}
			</div>
			@include('form_control.tri_state', ['radio_name' => 'allergy', 'label_text' => 'Allergy :', 'detail_text' => 1])
		<hr/>
		<h2>Underlying Diseases</h2>
		<hr/>
			@include('form_control.checkbox', ['checkbox_name' => 'cancer_solid', 'label_text' => 'Cancer(solid)', 'detail_text' => 1])
			@include('form_control.checkbox', ['checkbox_name' => 'cancer_hemato', 'label_text' => 'Cancer(hemato)', 'detail_text' => 1])
		<div class="form-group">
			@include('form_control.checkbox', ['checkbox_name' => 'dm', 'label_text' => 'DM'])
			@include('form_control.checkbox', ['checkbox_name' => 'htm', 'label_text' => 'HTN'])
			@include('form_control.checkbox', ['checkbox_name' => 'dlp', 'label_text' => 'DLP'])
		</div>
			@include('form_control.checkbox', ['checkbox_name' => 'ckd', 'label_text' => 'CKD', 'detail_text' => 1])
			@include('form_control.checkbox', ['checkbox_name' => 'cad', 'label_text' => 'CAD', 'detail_text' => 1])
		<div class="form-group">
			@include('form_control.checkbox', ['checkbox_name' => 'af', 'label_text' => 'AF'])
			@include('form_control.checkbox', ['checkbox_name' => 'valvular', 'label_text' => 'Valvular Disease'])
			@include('form_control.checkbox', ['checkbox_name' => 'cva', 'label_text' => 'CVA'])
			@include('form_control.checkbox', ['checkbox_name' => 'seizure', 'label_text' => 'Seizure'])
		</div>
			@include('form_control.checkbox', ['checkbox_name' => 'neuro', 'label_text' => 'Neuro Disease', 'detail_text' => 1])
		<div class="form-group">
			@include('form_control.checkbox', ['checkbox_name' => 'sle', 'label_text' => 'SLE'])
			@include('form_control.checkbox', ['checkbox_name' => 'ra', 'label_text' => 'RA'])
		</div>
			@include('form_control.checkbox', ['checkbox_name' => 'immune', 'label_text' => 'Immune', 'detail_text' => 1])
		<div class="form-group">
			@include('form_control.checkbox', ['checkbox_name' => 'osteoporosis', 'label_text' => 'Osteoporosis'])
			@include('form_control.checkbox', ['checkbox_name' => 'alzeimer', 'label_text' => 'Alzeimer'])
			@include('form_control.checkbox', ['checkbox_name' => 'psychi', 'label_text' => 'Psychi'])
			@include('form_control.checkbox', ['checkbox_name' => 'hypothyroid', 'label_text' => 'Hypothyroid'])
			@include('form_control.checkbox', ['checkbox_name' => 'hyperthyroid', 'label_text' => 'Hyperthyroid'])
			@include('form_control.checkbox', ['checkbox_name' => 'asthma', 'label_text' => 'Asthma'])
			@include('form_control.checkbox', ['checkbox_name' => 'copd', 'label_text' => 'COPD'])
		</div>
			@include('form_control.checkbox', ['checkbox_name' => 'others', 'label_text' => 'Others', 'detail_text' => 1])
			
		<hr/>
		<h2>Active Problems</h2>
		<hr/>
		<div class="form-group">
			@include('form_control.checkbox', ['checkbox_name' => 'septic_shock', 'label_text' => 'Septic Shock'])
			@include('form_control.checkbox', ['checkbox_name' => 'adrenal_shock', 'label_text' => 'Adrenal Shock'])
			@include('form_control.checkbox', ['checkbox_name' => 'hypovolemic_shock', 'label_text' => 'Hypovolemic Shock'])
			@include('form_control.checkbox', ['checkbox_name' => 'cardiogenic_shock', 'label_text' => 'Cardiogenic Shock'])
		</div>
		<div class="form-group">
			@include('form_control.checkbox', ['checkbox_name' => 'asthma_exacerbation', 'label_text' => 'Asthma Exacerbation'])
			@include('form_control.checkbox', ['checkbox_name' => 'copd_exacerbation', 'label_text' => 'COPD Exacerbation'])
			@include('form_control.checkbox', ['checkbox_name' => 'aki', 'label_text' => 'AKI'])
			@include('form_control.checkbox', ['checkbox_name' => 'liver_shock', 'label_text' => 'Liver Shock'])
			@include('form_control.checkbox', ['checkbox_name' => 'seizure_shock', 'label_text' => 'Seizure Shock'])
		</div>
			@include('form_control.checkbox', ['checkbox_name' => 'others_active', 'label_text' => 'Others', 'detail_text' => 1])
		<hr/>
		<div class="form-group">
			{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
		</div>
		
		<script type="text/javascript">
		<!--
		$(function() {
			$(":checkbox[name='death']").change(function() {
			    if(this.checked) {
			    	$(":text[name*='_to']").val($(":text[name='icu_admission_date_to']").val());
				}
			});
		});
		//-->
		</script>