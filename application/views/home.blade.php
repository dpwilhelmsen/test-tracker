@layout('templates.main')
@section('content') 
<div class="span6">
Projects
</div>
<div class="span6">
Sessions
</div>
    @if (Session::has('success_message'))
    <div class="span8">
        {{ Alert::success("Success! Post deleted!") }}
        </div>
    @endif
    
@endsection
