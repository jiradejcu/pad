{!! Form::hidden($checkbox_name, '0') !!}
<label class="checkbox-inline">{!! Form::checkbox($checkbox_name) !!}{{ $label_text }}</label>
@if(!empty($detail_text))
{!! Form::text($checkbox_name . 'detial', null, ['class' => 'form-control']) !!}
@endif