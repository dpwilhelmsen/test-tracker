@layout('templates.main')
@section('content') 
 	<div class="test">
        <h1>{{ HTML::link('project/view/'.$project->id, $project->title) }}</h1>
        <div>{{ $project->description }}</div>
        <input type="hidden" id="project_id" name="project_id" value="{{ $project->id }}" />
        {{ $sections }}
        <p><b></b>{{ HTML::link('project/all/', '&larr; Back to Projects.') }}</p>
    </div>
@endsection