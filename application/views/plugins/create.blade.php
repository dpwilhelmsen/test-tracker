<div class="modal hide" id="create_modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3>Add a New Test</h3>
    </div>
    <div class="modal-body">
        <form class="well" method="post" action="{{ URL::to('test/add') }}" id="create_modal_form">
			<label for="title">Test Title</label>
			<input name="title" type="text" />
			<label for="description">Description</label>
			<textarea name="description" cols="20" rows="3"></textarea>
			<label id="project_group">Project</label>
			<ul class="form-list">
			@foreach (Project::all() as $project_option)
			    <li>
			    	<label>
			    		<input value="{{$project_option->id}}" type="checkbox" name="project_option[]" 
			    		@if (isset($project) && $project->id === $project_option->id)
			    		checked="checked"
			    		@endif
			    		 />
			    		{{ $project_option->title }}
			    	</label>
			    </li>
			@endforeach
				<li>
					<a class="show-add">+ Add new project</a>
					<div class="hidden add">
						<label for="project" id="project">Project Name</label>
						<input name="project" type="text" />
					</div>
				</li>
			</ul>
			<label for="type">Type</label>
			<input name="type" type="text" />
			<label for="section">Section</label>
			<input name="section" type="text" />
			<label for="conditions">Conditions</label>
			<textarea name="conditions" cols="20" rows="3"></textarea>
			<label for="steps">Steps</label>
			<textarea name="steps" cols="20" rows="3"></textarea>
		</form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Cancel</a>
        <button type="button" id="add-test-button" class="btn btn-primary">Create Test</a>
    </div>
</div>
