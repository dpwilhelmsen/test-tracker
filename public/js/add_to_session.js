(function($, window, document, undefined) {
	$(document).ready(function(){
		$('#all_tests').on('click', function(){
			var ids   = new Array();
		    $("input[name=test]").each(function(){
		         ids.push(this.value);
		    });
			alert('All Tests'+ ids);
		    session_submit(ids, $('#project_id').val());
		});
		
		$('#selected_tests').on('click', function(){
			var ids   = new Array();
		    $("input[name=test]:checked").each(function(){
		         ids.push(this.value);
		    });
			alert('Selected Tests:' + ids);
		    session_submit(ids, $('#project_id').val());
		});
	});
	
	function session_submit(ids, project)
	{
		$.ajax({
			type: "POST",
			url: BASE+"/project/create_session",
			data: {'tests':ids, 'project':project},
			success: function(response){
				alert(response['data']);
			}
		});
	}
	
}(jQuery, window, document));