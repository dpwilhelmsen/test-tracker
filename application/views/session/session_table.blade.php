<h2> Active Sessions</h2>
@if (isset($sessions['active']) and !empty($sessions['active']))
	@foreach ($sessions['active'] as $session)
		Session #{{ $session->id }} <br />
	@endforeach
@else
	No Active Sessions
@endif
<h2>Completed Sessions</h2>
@if (isset($sessions['completed']) and !empty($sessions['completed']))
	@foreach ($sessions['completed'] as $session)
		Session #{{ $session->id }} <br />
	@endforeach
@else
	No Completed Sessions
@endif