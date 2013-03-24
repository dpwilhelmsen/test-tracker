(function($, window, document, undefined) {
	$(document).ready(function(){		
		$('#selected_tests').on('click', function(){
			var ids   = new Array();
		    $("input[name=test]:checked").each(function(){
		         ids.push(this.value);
		    });
			//alert('Selected Tests:' + ids);
		    session_submit(ids, $('#project_id').val());
		});
		
		$('#checkbox-toggle input[type=checkbox]').click(function(){  
		    if( $(this).attr('checked') ){  
		        $('.select-test-checkbox input[type=checkbox]').attr('checked','checked');  
		    }else{  
		        $('.select-test-checkbox input[type=checkbox]').removeAttr('checked');  
		    }  
		});  
		
		$('.requeue').click(function(){
			$.ajax({
				type: "POST",
				url: BASE+"/project/requeue_session",
				data: {'project':$('#project_id').val(), 'session':$(this).data('session')},
				success: function(response){
					$('#session-container').html(response);
				}
			});
		});
	});
	
	function session_submit(ids, project)
	{
		$.ajax({
			type: "POST",
			url: BASE+"/project/create_session",
			data: {'tests':ids, 'project':project},
			success: function(response){
				$('#session-container').html(response.markup);
				$('.nav-tabs a:first').tab('show');
			}
		});
	}
	
}(jQuery, window, document));