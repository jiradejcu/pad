<?php $form_class = !empty($form_class) ? ' ' . $form_class : ''; ?>
<div class="form-group">
	{!! Form::label($radio_name, $label_text) !!}<br>
	<label class="radio-inline">{!! Form::radio($radio_name, '0', true, ['class' => $form_class]) !!}Not Eval</label>
	<label class="radio-inline">{!! Form::radio($radio_name, '-', null, ['class' => $form_class]) !!}Unable to Access</label>
	<label class="radio-inline">{!! Form::radio($radio_name, -1, null, ['class' => $form_class]) !!}Negative</label>
	<label class="radio-inline">{!! Form::radio($radio_name, 1, null, ['class' => $form_class]) !!}Positive</label>
	@if(!empty($detail_text))
	{!! Form::text($radio_name . '_detail', null, ['class' => 'form-control' . $form_class]) !!}
	@endif
</div>