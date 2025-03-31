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
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <link href="{{ asset('assetUser/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assetUser/css/nucleo-svg.css') }}" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assetUser/css/material-dashboard.css?v=3.2.0') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('assetUser/css/style.css') }}">
  <!-- Chat Support CSS -->
  <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
  <!-- Chart JS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
  
  <!-- Custom styles with dark mode support -->
  <style>
    :root {
      /* Light mode variables */
      --primary-color: #e91e63;
      --accent-color: #e91e63;
      --text-color: #344767;
      --text-muted: #7b809a;
      --bg-main: #f8f9fa;
      --bg-card: #ffffff;
      --bg-sidenav: #ffffff;
      --border-color: #dee2e6;
      --shadow-color: rgba(0, 0, 0, 0.05);
      --hover-bg: rgba(233, 30, 99, 0.1);
      --chart-grid: rgba(0, 0, 0, 0.05);
      --icon-color: #344767;
      --sidenav-toggler-bg: #f8f9fa;
      --sidenav-toggler-line: #344767;
    }
    
    /* Dark mode variables */
    .dark-mode {
      --primary-color: #e91e63;
      --accent-color: #bb86fc;
      --text-color: #e9ecef;
      --text-muted: #adb5bd;
      --bg-main: #000000;
      --bg-card: #1e1e1e;
      --bg-sidenav: #1a1a1a;
      --border-color: #2d2d2d;
      --shadow-color: rgba(255, 255, 255, 0.2);
      --hover-bg: rgba(233, 30, 99, 0.15);
      --chart-grid: rgba(255, 255, 255, 0.05);
      --icon-color: #e9ecef;
      --sidenav-toggler-bg: #1a1a1a;
      --sidenav-toggler-line: #e9ecef;
    }
    
    body {
      background-color: var(--bg-main);
      color: var(--text-color);
      transition: background-color 0.3s ease, color 0.3s ease;
    }
    
    /* Sidebar styling */
    .sidenav {
      background-color: var(--bg-sidenav);
      box-shadow: 0 4px 6px var(--shadow-color);
      border-right: 1px solid var(--border-color);
      transition: all 0.3s ease;
    }
    
    .sidenav .navbar-nav .nav-link {
      color: var(--text-color);
      border-radius: 0.5rem;
      margin: 0.1rem 0.5rem;
      padding: 0.675rem 1rem;
      transition: all 0.2s ease;
    }
    
    .sidenav .navbar-nav .nav-link:hover:not(.active) {
      background-color: var(--hover-bg);
    }
    
    .sidenav .navbar-nav .nav-link.active {
      background-color: var(--primary-color) !important;
      color: #ffffff !important;
      font-weight: 500;
      box-shadow: 0 4px 6px rgba(233, 30, 99, 0.2);
    }
    
    .sidenav-header {
      height: 70px;
      display: flex;
      align-items: center;
      border-bottom: 1px solid var(--border-color);
    }
    
    .sidenav-footer {
      border-top: 1px solid var(--border-color);
    }
    
    /* Main content styling */
    .main-content {
      transition: all 0.3s ease;
    }
    
    .card {
      background-color: var(--bg-card);
      border: none;
      box-shadow: 0 4px 6px var(--shadow-color);
      transition: all 0.3s ease;
    }
    
    .card-header {
      background-color: var(--bg-card);
      border-bottom: 1px solid var(--border-color);
    }
    
    /* Navbar styling */
    .navbar-main {
      background-color: var(--bg-card);
      border-bottom: 1px solid var(--border-color);
    }
    
    .breadcrumb-item, .breadcrumb-item a {
      color: var(--text-muted);
    }
    
    .breadcrumb-item.active {
      color: var(--text-color);
    }
    
    /* Form elements */
    .input-group-outline {
      border: 1px solid var(--border-color);
      background-color: var(--bg-card);
    }
    
    .input-group-outline .form-control {
      color: var(--text-color);
    }
    
    /* Alerts */
    .alert {
      border-radius: 0.5rem;
    }
    
    /* Dark mode toggle */
    .mode-toggle {
      cursor: pointer;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
      background-color: var(--bg-card);
      color: var(--text-color);
      border: 1px solid var(--border-color);
    }
    
    .mode-toggle:hover {
      background-color: var(--hover-bg);
    }
    
    /* Chat icon */
    #chatIcon {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 999;
      cursor: pointer;
      background-color: var(--primary-color);
      color: white;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }
    
    #chatIcon:hover {
      transform: scale(1.1);
    }
    
    /* Chart styling */
    .chart-container {
      background-color: var(--bg-card);
      border-radius: 10px;
      padding: 15px;
      box-shadow: 0 4px 6px var(--shadow-color);
      margin-bottom: 20px;
    }
    
    canvas {
      max-width: 100%;
      background-color: var(--bg-card);
      border-radius: 8px;
      padding: 10px;
    }
    
    /* Mobile menu toggle */
    .sidenav-toggler-inner {
      width: 18px;
      height: 18px;
      position: relative;
    }
    
    .sidenav-toggler-line {
      height: 2px;
      background-color: var(--sidenav-toggler-line);
      display: block;
      position: absolute;
      width: 100%;
      left: 0;
      transition: all 0.2s ease;
    }
    
    .sidenav-toggler-line:nth-child(1) {
      top: 0;
    }
    .span1{
      color: var(--text-color)
    }
    .sidenav-toggler-line:nth-child(2) {
      top: 8px;
    }
    
    .sidenav-toggler-line:nth-child(3) {
      top: 16px;
    }
    
    /* Fix for SVG icons in dark mode */
    .material-symbols-rounded {
      color: var(--icon-color);
    }
    
    .sidenav .material-symbols-rounded {
      color: inherit;
    }
    
    /* Dropdown menu in dark mode */
    .dropdown-menu {
      background-color: var(--bg-card);
      border: 1px solid var(--border-color);
      box-shadow: 0 4px 10px var(--shadow-color);
    }
    
    .dropdown-item {
      color: var(--text-color);
    }
    
    .dropdown-item:hover {
      background-color: var(--hover-bg);
      color: var(--text-color);
    }
    
    /* Fix for mobile sidenav */
    @media (max-width: 991.98px) {
      .sidenav {
        transform: translateX(-100%);
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1050;
        height: 100vh;
        width: 250px !important;
        margin: 0 !important;
        border-radius: 0 !important;
      }
      
      .sidenav.show {
        transform: translateX(0);
      }
      
      .main-content {
        margin-left: 0 !important;
      }
      
      .navbar-toggler {
        display: block;
      }
      
      .sidenav-header .navbar-brand {
        color: var(--text-color);
        margin-left: 1rem;
      }
      
      .sidenav-toggler-inner {
        margin-top: 0.25rem;
      }
    }
    
    /* Button primary custom */
    .btn-primary-custom {
      background: linear-gradient(195deg, #ec407a 0%, #d81b60 100%);
      color: white;
      border: none;
      padding: 0.75rem 1.5rem;
      border-radius: 0.5rem;
      font-weight: 500;
      transition: all 0.3s ease;
      box-shadow: 0 4px 6px rgba(233, 30, 99, 0.2);
    }
    
    .btn-primary-custom:hover {
      transform: translateY(-2px);
      box-shadow: 0 7px 14px rgba(233, 30, 99, 0.3);
    }
  </style>
  
  @stack('styles')
</head>

<body>
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 my-2" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-xl-none" aria-hidden="false" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href="{{ route('dashboard') }}">
        <span class="span1 ms-1 font-weight-bold">@lang('messages.title')</span>
      </a>
    </div>
    <hr class="horizontal mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto h-auto max-height-vh-100 h-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <i class="material-symbols-rounded opacity-6 me-2">dashboard</i>
            <span class="nav-link-text">Dashboard</span>

          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::is('employee.tickets.list') ? 'active' : '' }}" href="{{  route('employee.tickets.list')}}">
            <i class="material-symbols-rounded opacity-6 me-2">table_view</i>
            <span class="nav-link-text">All Tickets</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::is('dasboard.tickets') ? 'active' : '' }}" href="{{  route('dasboard.tickets')}}">
            <i class="material-symbols-rounded opacity-6 me-2">add_circle</i>
            <span class="nav-link-text">Create Ticket</span>
          </a>
        </li>
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-xl-none" id="iconSidenav">
          pHello svg</i>


        <li class="nav-item mt-4">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::is('employee.profile.edit') ? 'active' : '' }}" href="{{ route('employee.profile.edit') }}">
            <i class="material-symbols-rounded opacity-6 me-2">person</i>
            <span class="nav-link-text">Profile</span>
          </a>
        </li>
        @auth
          <li class="nav-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
              @csrf
              <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start" style="cursor: pointer;">
                <i class="material-symbols-rounded opacity-6 me-2">logout</i>
                <span class="nav-link-text">Logout</span>
              </button>
            </form>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">
              <i class="material-symbols-rounded opacity-6 me-2">login</i>
              <span class="nav-link-text">Sign In</span>
            </a>
          </li>
        @endauth
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 p-3">
      <div class="card shadow-none">
        <div class="card-body p-3">
          <div class="d-flex align-items-center">
            <i class="material-symbols-rounded opacity-6 me-2">support_agent</i>
            <span>Need help?</span>
          </div>
          <small>Contact support team</small>
        </div>
      </div>
    </div>
  </aside>
  
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl position-sticky z-index-sticky top-0" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5" href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item text-sm active" aria-current="page">@yield('breadcrumb', 'Dashboard')</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">@yield('breadcrumb', 'Dashboard')</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              <label class="form-label">Search...</label>
              <input type="text" class="form-control">
            </div>
          </div>
          <ul class="navbar-nav d-flex align-items-center justify-content-end">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link p-0" id="darkModeToggle">
                <div class="mode-toggle">
                  <i class="material-symbols-rounded" id="themeIcon">dark_mode</i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link p-0">
                <i class="material-symbols-rounded cursor-pointer">notifications</i>
              </a>
            </li>
            @auth
              <li class="nav-item dropdown pe-2 d-flex align-items-center">
                <a href="javascript:;" class="nav-link p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="material-symbols-rounded cursor-pointer">account_circle</i>
                  <span class="d-sm-inline d-none ms-1">{{ Auth::user()->username }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end p-2 me-sm-n4" aria-labelledby="dropdownMenuButton">
                  <li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="{{ route('employee.profile.edit') }}">
                      <div class="d-flex py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="text-sm font-weight-normal mb-1">Profile</h6>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <form action="{{ route('logout') }}" method="POST">
                      @csrf
                      <button type="submit" class="dropdown-item border-radius-md">
                        <div class="d-flex py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="text-sm font-weight-normal mb-1">Logout</h6>
                          </div>
                        </div>
                      </button>
                    </form>
                  </li>
                </ul>
              </li>
            @else
              <li class="nav-item d-flex align-items-center">
                <a href="{{ route('login') }}" class="nav-link font-weight-bold px-0">
                  <i class="material-symbols-rounded me-sm-1">login</i>
                  <span class="d-sm-inline d-none">Sign In</span>
                </a>
              </li>
            @endauth
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    
    <div class="container-fluid py-4">
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <span class="alert-icon"><i class="material-symbols-rounded">check_circle</i></span>
          <span class="alert-text">{{ session('success') }}</span>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <span class="alert-icon"><i class="material-symbols-rounded">error</i></span>
          <span class="alert-text">{{ session('error') }}</span>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif
      
      @yield('content')
      
      <footer class="footer py-4">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script> Naftal
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  
  <!-- Chat Icon -->
  <div id="chatIcon">
    <i class="material-symbols-rounded">chat</i>
  </div>

  <!-- Core JS Files -->
  <script src="{{ asset('assetUser/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assetUser/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assetUser/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assetUser/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assetUser/js/plugins/chartjs.min.js') }}"></script>
  
  <!-- Dark Mode Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Check localStorage for dark mode preference
      const isDarkMode = localStorage.getItem('dark') === 'true';
      const body = document.body;
      const themeIcon = document.getElementById('themeIcon');
      
      // Apply dark mode if needed
      if (isDarkMode) {
        body.classList.add('dark-mode');
        themeIcon.textContent = 'light_mode';
      } else {
        body.classList.remove('dark-mode');
        themeIcon.textContent = 'dark_mode';
      }
      
      // Dark mode toggle functionality
      const darkModeToggle = document.getElementById('darkModeToggle');
      darkModeToggle.addEventListener('click', function() {
        body.classList.toggle('dark-mode');
        const isDark = body.classList.contains('dark-mode');
        
        // Update localStorage
        localStorage.setItem('dark', isDark);
        
        // Update icon
        themeIcon.textContent = isDark ? 'light_mode' : 'dark_mode';
        
        // Update charts if they exist
        if (typeof updateChartsTheme === 'function') {
          updateChartsTheme(isDark);
        }
      });
      
      // Mobile sidebar toggle
      const iconNavbarSidenav = document.getElementById('iconNavbarSidenav');
      const iconSidenav = document.getElementById('iconSidenav');
      const sidenav = document.getElementById('sidenav-main');
      
      if (iconNavbarSidenav) {
        iconNavbarSidenav.addEventListener('click', function() {
          sidenav.classList.toggle('show');
        });
      }
      
      if (iconSidenav) {
        iconSidenav.addEventListener('click', function() {
          sidenav.classList.remove('show');
        });
      }
      
      // Auto-hide alerts after 5 seconds
      const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
      alerts.forEach(alert => {
        setTimeout(() => {
          const closeButton = alert.querySelector('.btn-close');
          if (closeButton) closeButton.click();
        }, 5000);
      });
      
      // Initialize perfect scrollbar
      var win = navigator.platform.indexOf('Win') > -1;
      if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
          damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
      }
      
      // Fix for mobile menu in dark mode
      const updateMobileMenuColors = () => {
        const isDark = body.classList.contains('dark-mode');
        const sidenavTogglerLines = document.querySelectorAll('.sidenav-toggler-line');
        
        sidenavTogglerLines.forEach(line => {
          line.style.backgroundColor = isDark ? '#e9ecef' : '#344767';
        });
      };
      
      // Call initially and when theme changes
      updateMobileMenuColors();
      darkModeToggle.addEventListener('click', updateMobileMenuColors);
    });
  </script>
  
  <!-- Material Dashboard JS -->
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
  
  @stack('scripts')
</body>
</html>