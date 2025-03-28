<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assetUser/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assetUser/img/favicon.png') }}">
  <title>
    Naftal @yield('title', 'Dashboard')
  </title>
<style>
</style>
  <!-- In your main layout file (e.g., resources/views/layouts/app.blade.php) -->
<!-- Add these lines before the closing </body> tag -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Chat Support CSS -->
<link rel="stylesheet" href="{{ asset('css/chat.css') }}">
<!-- Chart  JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />

<!-- Chat Support JS -->
  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <link href="{{ asset('assetUser/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assetUser/css/nucleo-svg.css') }}" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assetUser/css/material-dashboard.css?v=3.2.0') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('assetUser/css/style.css') }}">
</head>


<body class="g-sidenav-show bg-gray-100">
  

  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href="{{ route('dashboard') }}">
        <img src="{{ asset('assets/img/logo-ct-dark.png') }}" class="navbar-brand-img" width="26" height="26" alt="main_logo">
        <span class="ms-1 text-sm text-dark">Creative Tim</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ Route::is('dashboard') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('dashboard') }}">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Dashboard </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::is('tickets') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{  route('employee.tickets.list')}}">
            <i class="material-symbols-rounded opacity-5">table_view</i>
            <span class="nav-link-text ms-1">All Tickets</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::is('tickets') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{  route('dasboard.tickets')}}">
            <i class="material-symbols-rounded opacity-5">table_view</i>
            <span class="nav-link-text ms-1">Create Ticket</span>
          </a>
        </li>

 

        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::is('profile') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('employee.profile.edit') }}">
            <i class="material-symbols-rounded opacity-5">person</i>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        @auth
          <li class="nav-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
              @csrf
              <button type="submit" class="nav-link text-dark border-0 bg-transparent p-0" style="cursor: pointer;">
                <i class="material-symbols-rounded opacity-5">login</i>
                <span class="nav-link-text ms-1">Logout</span>
              </button>
            </form>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('login') }}">
              <i class="material-symbols-rounded opacity-5">login</i>
              <span class="nav-link-text ms-1">Sign In</span>
            </a>
          </li>
        @endauth
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0">
      <!-- Footer content can be added here if needed -->
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">@yield('breadcrumb', 'Dashboard')</li>
          </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              <label class="form-label">Type here...</label>
              <input type="text" class="form-control">
            </div>
          </div>
          <ul class="navbar-nav d-flex align-items-center justify-content-end">
            @auth
              <li class="nav-item d-flex align-items-center">
                <a href="{{ route('employee.profile.edit') }}" class="nav-link text-body font-weight-bold px-0">
                  <i class="material-symbols-rounded">account_circle</i>
                  <span class="ms-1">{{ Auth::user()->username }}</span>
                </a>
              </li>
            @else
              <li class="nav-item d-flex align-items-center">
                <a href="{{ route('login') }}" class="nav-link text-body font-weight-bold px-0">
                  <i class="material-symbols-rounded">account_circle</i>
                </a>
              </li>
            @endauth
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    @if (session('success'))
      <div class="alert alert-success mx-3">
        {{ session('success') }}
      </div>
    @endif

    @if (session('error'))
      <div class="alert alert-danger mx-3">
        {{ session('error') }}
      </div>
    @endif
    @yield('content')
  </main>
<div class="" id="chatIcon"></div>chatIcon
  <!-- Core JS Files -->
  <script src="{{ asset('assetUser/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assetUser/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assetUser/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assetUser/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assetUser/js/plugins/chartjs.min.js') }}"></script>
  <!-- Chart JS scripts remain unchanged unless needed -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="{{ asset('assetUser/js/material-dashboard.min.js?v=3.2.0') }}"></script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
  var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
  s1.async=true;
  s1.src='https://embed.tawk.to/67e1ce8cf421cd1907c2765e/1in50tlkd';
  s1.charset='UTF-8';
  s1.setAttribute('crossorigin','*');
  s0.parentNode.insertBefore(s1,s0);
  })();
  </script>

  <!--End of Tawk.to Script-->
  <script type="text/javascript">
    var Tawk_API = Tawk_API || {};

    @if(Auth::check())
        Tawk_API.onLoad = function() {
            Tawk_API.setAttributes({
                'name'  : "{{ Auth::user()->name }}",
                'email' : "{{ Auth::user()->department_name }}",
                'hash'  : "{{ hash_hmac('sha256', Auth::user()->department_name, env('TAWK_API_KEY')) }}"
            }, function(error) {
                console.log("Tawk.to attributes updated!", error);
            });
        };
    @endif
</script>





</body>
</html>