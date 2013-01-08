<h2> Active Sessions</h2>
@if (isset($sessions[1]) and !empty($sessions[1]))
	@foreach ($sessions[1] as $session)
		{{ HTML::link('session/view/'.$session->id, 'Session #'.$session->id) }}<br />
	@endforeach
@else
	No Active Sessions
@endif
<h2>Completed Sessions</h2>
@if (isset($sessions[0]) and !empty($sessions[0]))
	@foreach ($sessions[0] as $session)
		Session #{{ $session->id }} <br />
	@endforeach
@else
	No Completed Sessions
@endif