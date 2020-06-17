<!DOCTYPE html>
<html lang="en">

<head>
  <title>Attendance management</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <link href="/css/custom.css" rel="stylesheet" />
  <style>
  .active{
    background-color: #9c27b0 !important;
  }
  </style>
</head>

<body class="">
  <div id="app" class="wrapper">
    <div class="sidebar" data-color="purple" data-background-color="white">
      <div class="logo ml-3">
        <a href="/main" class="logo-normal">
        <i class="material-icons">school</i>
          Attendance Management
        </a>
      </div>
      <div class="sidebar-wrapper">
        <nav class="mt-2">
        <ul class="nav">

          <li class="nav-item">
            <a class="nav-link" href="#">
            <img class="img-profile rounded-circle" src="/images/user_60x60.jpg">
                <span class="mr-2 d-none d-lg-inline text-gray-700 medium">
                @if(Auth::user())
              {{ Auth::user()->name }}                
              @else
                John Doe
              @endif
                </span>
            </a>
          </li>
            <li class="nav-item active">
               <router-link to="/dashboard" class="nav-link">
                   <i class="material-icons">dashboard</i>
                <p>
                 Dashboard
                </p>
              </router-link>
            </li>
            
            <li class="nav-item has-treeview menu-close">
            <a href="/" class="nav-link"  id="menuToggle">
              <p>
                Management
                   <i class="material-icons">dashboard</i>
              </p>
            </a>
            <ul class="nav nav-treeview hide" id="menu" style="display:none;">
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
                <router-link to="/attendance" class="nav-link">
                   <i class="material-icons">assignment_turned_in</i>
                  <p>Attendance</p>
                </router-link>
              </li>

            </ul>
          </li>
            <li class="nav-item">
              <router-link to="/calendar" class="nav-link">
                <i class="material-icons">calendar_today</i>
                <p>
                 Calendar
                </p>
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
          <!-- your sidebar here -->
        </ul>
      </nav>
      </div>
    </div>


    <div class="main-panel">
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
            <div class="col">
              Nav Menu 
            </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
            <router-view></router-view> 
        </div>
      </div>
    </div>
  </div>
  <script src="{{ mix('js/app.js') }}"></script>
</body>
<script>
  $(function() {
   $("li").click(function() {
      $("li").removeClass("active");
      $(this).addClass("active");
   });
});

  $(function() {
   $("li").click(function() {
      $("li").removeClass("active");
      $(this).addClass("active");
      console.log(this);
   });
});



  $(document).ready(function(){
  $("#menuToggle").click(function(){
    $("#menu").toggle();
  });
});
</script>
</html>