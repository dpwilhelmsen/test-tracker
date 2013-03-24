@layout('templates.main')
@section('content') 
<h2>Session Tests</h2>
@if ( !Auth::guest() )
{{ $buttons }}
@endif
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<td>Name</td>
			<td>Test Status</td>
			<td>Performed By</td>
		</tr>
	</thead>
	<tbody>
@foreach ($scheduled_tests as $scheduled_test)
        <tr>
            <td>
            {{ HTML::link('session/test/'.$session->id.'/'.$scheduled_test->test()->first()->id, $scheduled_test->test()->first()->name) }}
            </td>
            <td>
            @if((int) $scheduled_test->status === 1)
            <span style="color:green">Passed</span>
            @elseif((int) $scheduled_test->status === -1)
            <span style="color:red">Failed</span>
            @else
            Not Complete
            @endif</td>
            <td>
            	@if($scheduled_test->completed_user()->get())
            		{{ Underscore::first($scheduled_test->completed_user()->get())->username }}
            	@endif
            </td>
        </tr>
@endforeach
	</tbody>
</table>
@if(!Auth::Guest())
	@include('plugins/create')
@endif
@endsection