		<script type="text/javascript">
		<!--
	    var next = 0;
		var medRecordName = "{!! $medRecordName !!}";
	    
		$(function() {
			$('input[type=submit]').click(function(e) {
				$('#medRecordTemplate').remove();
			});
			$('.med-record-field').each(function () {
				$(this).data("defaultName", medRecordName + '[%id%][' + $(this).attr("name") + ']');
			});

            var index = 0;
            $('.med-record').each(function(i){
                setMedRecordIndex($(this), ++index);
                bindButtonEvent($(this));
            });
            next = index;

            $(".med-record-field[type='radio']").each(function(i){
                if($(this).attr("checked") == "checked")
                    $(this).prop("checked", true);
            });

	        $('.add-record').click(function(e){
		        e.preventDefault();
		        addMedRecordForm();
		    });
		});

		function setMedRecordIndex(medForm, index){
	        medForm.attr('id','medRecord' + index);
	        medForm.removeAttr("style");
	        medForm.addClass('med-record');
	        medForm.find('.template').removeClass('template');
	        
	        medForm.find('.remove-record').data('recordId', index);
	        medForm.find('.med-record-field').each(function () {
		        $(this).data('recordId', index);
		        $(this).attr("name", $(this).data("defaultName").replace("%id%", $(this).data('recordId')));
	        });
	        medForm.find('.med-select').each(function () {
		        $(this).select2();
	        });
	        medForm.find('.indication-select').each(function () {
		        $(this).select2({ minimumResultsForSearch: Infinity });
	        });
	        setDateTimePicker(medForm);
		}

		function addMedRecordForm(){
	        var addTo = "#medRecord" + next;
	        if(next == 0)
		        addTo = "#medRecordTemplate";
	        next = next + 1;
	        
	        var medForm = $("#medRecordTemplate").clone(true);
	        setMedRecordIndex(medForm, next);
	        bindButtonEvent(medForm);
	        $(addTo).after(medForm);
		}

		function bindButtonEvent(medForm){
	        medForm.find('.remove-record').click(function(e){
                e.preventDefault();
                var record_id = $(this).data('recordId');
                $('#medRecord' + record_id).remove();

                var index = 0;
                $('.med-record').each(function(i){
	                setMedRecordIndex($(this), ++index);
                });
                next = index;
            });
            
	        if (typeof(bindOptionalEvent) == "function"){
	        	bindOptionalEvent(medForm);
	        }
		}
		//-->
		</script>