<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Control Panel - @yield('title')</title>

    <!-- Bootstrap -->
    <link href="{{ url("/css/bootstrap.min.css") }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="{{ url('css/main-admin.css') }}">

    @yield('headIncludes')
  </head>
  <body>


<!-- Header -->
<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-toggle"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/') }}" target="_blank">Go to website</a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        
        <li class="dropdown">
          <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#">
            <i class="glyphicon glyphicon-user"></i> {{Auth::user()->name}} <span class="caret"></span></a>
          <ul id="g-account-menu" class="dropdown-menu" role="menu">            
            <li><a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="glyphicon glyphicon-lock"></i> Logout</a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>                                           
          </ul>
        </li>
      </ul>
    </div>
  </div><!-- /container -->
</div>
<!-- /Header -->

<!-- Main -->
<div class="container">
  
  <!-- upper section -->
  <div class="row">
  <div class="col-sm-3">
      <!-- left -->
      <h3><i class="glyphicon glyphicon-briefcase"></i> Control Panel</h3>
      <hr>
      
      <ul class="nav nav-stacked">
        <li><a href="{{ url('/admin') }}"><i class="glyphicon glyphicon-home"></i> Home</a></li>
        <li><a href="{{ url('/admin/users') }}"><i class="glyphicon glyphicon-user"></i> Users</a></li>
        <li><a href="{{ url('/admin/sections') }}"><i class="glyphicon glyphicon-list-alt"></i> Albums</a></li>
        <li><a href="{{ url('/admin/photos') }}"><i class="glyphicon glyphicon-picture"></i> Photos</a></li>
        <li><a href="{{ url('/admin/comments') }}"><i class="glyphicon glyphicon-comment"></i> Comments</a></li>
      </ul>
      
      <hr>
      
    </div><!-- /span-3 -->
    <div class="col-sm-9">
        
      <!-- column 2 --> 
       <h3><i class="glyphicon glyphicon-@yield('glyphicon')"></i> @yield('header')</h3>  
            
       <hr>
      
     <div class="row">


      @yield('content')

       </div><!--/row-->
    </div><!--/col-span-9-->
    
  </div><!--/row--> 

</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    
    <script src="{{ url('/js/bootstrap.min.js') }}"></script>

    @yield('bodyIncludes')
  </body>
</html>