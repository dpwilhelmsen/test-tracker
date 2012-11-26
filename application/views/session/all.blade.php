@layout('templates.main')
@section('content') 
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<td>Name</td>
			<td>Session Creator</td>
		</tr>
	</thead>
	<tbody>
@foreach ($sessions as $session)
        <tr>
            <td>{{ HTML::link('session/view/'.$session->id, $session->title) }}</td>
            <td>{{ $session->user()->first()->name}}</td>
        </tr>
@endforeach
	</tbody>
</table>
@endsection