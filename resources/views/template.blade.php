<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>Gestion d'absence</title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link href="/css/material-dashboard.min.css" rel="stylesheet" />
</head>
<style>
  .activated{
    background-color: #9c27b0 !important;
    color: #fff;
  }
  </style>
<body class="">
  <div class="wrapper" id="app">
    <div class="sidebar" data-color="purple" data-background-color="white">
      <div class="m-2">
        <a href="/main" class="logo-normal">
            <img src="/images/mortarboard.png">
          Attendance Management
        </a>
      </div>
      <ul class="nav my-3">
          <li class="nav-item">
            <router-link class="nav-link" to="/profile" id="profile">
              <div class="card-avatar d-flex align-items-center justify-content-md-start">
                    <img class="img-profile rounded-circle" src="{{ asset('images/admin.jpg') }}" style="width:50px; height:50px; border-color: #ea4c89;">
                    <div class="userData ml-2">

                @if(Auth::user())
                {{ Auth::user()->name }}
                <br>
                <span id='userType' class="text-primary">
                    {{ Auth::user()->user_type }}
                </span>
              @else
                John Doe<br>
                CEO
              @endif
          </div>

              </div>
            </router-link>
          </li>
        </ul>
      <div class="sidebar-wrapper">
        <ul class="nav">
		  <li class="nav-item">
               <router-link to="/dashboard" class="nav-link activated">
                   <i class="material-icons">dashboard</i>
                <p>
                 Dashboard
                </p>
              </router-link>
           </li>
            {{-- @can('isAdmin') --}}
            <li class="nav-item">
            <a href="#" id="menuToggle" class="nav-link">
              <p>
                Management
                   <i class="material-icons">settings</i>
              </p>
            </a>
            <ul class="nav" id="menu" style="display:none;">
              <li class="nav-item">
                <router-link to="/admin" class="nav-link">
                   <i class="material-icons">how_to_reg</i>
                  <p>Admins</p>
                </router-link>
              </li>

              <li class="nav-item">
                <router-link to="/teacher" class="nav-link">
                   <i class="material-icons">person</i>
                  <p>Teachers</p>
                </router-link>
              </li>

              <li class="nav-item">
                <router-link to="/student" class="nav-link">
                   <i class="material-icons">people</i>
                  <p>Student</p>
                </router-link>
              </li>

              <li class="nav-item">
                <router-link to="/module" class="nav-link">
                   <i class="material-icons">assignment</i>
                  <p>Module</p>
                </router-link>
              </li>

              <li class="nav-item">
                <router-link to="/filliere" class="nav-link">
                   <i class="material-icons">assignment_turned_in</i>
                  <p>Filliere</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/element" class="nav-link">
                   <i class="material-icons">assignment_turned_in</i>
                  <p>Element</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/department" class="nav-link">
                   <i class="material-icons">assignment_turned_in</i>
                  <p>Department</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/attendance" class="nav-link">
                   <i class="material-icons">assignment_turned_in</i>
                  <p>Attendance</p>
                </router-link>
              </li>
            </ul>
          </li>
          {{-- @endcan --}}

          <li class="nav-item">
                <router-link to="/attendance" class="nav-link">
              <i class="material-icons">assignment_turned_in</i>
              <p>Absence</p>
                </router-link>
             </li>

          <li class="nav-item">
                <router-link to="/calendar" class="nav-link">
              <i class="material-icons">calendar_today</i>
              <p>Calendar</p>
                </router-link>
          </li>
          <li class="nav-item">
             <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
              <i class="material-icons">logout</i>
               <p> {{ __('Logout') }}</p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      	<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
        </div>
      	</nav>


	<div class="content" style="margin-top:0px !important;">
        <div class="container-fluid">
            <router-view></router-view>
        </div>
      </div>
    </div>
  </div>

  <!--   Core JS Files   -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script>
	$(document).ready(function() {
   $("li a").click(function() {
      $("li a").removeClass("activated");
      $("#profile").css('background-color', '');
      $(this).addClass("activated");
   })
});
    $(document).ready(function() {
   $("#profile").click(function() {
      $("#profile").removeClass("activated");
      $(this).css('background-color', '#eee');
   })
});

  $(document).ready(function(){
  $("#menuToggle").click(function(){
    $("#menu").toggle();
  });
});
  </script>
  <script src="{{ mix('js/app.js') }}"></script>
  <script src="/js/popper.min.js"></script>
  <script src="/js/material-dashboard.min.js?v=2.1.2" type="text/javascript"></script>
</body>

</html>
