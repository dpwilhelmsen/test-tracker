<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<td id="checkbox-toggle"><input type="checkbox" /></td>
					<td>Name</td>
					<td>Test Type</td>
					<td>Status</td>
					<td>Section</td>
					<td>Project</td>
					<td>Conditions</td>
					<td>Steps</td>
					<td>Assigned_id</td>
					<td>Author_id</td>
					<td>Created_at</td>
					<td>Updated_at</td>
				</tr>
			</thead>
			<tbody>
		@foreach ($tests as $test)
		        <tr>
		        	<td class="select-test-checkbox">
		        		<input type="checkbox" name="test" value="{{ $test->id }}" />
		        	</td>
		            <td>{{ HTML::link('test/view/'.$test->id, $test->name) }}</td>
		            <td>
		            	@foreach ($test->types()->get() as $type) 
		            		{{ $type->title }} <br /> 
		            	@endforeach
		            </td>
		            <td>{{ $test->status }}</td>
		            <td>
		            	@if($test->area)
		            	{{ $test->area->title }}
		            	@endif
		            </td>
		            <td>
		            	@foreach ($test->projects()->get() as $project) 
		            		{{ $project->title }} <br /> 
		            	@endforeach
		            </td>
		            <td>{{ $test->conditions }}</td>
		            <td>{{ $test->steps }}</td>
		            <td>{{ $test->assigned_id }}</td>
		            <td>{{ $test->author_id }}</td>
		            <td>{{ $test->created_at }}</td>
		            <td>{{ $test->updated_at }}</td>
		        </tr>
		@endforeach
			</tbody>
		</table>
@if(!Auth::Guest())
	@include('plugins/create')
@endif