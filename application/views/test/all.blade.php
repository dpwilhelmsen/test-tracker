@layout('templates.main')
@section('content') 
<button class="btn btn-primary" type="submit" onclick="$('#session_modal').modal({backdrop: 'static'});">Add Selected to Session</button>
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<td>&nbsp;</td>
			<td>Name</td>
			<td>Test Type</td>
			<td>Status</td>
			<td>Section</td>
			<td>Project</td>
			<td>Conditions</td>
			<td>Steps</td>
			<td>Assigned_id</td>
			<td>Author_id</td>
			<td>Created_at</td>
			<td>Updated_at</td>
		</tr>
	</thead>
	<tbody>
@foreach ($tests as $test)
        <tr>
        	<td><input type="checkbox" name="test" value="{{ $test->status }}" /></td>
            <td>{{ HTML::link('test/view/'.$test->id, $test->name) }}</td>
            <td>
            	@foreach ($test->types()->get() as $type) 
            		{{ $type->title }} <br /> 
            	@endforeach
            </td>
            <td>{{ $test->status }}</td>
            <td>
            	@foreach ($test->sections()->get() as $section) 
            		{{ $section->title }} <br /> 
            	@endforeach
            </td>
            <td>
            	@foreach ($test->projects()->get() as $project) 
            		{{ $project->title }} <br /> 
            	@endforeach
            </td>
            <td>{{ $test->conditions }}</td>
            <td>{{ $test->steps }}</td>
            <td>{{ $test->assigned_id }}</td>
            <td>{{ $test->author_id }}</td>
            <td>{{ $test->created_at }}</td>
            <td>{{ $test->updated_at }}</td>
        </tr>
@endforeach
	</tbody>
</table>
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