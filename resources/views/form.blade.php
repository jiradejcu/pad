	<script type="text/javascript">
	<!--
	$(function() {
		$(".input-group.date").datetimepicker({
            format: "DD-MM-YYYY LT",
            defaultDate: new Date(),
        });
		$(".input-group.time").datetimepicker({
            format: "LT",
        });
	});
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