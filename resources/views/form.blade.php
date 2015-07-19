	<script type="text/javascript">
	<!--
	$(function() {
		setDateTimePicker($('form'));
	});

	function setDateTimePicker(element){
		element.find(".input-group.date").not('.template').datetimepicker({
            format: "DD-MM-YYYY LT",
            defaultDate: new Date(),
        });
		element.find(".input-group.time").not('.template').datetimepicker({
            format: "LT",
        });
	}
	//-->
	</script>
	<script src="{{ asset('/js/vendor.js') }}"></script>
	<link href="{{ asset('/css/vendor.css') }}" rel="stylesheet">
	
	<style>
		.divider-vertical {
			margin: 0 10px;
			padding: 8px 0;
			border-left: 2px solid #AAA;
		}
		.space-vertical {
			margin: 0 10px;
			padding: 8px 0;
		}
		.hide {
			display: none;
		}
	</style>