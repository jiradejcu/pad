<?php $form_class = !empty($form_class) ? ' ' . $form_class : ''; ?>
@if(!empty($detail_text))
<div class="form-group">
@endif
{!! Form::hidden($checkbox_name, '0', ['class' => $form_class]) !!}
<label class="checkbox-inline">{!! Form::checkbox($checkbox_name, 1, null, ['class' => $form_class]) !!}{{ $label_text }}</label>
@if(!empty($detail_text))
{!! Form::text($checkbox_name . '_detail', null, ['class' => 'form-control' . $form_class]) !!}
</div>
@endif