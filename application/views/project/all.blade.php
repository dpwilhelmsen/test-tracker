@layout('templates.main')
@section('content') 
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
			{{ HTML::link('project/view/'.$project->id, 'Set as Complete', array('class'=>'btn btn-primary')) }}
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
@if(!empty($projects['compelted']))
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
			{{  Button::primary_link('project/view/'.$project->id, 'Set as Complete') }}
		</div>
		</td>
	</tr>
	@endforeach
	</tbody>
</table>
@else
	<p>No Completed Projects</p>
@endif
@endsection