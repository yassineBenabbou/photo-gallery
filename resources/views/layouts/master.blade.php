<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <style type="text/css">
      .navbar {
        color:rgb(147,3,46, 0.6);
      }
    </style>
    <!-- Bootstrap -->
    <link href="{{ url("/css/bootstrap.min.css") }}" rel="stylesheet">  
    <link rel="stylesheet" type="text/css" href="{{ url("/css/main.css") }}">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    

    @yield('headIncludes')
  

  </head>
  <body>



    <!-- Second navbar for sign in -->
    <nav class="navbar navbar-default">
      <div class="container" >
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-2">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ url('/') }}">Wedding Gallery</a>
        </div>
    
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse-2">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="#">Contact</a></li>
            @if (Auth::check())
                @if(Auth::user()->isAdmin())
                    <li><a href="{{ url('/admin') }}">AdminCP</a></li>
                @endif
                <li class="avatar"><img src="{{ Auth::user()->avatar() }}"> {{ Auth::user()->name }}</li>
                <li><a class="btn btn-default btn-outline btn-circle" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form> 
            @else
                <li><a class="btn btn-default btn-outline btn-circle" href="{{ url('/login') }}">Login/Register</a><li>
            @endif
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

    <div class="container-fluid">
            
      @yield('content')
     
    </div>

  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="{{ url('/js/bootstrap.min.js') }}"></script>

    

    @yield('bodyIncludes')

  </body>
</html>