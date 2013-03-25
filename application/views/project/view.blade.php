@layout('templates.main')
@section('content') 
 	<div class="test">
        <h1>{{ HTML::link('project/view/'.$project->id, $project->title) }}</h1>
        <div>{{ $project->description }}</div>
        <input type="hidden" id="project_id" name="project_id" value="{{ $project->id }}" />
        {{ $sections }}
        <p><b></b>{{ HTML::link('project/all/', '&larr; Back to Projects.') }}</p>
    </div>
<div class="modal hide" id="import_modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3>Import Tests from CSV</h3>
    </div>
    <div class="modal-body">
       {{ Form::open_for_files('test/import', 'POST', array('id'=>'import-form')) }}
       <div class="test-label"><b>
       Upload CSV
       </b></div>
       <div class="test-field" style="position:relative; margin-bottom:20px;">
       {{ Form::file('csv') }}
       </div>
	        <input type="hidden" name="session" id="session" value='{{ (isset($session)) ? $session->id : '' }}' />

    <div class="modal-footer" style="clear:both;">
        <a href="#" class="btn" data-dismiss="modal">Cancel</a>
        <button type="button" id="import-btn" class="btn btn-primary">Import</a>
    </div>
</div>
    
@endsection