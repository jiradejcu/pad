<?php $form_class = !empty($form_class) ? ' ' . $form_class : ''; ?>
<div class="form-group">
	{!! Form::label($datetime_name, $label_text) !!}<br>
	{!! Form::label($datetime_name . '_from', 'From :') !!}
	<div class='input-group date'>
		{!! Form::input('text', $datetime_name . '_from', null, ['class' => 'form-control' . $form_class]) !!}
		<span class="input-group-addon">
			<span class="glyphicon glyphicon-calendar"></span>
		</span>
	</div>
	{!! Form::label($datetime_name . '_to', 'To :') !!}
	<div class='input-group date'>
		{!! Form::input('text', $datetime_name . '_to', null, ['class' => 'form-control' . $form_class]) !!}
		<span class="input-group-addon">
			<span class="glyphicon glyphicon-calendar"></span>
		</span>
	</div>
</div>