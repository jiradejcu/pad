
<div class="form-group">
	{!! Form::label($datetime_name, $label_text) !!}<br>
	{!! Form::label('from', 'From :') !!}
	<div class='input-group date'>
		{!! Form::input('text', $datetime_name . '_from', null, ['class' => 'form-control']) !!}
		<span class="input-group-addon">
			<span class="glyphicon glyphicon-calendar"></span>
		</span>
	</div>
	{!! Form::label('to', 'To :') !!}
	<div class='input-group date'>
		{!! Form::input('text', $datetime_name . '_to', null, ['class' => 'form-control']) !!}
		<span class="input-group-addon">
			<span class="glyphicon glyphicon-calendar"></span>
		</span>
	</div>
</div>