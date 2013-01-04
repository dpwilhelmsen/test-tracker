(function($, window, document, undefined) {
	$(document).ready(function(){
		$('#login-button').on('click', function(){
			$('div.tab-pane.active form.modal-form').submit();
		});
		
		$('#add-test-button').on('click', function(){
			$('#create_modal_form').submit();
		});
		
		$('#add-to-session-button').on('click', function(){
			$('#session_modal_form').submit();
		});
	});
}(jQuery, window, document));