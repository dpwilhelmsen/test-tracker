@layout('templates.main')
@section('content') 
<h3>Add a New Test</h3>

<form class="well" method="post" action="{{ URL::to('test/add') }}" id="create_modal_form">
	<label for="title">Test Title</label>
	<input name="title" type="text" />
	<label for="description">Description</label>
	<textarea name="description" cols="20" rows="3"></textarea>
	<label for="type">Type</label>
	<input name="type" type="text" />
	<label for="section">Section</label>
	<input name="section" type="text" />
	<label for="project" id="project">Project</label>
	<input name="project" type="text" />
	<label for="conditions">Conditions</label>
	<textarea name="conditions" cols="20" rows="3"></textarea>
	<label for="steps">Steps</label>
	<textarea name="steps" cols="20" rows="3"></textarea>
</form>
<button type="button" onclick="$('#create_modal_form').submit();" class="btn btn-primary">Create Test</a>


@endsection