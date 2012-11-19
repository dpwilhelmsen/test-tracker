@layout('templates.main')
@section('content') 
    @if (Session::has('success_message'))
    <div class="span8">
        {{ Alert::success("Success! Post deleted!") }}
        </div>
    @endif
    
@endsection
