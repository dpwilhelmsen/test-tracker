<div class="modal hide" id="create_modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3>Add a New Test</h3>
    </div>
    <div class="modal-body">
        <form class="well"  autocomplete='off' method="post" action="{{ URL::to('test/add') }}" id="create_modal_form">
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
			<label id="type_group">Type</label>
			<ul class="form-list">
			@foreach (Type::all() as $type_option)
			    <li>
			    	<label>
			    		<input value="{{$type_option->id}}" type="checkbox" name="type_option[]" />
			    		{{ $type_option->title }}
			    	</label>
			    </li>
			@endforeach
				<li>
					<a class="show-add">+ Add new type</a>
					<div class="hidden add">
						<label for="type" id="project">Type Name</label>
						<input name="type" type="text" />
					</div>
				</li>
			</ul>
			<div class="test-label"><b>Section: </b></div>
	        <div class="test-field">
	        {{ 	Typeahead::create(Utilities::allSections(), 4, array('name'=>'section','class' => 'span3', 'style' => 'margin: 0 auto;','value'=> Input::old('section'))) }}</div>
	        <div class="test-label"><b>Conditions: </b></div>
	        <div class="test-field">{{ $ckeditor->editor('conditions', Input::old('conditions'), Utilities::ckConfig()) }}</div>
	        <div class="test-label"><b>Steps: </b></div>
	        <div style="clear:both; margin-bottom:20px;">
	        {{ $ckeditor->editor('steps', Input::old('steps'), Utilities::ckConfig()); }}
	        </div>
	        <input type="hidden" name="session" id="session" value='{{ (isset($session)) ? $session->id : '' }}' />
		</form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Cancel</a>
        <button type="button" id="add-test-button" class="btn btn-primary">Create Test</a>
    </div>
</div>
