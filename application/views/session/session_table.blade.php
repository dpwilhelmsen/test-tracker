<h2> Active Sessions</h2>
@if (isset($sessions[1]) and !empty($sessions[1]))
	@foreach ($sessions[1] as $session)
	<div class="row-fluid border-row">
		{{ HTML::link('session/view/'.$session->id, 'Session #'.$session->id) }}
	</div>
	@endforeach
@else
	No Active Sessions
@endif
<h2>Completed Sessions</h2>
@if (isset($sessions[0]) and !empty($sessions[0]))
	@foreach ($sessions[0] as $session)
	<div class="row-fluid border-row">
		<div class="span8">
		Session #{{ $session->id }}
		</div>
		<div class="span4">
			<div class="pull-right">
			{{ Button::primary_link('session/view/'.$session->id, 'View Results') }}
			@if ( !Auth::guest() )
			{{ Button::primary_link('#', 'Requeue Session', array('class'=>'requeue','data-session'=>$session->id)) }}
			@endif
			</div>
		</div>
	</div>
	@endforeach
@else
	No Completed Sessions
@endif