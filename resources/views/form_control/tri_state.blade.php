<? $form_class = !empty($form_class) ? ' ' . $form_class : ''; ?>
<div class="form-group">
	{!! Form::label($radio_name, $label_text) !!}<br>
	<label class="radio-inline">{!! Form::radio($radio_name, '-', true, ['class' => $form_class]) !!}N/A</label>
	<label class="radio-inline">{!! Form::radio($radio_name, 0, null, ['class' => $form_class]) !!}No</label>
	<label class="radio-inline">{!! Form::radio($radio_name, 1, null, ['class' => $form_class]) !!}Yes</label>
	@if(!empty($detail_text))
	{!! Form::text($radio_name . '_detail', null, ['class' => 'form-control' . $form_class]) !!}
	@endif
</div>