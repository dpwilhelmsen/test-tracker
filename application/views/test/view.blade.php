@layout('templates.main')
@section('content') 
<div class="test-container span6 offset3">
 	<div class="test">
        <hr class="reduced-margin" />
        <h1>{{ HTML::link('test/view/'.$test->id, $test->name) }}</h1>
        <hr class="reduced-margin" />
        <div class="row-fluid">
        <div class="span4">
        	<h4 class="test-status">Test Status:</h4>
        </div>
        <div class="span8 pull-right align-right">
        	{{ Button::link('test/edit/'.$test->id, 'Edit') }}
        </div>
        </div>
        <hr class="reduced-margin" />
        <div class="row-fluid">
        <div class="test-label"><b>Description: </b></div>
        <div class="test-field">{{ $test->description }}</div>
        <div class="test-label"><b>Test Type: </b></div>
        <div class="test-field">@foreach ($taxonomy['test_type'] as $type) {{ $type->title }} @endforeach</div>
        <div class="test-label"><b>Section: </b></div>
        <div class="test-field">@if($test->area) {{ $test->area->title }} @endif</div>
        <div class="test-label"><b>Project: </b></div>
        <div class="test-field">
        @foreach ($taxonomy['project'] as $project) 
        	{{ HTML::link('project/view/'.$project->id, $project->title) }} 
        @endforeach</div>
        <div class="test-label"><b>Conditions: </b></div>
        <div class="test-field">{{ $test->conditions }}</div>
        <div class="test-label"><b>Steps: </b></div>
        <div class="test-field">{{ $test->steps }}</div>
        </div>
    </div>
</div>
 	
@endsection