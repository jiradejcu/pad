<div class="form-group">
	{!! Form::label($radio_name, $label_text) !!}<br>
	<label class="radio-inline">{!! Form::radio($radio_name, '-', true) !!}N/A</label>
	<label class="radio-inline">{!! Form::radio($radio_name, 0) !!}NO</label>
	<label class="radio-inline">{!! Form::radio($radio_name, 1) !!}YES</label>
	@if(!empty($detail_text))
	{!! Form::text($radio_name . '_detail', null, ['class' => 'form-control']) !!}
	@endif
</div>