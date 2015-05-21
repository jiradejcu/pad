<div class="form-group">
	{!! Form::label($checkbox_name, $label_text) !!}
	{!! Form::hidden($checkbox_name, '0') !!}
	{!! Form::checkbox($checkbox_name) !!}
	{!! Form::text($checkbox_name . 'detial', null, ['class' => 'form-control']) !!}
</div>