		<ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#basic_tab">Basic</a></li>
          <li><a data-toggle="tab" href="#apache_tab">Apache II</a></li>
        </ul>
        <br>
        <div class="tab-content">
            <div id="basic_tab" class="tab-pane fade in active">
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
                {!! Form::label('sex', 'Sex :') !!}
                <div class="form-group">
                    <label class="radio-inline">{!! Form::radio('sex', 'm') !!}Male</label>
                    <label class="radio-inline">{!! Form::radio('sex', 'f') !!}Female</label>
                </div>
                <hr/>
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
                {!! Form::label('type', 'Type :') !!}
                <div class="form-group">
                    <label class="radio-inline">{!! Form::radio('type', 'prospective', true) !!}Prospective</label>
                    <label class="radio-inline">{!! Form::radio('type', 'retrospective') !!}Retrospective</label>
                    <label class="radio-inline">{!! Form::radio('type', 'unknown') !!}Unknown</label>
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
                    @include('form_control.checkbox', ['checkbox_name' => 'cirrhosis', 'label_text' => 'Cirrhosis'])
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
                <div class="form-group">
                    @include('form_control.checkbox', ['checkbox_name' => 'ugib', 'label_text' => 'UGIB'])
                    @include('form_control.checkbox', ['checkbox_name' => 'coagulopathy', 'label_text' => 'Coagulopathy'])
                    @include('form_control.checkbox', ['checkbox_name' => 'anemia', 'label_text' => 'Anemia'])
                </div>
                    @include('form_control.checkbox', ['checkbox_name' => 'others_active', 'label_text' => 'Others', 'detail_text' => 1])
                <hr/>
            </div>
            <div id="apache_tab" class="tab-pane fade">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('apache_ii_score', 'Apache II Score :') !!}
                            {!! Form::text('apache_ii_score', null, ['id' => 'apache_ii_score', 'class' => 'form-control', 'tabindex' => -1, 'readonly']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('age', 'Age :') !!}
                            {!! Form::text('age', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('temperature', 'Temperature :') !!}
                            {!! Form::text('temperature', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('mean_arterial_pressure', 'Mean Arterial Pressure :') !!}
                            {!! Form::text('mean_arterial_pressure', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('heart_rate', 'Heart Rate :') !!}
                            {!! Form::text('heart_rate', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('respiratory_rate', 'Respiratory Rate :') !!}
                            {!! Form::text('respiratory_rate', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('fio2', 'FiO2 :') !!}
                            {!! Form::text('fio2', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('aapo2', 'A-aPO2 :') !!}
                            {!! Form::text('aapo2', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('pao2', 'PaO2 :') !!}
                            {!! Form::text('pao2', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('ph', 'Arterial pH :') !!}
                            {!! Form::text('ph', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('hco3', 'HCO3 :') !!}
                            {!! Form::text('hco3', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('serum_na', 'Serum Na+ :') !!}
                            {!! Form::text('serum_na', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('serum_k', 'Serum K+ :') !!}
                            {!! Form::text('serum_k', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('creatinine', 'Creatinine :') !!}
                            {!! Form::text('creatinine', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('hematocrit', 'Hematocrit :') !!}
                            {!! Form::text('hematocrit', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('wbc', 'WBC Count :') !!}
                            {!! Form::text('wbc', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('glasgow_coma', 'Glasgow Coma :') !!}
                            {!! Form::text('glasgow_coma', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('age_score', 'Age Score :') !!}
                            {!! Form::text('age_score', null, ['class' => 'form-control', 'tabindex' => -1, 'readonly']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('temperature_score', 'Temperature Score :') !!}
                            {!! Form::text('temperature_score', null, ['class' => 'form-control', 'tabindex' => -1, 'readonly']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('mean_arterial_pressure_score', 'Mean Arterial Pressure Score :') !!}
                            {!! Form::text('mean_arterial_pressure_score', null, ['class' => 'form-control', 'tabindex' => -1, 'readonly']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('heart_rate_score', 'Heart Rate Score :') !!}
                            {!! Form::text('heart_rate_score', null, ['class' => 'form-control', 'tabindex' => -1, 'readonly']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('respiratory_rate_score', 'Respiratory Rate Score :') !!}
                            {!! Form::text('respiratory_rate_score', null, ['class' => 'form-control', 'tabindex' => -1, 'readonly']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('fio2_score', 'FiO2 Score :') !!}
                            {!! Form::text('fio2_score', null, ['class' => 'form-control', 'tabindex' => -1, 'readonly']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('aapo2_score', 'A-aPO2 Score :') !!}
                            {!! Form::text('aapo2_score', null, ['class' => 'form-control', 'tabindex' => -1, 'readonly']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('pao2_score', 'PaO2 Score :') !!}
                            {!! Form::text('pao2_score', null, ['class' => 'form-control', 'tabindex' => -1, 'readonly']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('ph_score', 'Arterial pH Score :') !!}
                            {!! Form::text('ph_score', null, ['class' => 'form-control', 'tabindex' => -1, 'readonly']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('hco3_score', 'HCO3 Score :') !!}
                            {!! Form::text('hco3_score', null, ['class' => 'form-control', 'tabindex' => -1, 'readonly']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('serum_na_score', 'Serum Na+ Score :') !!}
                            {!! Form::text('serum_na_score', null, ['class' => 'form-control', 'tabindex' => -1, 'readonly']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('serum_k_score', 'Serum K+ Score :') !!}
                            {!! Form::text('serum_k_score', null, ['class' => 'form-control', 'tabindex' => -1, 'readonly']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('creatinine_score', 'Creatinine Score :') !!}
                            {!! Form::text('creatinine_score', null, ['class' => 'form-control', 'tabindex' => -1, 'readonly']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('hematocrit_score', 'Hematocrit Score :') !!}
                            {!! Form::text('hematocrit_score', null, ['class' => 'form-control', 'tabindex' => -1, 'readonly']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('wbc_score', 'WBC Count Score :') !!}
                            {!! Form::text('wbc_score', null, ['class' => 'form-control', 'tabindex' => -1, 'readonly']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('glasgow_coma_score', 'Glasgow Coma Score :') !!}
                            {!! Form::text('glasgow_coma_score', null, ['class' => 'form-control', 'tabindex' => -1, 'readonly']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
			var add_admission = $(":checkbox[name='add_admission']");
			add_admission.prop('checked', true);
		});
		//-->
		</script>

	    <script src="{{ asset('/js/apache_ii.js') }}"></script>