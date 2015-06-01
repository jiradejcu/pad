		<div class="form-group">
			{!! Form::label('date_recorded', 'Date :') !!}
			<div class='input-group date'>
				{!! Form::input('text', 'date_recorded', null, ['class' => 'form-control']) !!}
	            <span class="input-group-addon">
	            	<span class="glyphicon glyphicon-calendar"></span>
	            </span>
            </div>
		</div>
		<div class="form-group">
			{!! Form::label('hn', 'HN :') !!}
			{!! Form::text('hn', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('problem', 'Problem :') !!}
			{!! Form::text('problem', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('cause', 'Cause :') !!}
			{!! Form::text('cause', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('intervention', 'Intervention :') !!}
			{!! Form::text('intervention', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('outcome', 'Outcome of Intervention :') !!}
			{!! Form::text('outcome', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			@include('form_control.checkbox', ['checkbox_name' => 'med_recon', 'label_text' => 'Medication Reconciliation'])
		</div>
		<div class="form-group">
			{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
		</div>