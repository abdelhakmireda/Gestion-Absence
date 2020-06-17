<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <title>Simple Sidebar - Start Bootstrap Template</title>
 <link href="/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
<style>
  
body {
  overflow-x: hidden;
}

#sidebar-wrapper {
  min-height: 100vh;
  margin-left: -15rem;
  -webkit-transition: margin .25s ease-out;
  -moz-transition: margin .25s ease-out;
  -o-transition: margin .25s ease-out;
  transition: margin .25s ease-out;
}

#sidebar-wrapper .sidebar-heading {
  padding: 0.875rem 1.25rem;
  font-size: 1.2rem;
}

#sidebar-wrapper .list-group {
  width: 15rem;
}

#page-content-wrapper {
  min-width: 100vw;
}

#wrapper.toggled #sidebar-wrapper {
  margin-left: 0;
}

@media (min-width: 768px) {
  #sidebar-wrapper {
    margin-left: 0;
  }

  #page-content-wrapper {
    min-width: 0;
    width: 100%;
  }

  #wrapper.toggled #sidebar-wrapper {
    margin-left: -15rem;
  }
}
.accordion {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}
.active, .accordion:hover {
  background-color: #ccc; 
}

.panel {
  padding: 0 18px;
  display: none;
  background-color: white;
  overflow: hidden;
}
.sidebar-heading{
  padding: 15px 0px !important;
  font-size: 1.1rem !important;  
}
a.bg-light:hover, a.bg-light:focus, button.bg-light:hover, button.bg-light:focus{
 background-color: #e4e4e4 !important;
 color: #fff; 
}
.active {
  background-color: #9c27b0 !important;
}
a{
  font-size: 14px !important;
  border-radius: 5px;
}
/* #9c27b0 */
</style>
</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">
        <a href="/main" class="logo-normal">
            <img src="/images/mortarboard.png">
          Attendance Management
        </a>
      </div>
      <ul class="nav my-2">

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
        </ul>
      <div class="list-group list-group-flush">
        <a href="#" class="list-group-item list-group-item-action active">
        <img src="/images/computing.png" alt="" class="mr-2">
        Dashboard</a>
        <a href="#" class="list-group-item list-group-item-action bg-light accordion">
        <img src="/images/computer.png" alt="" class="mr-2">
        Management</a>
          <div class="panel">
          <a class="dropdown-item list-group-item list-group-item-action" href="#">Action</a>
          <a class="dropdown-item list-group-item list-group-item-action" href="#">Action</a>
          <a class="dropdown-item list-group-item list-group-item-action" href="#">Action</a>
          <a class="dropdown-item list-group-item list-group-item-action" href="#">Action</a>
        
        </div>
        <a href="#" class="list-group-item list-group-item-action bg-light">        
          <img src="/images/hospital.png" alt="" class="mr-2">
            Calendar
        </a>
        <a href="#" class="list-group-item list-group-item-action bg-light">
          <img src="/images/signs.png" alt="" class="mr-2">Lougout
        </a>
        
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <a href="#" class="list-group-item list-group-item-action" id="menu-toggle">
          <img src="/images/menu.png" alt="">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid">
        <h1 class="mt-4">Vue Components</h1>
        <router-view></router-view> 

    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->
  <script src="{{ mix('js/app.js') }}"></script>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>
  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
    var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}

$(function() {
   $("a").click(function() {
      $("a").removeClass("active");
      $(this).addClass("active");
   });
});
  </script>
</body>
</html>

