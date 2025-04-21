<!DOCTYPE html>
<html dir="@lang('messages.dir')">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assetUser/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assetUser/img/favicon.png') }}">
  <title>
    Naftal @yield('title', 'Dashboard')
  </title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism.min.css" rel="stylesheet" />

  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <!-- Chart JS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
  
  <link rel="stylesheet" href="{{asset('css/employee.css')}}">
  <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">


  
  @stack('styles')
</head>

<body>
  <!-- Mobile menu backdrop -->
  <div class="sidebar-backdrop" id="sidenavBackdrop"></div>
  
  <div class="app-container">
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
      <div class="sidebar-header">
        <a href="{{ route('dashboard') }}" class="logo">
          <i class="material-symbols-rounded logo-icon">local_fire_department</i>
          <span class="logo-text">Naftal</span>
        </a>
        <button class="sidebar-toggle" id="sidebarToggle">
          <i class="material-symbols-rounded">chevron_left</i>
        </button>
      </div>
      
      <div class="sidebar-content">
        <ul class="sidebar-menu">
          <li class="menu-item">
            <a href="{{ route('dashboard') }}" class="menu-link {{ Route::is('dashboard') ? 'active' : '' }}">
              <i class="material-symbols-rounded menu-icon">dashboard</i>
              <span class="menu-text">Dashboard</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ route('employee.Tickets.list') }}" class="menu-link {{ Route::is('employee.Tickets.list') ? 'active' : '' }}">
              <i class="material-symbols-rounded menu-icon">table_view</i>
              <span class="menu-text">All Tickets</span>
            </a>
          </li>

          <li class="menu-item">
            <a href="{{ route('dasboard.Tickets') }}" class="menu-link {{ Route::is('dasboard.Tickets') ? 'active' : '' }}">
              <i class="material-symbols-rounded menu-icon text-orange-400">add_circle</i>
              <span class="menu-text">Create Ticket</span>
            </a>
          </li>

          
          <div class="menu-section">
            <p class="menu-section-text">Account</p>
          </div>
          <li class="menu-item">
            <a href="{{ route('employee.profile.edit') }}" class="menu-link {{ Route::is('employee.profile.edit') ? 'active' : '' }}">
              <i class="material-symbols-rounded menu-icon">person</i>
              <span class="menu-text">Profile</span>
            </a>
          </li>
          @auth
            <li class="menu-item">
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="menu-link border-0 bg-transparent w-100 text-start" style="cursor: pointer;">
                  <i class="material-symbols-rounded menu-icon">logout</i>
                  <span class="menu-text">Logout</span>
                </button>
              </form>
            </li>
          @else
            <li class="menu-item">
              <a href="{{ route('login') }}" class="menu-link">
                <i class="material-symbols-rounded menu-icon">login</i>
                <span class="menu-text">Sign In</span>
              </a>
            </li>
          @endauth
        </ul>
      </div>
      
      <div class="sidebar-footer">
        <div class="user-info">
          @auth
            <div class="user-avatar">
              {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="user-details">
              <div class="user-name">{{ Auth::user()->name }}</div>
              <div class="user-role">{{ Auth::user()->department_name }}</div>
            </div>
          @else
            <div class="user-avatar">
              <i class="material-symbols-rounded">person</i>
            </div>
            <div class="user-details">
              <div class="user-name">Guest</div>
              <div class="user-role">Not logged in</div>
            </div>
          @endauth
        </div>
      </div>
    </aside>
    
    <!-- Main Content -->
    <main class="main-content">
      <!-- Header -->
      <header class="header">
        <div class="header-left">
          <button class="mobile-toggle" id="mobileToggle">
            <i class="material-symbols-rounded">menu</i>
          </button>
          <h1 class="page-title">@yield('breadcrumb', 'Dashboard')</h1>
        </div>
        
        <div class="header-right">
          <div class="search-box">
            <i class="material-symbols-rounded search-icon">search</i>
            <input type="text" class="search-input" placeholder="Search...">
          </div>
          
          <button class="header-action" id="darkModeToggle">
            <i class="material-symbols-rounded" id="themeIcon">dark_mode</i>
          </button>
          
          <button class="header-action">
            <i class="material-symbols-rounded">notifications</i>
          </button>
          
          @auth
            <div class="dropdown">
              <button class="header-action" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="material-symbols-rounded">account_circle</i>
              </button>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="{{ route('employee.profile.edit') }}">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">Logout</button>
                  </form>
                </li>
              </ul>
            </div>
          @else
            <a href="{{ route('login') }}" class="header-action">
              <i class="material-symbols-rounded">login</i>
            </a>
          @endauth
        </div>
      </header>
      
      <!-- Content -->
      <div class="content">
        @if (session('success'))
          <div class="alert alert-success" role="alert">
            <div class="alert-icon">
              <i class="material-symbols-rounded">check_circle</i>
            </div>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        @if (session('demo'))
          <div class="alert alert-danger" role="alert">
            <div class="alert-icon">
              <i class="material-symbols-rounded">Demo</i>
            </div>
            <div>{{ session('demo') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        @if (session('error'))
          <div class="alert alert-danger" role="alert">
            <div class="alert-icon">
              <i class="material-symbols-rounded">error</i>
            </div>
            <div>{{ session('error') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        
        @yield('content')
      </div>
      
      <!-- Footer -->
      <footer class="footer">
        <div>© <script>document.write(new Date().getFullYear())</script> Naftal. All rights reserved.</div>
      </footer>
    </main>
  </div>
  


  <!-- Core JS Files -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
  
  <!-- Custom Scripts -->
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
      
      // Sidebar toggle
      const sidebar = document.getElementById('sidebar');
      const sidebarToggle = document.getElementById('sidebarToggle');
      const mainContent = document.querySelector('.main-content');
      
      sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('sidebar-collapsed');
      });
      
      // Mobile sidebar toggle
      const mobileToggle = document.getElementById('mobileToggle');
      const sidenavBackdrop = document.getElementById('sidenavBackdrop');
      
      mobileToggle.addEventListener('click', function() {
        sidebar.classList.add('show');
        sidenavBackdrop.classList.add('show');
      });
      
      sidenavBackdrop.addEventListener('click', function() {
        sidebar.classList.remove('show');
        sidenavBackdrop.classList.remove('show');
      });
      
      // Auto-hide alerts after 5 seconds
      const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
      alerts.forEach(alert => {
        setTimeout(() => {
          const closeButton = alert.querySelector('.btn-close');
          if (closeButton) closeButton.click();
        }, 5000);
      });
    });
  </script>
  
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

    
        Tawk_API.onLoad = function() {
            Tawk_API.setAttributes({
                'name'  : "{{ Auth::user()->name }}",
                'email' : "{{ Auth::user()->department_name }}",
                'hash'  : "{{ hash_hmac('sha256', Auth::user()->department_name, env('TAWK_API_KEY')) }}"
            }, function(error) {
                console.log("Tawk.to attributes updated!", error);
            });
        };
    
  </script>

  @stack('scripts')
</body>
</html>
