@layout('templates.main')
@section('content') 
<button class="btn btn-primary" type="submit" onclick="$('#session_modal').modal({backdrop: 'static'});">Add Selected to Session</button>
@include('test.test_table')
<div class="modal hide" id="session_modal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h3>Add Tests to Session</h3>
	</div>
	<div class="modal-body">
		<form class="well modal-form" method="POST" action="{{ URL::to('sessions/add') }}" id="session_modal_form">
			<div class="inline-block">
			<label for="new_session">New Session</label>
			<input type="text" name="new_session" id="new_session" />
			</div>
			<div class="inline-block">OR</div>
			<div class="inline-block">
			<label for="existing_session">Existing Session</label>
				<select name="existing_session">
					  <option value="">Select a Session</option>
				</select>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal">Cancel</a>
		<button type="button" id="add-to-session-button" class="btn btn-primary">Add to Session</a>
	</div>
</div>
@endsection