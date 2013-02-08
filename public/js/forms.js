(function($, window, document, undefined) {
	$(document).ready(function(){
		$('#login-button').on('click', function(){
			var ajax_data = $('div.tab-pane.active form.modal-form').serialize();
			var submit_url = $('div.tab-pane.active form.modal-form').attr('action');
			$('.modal-form .alert').remove();
			$.ajax({
				type: "POST",
				url: submit_url,
				data: ajax_data,
				success: function(response){
					var response = $.parseJSON(response);
					if(response.status == 'success') location.reload(true);
					if(response.status == 'error'){
						$('.active .modal-form').prepend('<div class="alert alert-error">'+response.message+'</div>');
					}
				}
			});
		});
		
		$('#add-test-button').on('click', function(){
			$('#create_modal_form').submit();
		});
		
		$('#add-to-session-button').on('click', function(){
			$('#session_modal_form').submit();
		});
		$('#new-project-btn').on('click', function(){
			$('')
		});
		$('.show-add').on('click', function(){
			$(this).siblings('.add').toggleClass('hidden');
		})
	});
}(jQuery, window, document));