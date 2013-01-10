@layout('templates.main')
@section('content') 
<h2>Session Tests</h2>
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<td>Name</td>
			<td>Session Creator</td>
		</tr>
	</thead>
	<tbody>
@foreach ($scheduled_tests as $scheduled_test)
        <tr>
            <td>
            {{ HTML::link('session/view/'.$scheduled_test->id, $scheduled_test->test()->first()->name) }}
            </td>
            <td></td>
        </tr>
@endforeach
	</tbody>
</table>
@endsection