@layout('templates.main')
@section('content') 
 	<div class="test">
        <h1>{{ HTML::link('test/view/'.$test->id, $test->name) }}</h1>
        <p><b>Description: </b>{{ $test->description }}</p>
        <p><b>Test Type: </b>@foreach ($taxonomy['test_type'] as $type) {{ $type->title }} @endforeach</p>
        <p><b>Current Status: </b>{{ $test->status }}</p>
        <p><b>Section: </b>@foreach ($taxonomy['section'] as $section) {{ $section->title }} @endforeach</p>
        <p><b>Project: </b>@foreach ($taxonomy['project'] as $project) {{ $project->title }} @endforeach</p>
        <p><b>Conditions: </b>{{ $test->conditions }}</p>
        <p><b>Steps: </b>{{ $test->steps }}</p>
        <p><b>Assigned to: </b>{{ $test->assigned_id }}</p>
        <p><b>Author: </b>{{ $test->author_id }}</p>
        <p><b>Created at: </b>{{ $test->created_at }}</p>
        <p><b>Last Updated: </b>{{ $test->updated_at }}</p>
        <p><b></b>{{ HTML::link('test/all/', '&larr; Back to index.') }}</p>
    </div>
@endsection