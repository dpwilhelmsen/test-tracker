<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Test Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    {{ Asset::container('bootstrapper')->styles(); }}
    {{ Asset::styles() }}
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    {{ Asset::container('bootstrapper')->scripts(); }} 
    {{ Asset::scripts() }}
</head>
<body>
     <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="{{ URL::base() }}">Test Tracker</a>
          <div class="btn-group pull-right">       
            @if ( Auth::guest() )
              <a class="btn"  onclick="$('#login_modal').modal({backdrop: 'static'});">
                <i class="icon-user"></i> Login
              </a>
            @else
            <span style="font-size:14px">Welcome, <strong>{{ HTML::link('admin', Auth::user()->username) }} </strong> |
                {{ HTML::link('logout', 'Logout') }}
            </span>
            @endif
                 
          </div>
          <div class="nav-collapse">
            <ul class="nav">
              <li><a href="{{ URL::base() }}">Home</a></li>
              @if ( !Auth::guest() )
              <li><a href="#" onclick="$('#create_modal').modal({backdrop: 'static'});">
          			Add New Test</a></li>
              @endif
              <li>
              	<a href="{{ URL::to('project/all')}}">Projects</a>
              </li>
              <li>
              	<a href="{{ URL::to('test/all')}}">Tests</a>
              </li>
              <li>
              	<a href="{{ URL::to('session/all')}}">Sessions</a>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
 
    <div class="container">
          <div class="row">
          @include('plugins.status')
          @yield('content')
          </div>
          @yield('pagination')
    </div><!--/container-->
 
    <div class="container">
        <footer>
            <p>Test Tracker &copy; 2012</p>
        </footer>
      </div>
      	@if ( !Auth::guest() )
      		@include('plugins/create')
      	@else
      		@include('plugins/login')
      	@endif
</body>
@if(isset($base))
	<script type="text/javascript">var BASE = "{{ $base }}";</script>
@endif
</html>