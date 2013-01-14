@layout('templates.main')
@section('content') 
<h1>Session #{{ $session->id }} - {{ $session_project->title }}</h1>
<div class="test-container span6 offset3">
 	<div class="test">
 		<div class="row">
 			@if($prev)
        	<div class="span2">
        	{{ HTML::link('session/test/'.$session->id.'/'.$prev->id, '&larr; Previous Test.',  array('class'=>'previous-test')) }}
        	</div>
        	@endif
        	@if($next)
        	<div class="span2 pull-right align-right">
        	{{ HTML::link('session/test/'.$session->id.'/'.$next->id, 'Next Test. &rarr; ', array('class'=>'next-test')) }}
        	</div>
        	@endif
        </div>
        <hr class="reduced-margin" />
        <h1>{{ HTML::link('test/view/'.$test->id, $test->name) }}</h1>
        <hr class="reduced-margin" />
        <div class="row">
        <div class="span2">
        	<h4 class="test-status">Test Status:</h4>
        </div>
        <div class="span2 pull-right align-right">
        @if($scheduled_test->status === '1')
        	{{ Button::disabled_success_link('#', 'Passsed') }}
        @elseif($scheduled_test->status == '-1')
        	{{ Button::disabled_danger_link('#', 'Failed') }}
        @else
	        {{ Button::success_link('#', 'Pass', array('class'=>'status-btn', 'data-status'=>'pass')) }}
	        {{ Button::danger_link('#', 'Fail', array('class'=>'status-btn', 'data-status'=>'fail')) }}
	        {{ Button::inverse_link('#', 'Skip', array('class'=>'status-btn', 'data-status'=>'skip')) }}
        @endif
        </div>
        </div>
        <hr class="reduced-margin" />
        <div class="test-label"><b>Description: </b></div>
        <div class="test-field">{{ $test->description }}</div>
        <div class="test-label"><b>Test Type: </b></div>
        <div class="test-field">@foreach ($taxonomy['test_type'] as $type) {{ $type->title }} @endforeach</div>
        <div class="test-label"><b>Section: </b></div>
        <div class="test-field">@foreach ($taxonomy['section'] as $section) {{ $section->title }}, @endforeach</div>
        <div class="test-label"><b>Project: </b></div>
        <div class="test-field">
        @foreach ($taxonomy['project'] as $project) 
        	{{ HTML::link('project/view/'.$project->id, $project->title) }} 
        @endforeach</div>
        <div class="test-label"><b>Conditions: </b></div>
        <div class="test-field">{{ $test->conditions }}</div>
        <div class="test-label"><b>Steps: </b></div>
        <div class="test-field">{{ nl2br($test->steps) }}</div>
        <div class="test-label"><b>Assigned to: </b></div>
        <div class="test-field">{{ $test->assigned_id }}</div>
        <input type="hidden" name="scheduled_test_id" id="scheduled-test-id" value="{{ $scheduled_test->id }}" />
        <input type="hidden" name="project_id" id="project-id" value="{{ $session_project->id }}" />
    </div>
</div>
@endsection