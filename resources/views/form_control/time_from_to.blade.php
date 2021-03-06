<?php $form_class = !empty($form_class) ? ' ' . $form_class : ''; ?>
<?php $group_class = !empty($group_class) ? $group_class : ''; ?>
<div class="form-group">
	<div class="form-group {!! $time_name !!}_from">
		{!! Form::label($time_name . '_from', 'From :') !!}
		<div class='input-group time {!! $group_class !!}' style="width: 150px">
			{!! Form::input('text', $time_name . '_from', null, ['class' => 'form-control' . $form_class]) !!}
			<span class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
			</span>
		</div>
	</div>
	<div class="form-group {!! $time_name !!}_to">
		{!! Form::label($time_name . '_to', 'To :') !!}
		<div class='input-group time {!! $group_class !!}' style="width: 150px">
			{!! Form::input('text', $time_name . '_to', null, ['class' => 'form-control' . $form_class]) !!}
			<span class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
			</span>
		</div>
	</div>
</div>