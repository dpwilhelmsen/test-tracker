(function($, window, document, undefined) {
	$(document).ready(function(){
		$('.status-btn').on('click', function(){
		    var id = $('#scheduled-test-id').val();
		    var status = $(this).data('status');
		    var next_test = $('a.next-test').attr('href');
		    if(!next_test) next_test = BASE+"/project/view/"+$('#project-id').val();
		    $.ajax({
				type: "POST",
				url: BASE+"/session/resolve",
				data: {'test':id, 'status':status},
				success: function(response){
					window.location.replace(next_test);
				}
			});
		});
	});
	
}(jQuery, window, document));