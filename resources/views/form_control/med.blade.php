		<script type="text/javascript">
		<!--
	    var next = 0;
		var medRecordName = "{!! $medRecordName !!}";
	    
		$(function() {
			$('input[type=submit]').click(function(e) {
				$('#medRecordTemplate').remove();
			});
			$("#medRecordTemplate [name^='" + medRecordName + "']").each(function () {
				$(this).data("defaultName", $(this).attr("name"));
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
		        $(this).attr("name", $(this).data("defaultName").replace("%id%", $(this).data('recordId')));
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
	        
	        var medForm = $("#medRecordTemplate").clone(true);
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