@layout('templates.main')
@section('content') 
<div class="test-container span6 offset3">
{{ Form::open('test/save', 'POST', array('class' => 'awesome', 'autocomplete'=>'off')) }}
 	<div class="test">
        <hr class="reduced-margin" />
        <h1>{{ Form::text('name', Input::old('name') ?: $test->name, array('class'=>'title-input', 'placeholder'=>'Test Title')) }}</h1>
        <hr class="reduced-margin" />
        <div class="row-fluid">
	        <div class="test-label"><b>Description: </b></div>
	        <div class="test-field">{{ Form::textarea('description', Input::old('description') ?:$test->description) }}</div>
	        <div class="test-label"><b>Project</b></div>
	        <div class="test-field">
			<ul class="form-list">
			@foreach (Project::all() as $project_option)
			    <li>
			    	<label>
			    		<input value="{{$project_option->id}}" type="checkbox" name="project_option[]" 
			    		@if (isset($taxonomy['project']))
			    			@foreach($taxonomy['project'] as $project)
			    				@if($project->id === $project_option->id)
			    					checked="checked"
			    				@endif
			    			@endforeach
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
						{{ Form::textarea('project', Input::old('project')) }}
					</div>
				</li>
			</ul>
			</div>
			<div class="test-label"><b>Type</b></div>
			<div class="test-field">
			<ul class="form-list">
			@foreach (Type::all() as $type_option)
			    <li>
			    	<label>
			    		<input value="{{$type_option->id}}" type="checkbox" name="type_option[]"
			    		@if (isset($taxonomy['test_type']))
			    			@foreach($taxonomy['test_type'] as $type)
			    				@if($type->id === $type_option->id)
			    					checked="checked"
			    				@endif
			    			@endforeach
			    		@endif
			    		 />
			    		{{ $type_option->title }}
			    	</label>
			    </li>
			@endforeach
				<li>
					<a class="show-add">+ Add new type</a>
					<div class="hidden add">
						<label for="type" id="project">Type Name</label>
						{{ Form::textarea('type', Input::old('type')) }}
					</div>
				</li>
			</ul>
			</div>
	        <div class="test-label"><b>Section: </b></div>
	        <div class="test-field">
	        {{ 	Typeahead::create(Utilities::allSections(), 4, array('name'=>'section','class' => 'span3', 'style' => 'margin: 0 auto;','value'=> Input::old('section')?:($test->area)?$test->area->title:'')) }}</div>
	        <div class="test-label"><b>Conditions: </b></div>
	        <div class="test-field">{{ $ckeditor->editor('conditions', Input::old('conditions')?:$test->conditions, Utilities::ckConfig()) }}</div>
	        <div class="test-label"><b>Steps: </b></div>
	        <div style="clear:both; margin-bottom:20px;">
	        {{ $ckeditor->editor('steps', Input::old('steps')?:$test->steps, Utilities::ckConfig()); }}
	        </div>
	        {{ Button::success_submit('Save', array('class'=>'pull-right')) }}
	        {{ Form::hidden('id',$test->id) }}
			{{ Form::token() . Form::close() }}
        </div>
    </div>
</div>
 	
@endsection