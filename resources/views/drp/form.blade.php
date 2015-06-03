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
			{!! Form::select('problem_main', $problem_master, null, ['class' => 'form-control', 'data-toggle' => 'main']) !!}
			{!! Form::select('problem', [], null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('cause', 'Cause :') !!}
			{!! Form::select('cause_main', $cause_master, null, ['class' => 'form-control', 'data-toggle' => 'main']) !!}
			{!! Form::select('cause', [], null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('intervention', 'Intervention :') !!}
			{!! Form::select('intervention_main', $intervention_master, null, ['class' => 'form-control', 'data-toggle' => 'main']) !!}
			{!! Form::select('intervention', [], null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('outcome', 'Outcome of Intervention :') !!}
			{!! Form::select('outcome_main', $outcome_master, null, ['class' => 'form-control', 'data-toggle' => 'main']) !!}
			{!! Form::select('outcome', [], null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			@include('form_control.checkbox', ['checkbox_name' => 'med_recon', 'label_text' => 'Medication Reconciliation'])
		</div>
		<div class="form-group">
			{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
		</div>
		
		<script type="text/javascript">
		<!--
		$(function() {
			$('[data-toggle="main"]').each(retrieveDrpMaster);
			$('[data-toggle="main"]').change(retrieveDrpMaster);
		});

		function retrieveDrpMaster(){
			var name = this.name.substr(0, this.name.indexOf("_main"));
			$.getJSON('{{ url('/drp/master') }}/'+this.value, function(data) {
			    $("[name='"+name+"']").empty();
			    $.each(data, function(key, value){
			        $("[name='"+name+"']").append('<option value="'+ key +'">'+ value +'</option>');
			    });
			});
		}
		//-->
		</script>