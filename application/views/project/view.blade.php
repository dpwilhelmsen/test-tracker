@layout('templates.main')
@section('content') 
 	<div class="test">
        <h1>{{ HTML::link('project/view/'.$project->id, $project->title) }}</h1>
        <div>{{ $project->description }}</div>
        {{ $btn }}
		@include('test.test_table')
        <p><b></b>{{ HTML::link('project/all/', '&larr; Back to Projects.') }}</p>
    </div>
@endsection