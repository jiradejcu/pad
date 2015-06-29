		<script type="text/javascript">
		<!--
	    var next = 0;
		var medRecordName = "{!! $medRecordName !!}";
	    
		$(function() {
			$('input[type=submit]').click(function() {
				$('#medRecordTemplate').remove();
				$("[name^='" + medRecordName + "']").each(function () {
					$(this).attr("name", $(this).attr("name").replace("%id%", $(this).data('recordId')));
				});
			});
			addMedRecordForm();
		});

		function setMedRecordIndex(medForm, index){
	        medForm.attr('id','medRecord' + index);
	        medForm.removeAttr("style");
	        medForm.addClass('medRecord');
	        
	        medForm.find('.remove-record').data('recordId', index);
	        medForm.find("[name^='" + medRecordName + "']").each(function () {
		        $(this).data('recordId', index);
	        });
	        medForm.find('.med-select').each(function () {
		        $(this).select2();
	        });
		}

		function addMedRecordForm(){
	        var addTo = "#medRecord" + next;
	        if(next == 0)
		        addTo = "#medRecordTemplate";
	        next = next + 1;
	        
	        var medForm = $("#medRecordTemplate").clone();
	        $(addTo).after(medForm);
	        setMedRecordIndex(medForm, next);
	        
	        medForm.find(".add-record").click(function(e){
		        e.preventDefault();
		        addMedRecordForm();
		    });
		    
	        medForm.find('.remove-record').click(function(e){
                e.preventDefault();
                var record_id = $(this).data('recordId');
                $('#medRecord' + record_id).remove();

                var index = 0;
                $('.medRecord').each(function(i){
	                setMedRecordIndex($(this), ++index);
                });
                next = index;
            });
		}
		//-->
		</script>