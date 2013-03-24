@layout('templates.main')
@section('content')
@if ( !Auth::guest() ) 
{{ Button::link('#', 'New Project', array('class'=>'pull-right', 'id'=>'new-project-modal-btn')) }}
@endif
<h1>Active Projects</h1>
@if(!empty($projects['active']))
<table class="table">
	<thead>
		<th>Project Name</th>
		<th></th>
	</thead>
	<tbody>
	@foreach($projects['active'] as $project)
	<tr>
		<td>{{ $project->title }}</td>
		<td>
		<div class="pull-right">
			{{ HTML::link('project/view/'.$project->id, 'View', array('class'=>'btn btn-primary')) }}
			@if ( !Auth::guest() )
			{{ HTML::link('project/complete/'.$project->id, 'Complete', array('class'=>'btn btn-primary')) }}
			@endif
		</div>
		</td>
	</tr>
	@endforeach
	</tbody>
</table>
@else
	<p>No Active Projects</p>
@endif
<h1>Compelted Projects</h1>
@if(!empty($projects['completed']))
<table class="table">
	<thead>
		<th>Project Name</th>
		<th></th>
	</thead>
	<tbody>
	@foreach($projects['completed'] as $project)
	<tr>
		<td>{{ $project->title }}</td>
		<td>
		<div class="pull-right">
			{{ Button::primary_link('project/view/'.$project->id, 'View') }}
			@if ( !Auth::guest() )
			{{  Button::primary_link('project/active/'.$project->id, 'Activate') }}
			@endif
		</div>
		</td>
	</tr>
	@endforeach
	</tbody>
</table>
@else
	<p>No Completed Projects</p>
@endif
@if(!Auth::guest())
	<div class="modal hide" id="project_modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3>Add a New Project</h3>
    </div>
	@include('project.new')
	</div>
@endif
@endsection