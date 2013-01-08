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
@foreach ($sessions[1] as $session)
        <tr>
            <td>
            {{ HTML::link('session/view/'.$session->id, $session->title) }}
            </td>
            <td></td>
        </tr>
@endforeach
	</tbody>
</table>
@endsection