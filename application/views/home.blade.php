@layout('templates.main')
@section('content') 
@if(Auth::guest())
<div class="row-fluid">
<div class="span12" style="text-align:center">
<h1>Welcome</h1>
{{Button::large_primary_link('#', 'Signup / Login', array('class'=>'login-btn')) }}
</div>
</div>
@endif
<div class="row-fluid">
<div class="span6">
<h2>Active Projects</h2>
@if(isset($projects))
@foreach($projects as $project)
	<div class="row-fluid border-row">
		<div class="span12">
			{{ HTML::link('project/view/'.$project->id, $project->title) }}
		</div>
	</div>
@endforeach
@else
	No active projects
@endif
</div>
<div class="span6">
<h2>Active Sessions</h2>
@if(isset($sessions))
@foreach($sessions as $session)
	<div class="row-fluid border-row">
		<div class="span12">
			{{ HTML::link('session/view/'.$session->id, 'Session #'.$session->id) }}
		</div>
	</div>
@endforeach
@else
	No active projects
@endif
</div>

</div>
@endsection
