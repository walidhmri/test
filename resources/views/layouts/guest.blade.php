<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ session('dark_mode', false) ? 'dark-mode' : '' }}" dir="@lang('messages.dir')">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Naftal') }} - @yield('title', 'Helpdesk')</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/x-icon">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        /* Base Variables */
        :root {
            /* Colors */
            --primary: #f39c12;
            --primary-dark: #e67e22;
            --primary-light: rgba(243, 156, 18, 0.1);
            --secondary: #2c3e50;
            --success: #2ecc71;
            --info: #3498db;
            --warning: #f1c40f;
            --danger: #e74c3c;
            --light: #f8f9fa;
            --dark: #343a40;
            
            /* Theme Colors */
            --body-bg: #ffffff;
            --card-bg: #ffffff;
            --header-bg: #ffffff;
            --footer-bg: #f8f9fa;
            --text-color: #333333;
            --text-muted: #6c757d;
            --border-color: rgba(0, 0, 0, 0.1);
            --input-bg: #f8f9fa;
            --shadow-sm: 0 .125rem .25rem rgba(0, 0, 0, .075);
            --shadow: 0 .5rem 1rem rgba(0, 0, 0, .15);
            --icon-color: #333333;
            --btn-text: #333333;
            
            /* Typography */
            --font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            
            /* Spacing */
            --header-height: 80px;
            --section-spacing: 5rem;
        }
        
        /* Dark Mode Variables */
        .dark-mode {
            --primary: #f39c12;
            --primary-dark: #e67e22;
            --primary-light: rgba(243, 156, 18, 0.15);
            --secondary: #4a6785;
            --body-bg: #121212;
            --card-bg: #1e1e1e;
            --header-bg: #1a1a1a;
            --footer-bg: #1a1a1a;
            --text-color: #e0e0e0;
            --text-muted: #adb5bd;
            --border-color: rgba(255, 255, 255, 0.1);
            --input-bg: rgba(255, 255, 255, 0.05);
            --shadow-sm: 0 .125rem .25rem rgba(0, 0, 0, .3);
            --shadow: 0 .5rem 1rem rgba(0, 0, 0, .5);
            --icon-color: #e0e0e0;
            --btn-text: #e0e0e0;
        }
        
        /* Base Styles */
        body {
            font-family: var(--font-family);
            background-color: var(--body-bg);
            color: var(--text-color);
            transition: background-color 0.3s ease, color 0.3s ease;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding-top: var(--header-height);
        }
        
        main {
            flex: 1;
        }
        
        /* Typography */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 700;
        }
        
        .section-title {
            position: relative;
            margin-bottom: 2rem;
            font-weight: 700;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: -0.75rem;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background-color: var(--primary);
            border-radius: 3px;
        }
        
        /* Header */
        .navbar {
            background-color: var(--header-bg);
            box-shadow: var(--shadow-sm);
            min-height: var(--header-height);
            transition: all 0.3s ease;
        }
        
        .navbar-brand img {
            height: 40px;
            transition: all 0.3s ease;
        }
        
        .navbar-nav .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem;
            color: var(--text-color);
            transition: all 0.3s ease;
            position: relative;
        }
        
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: var(--primary);
        }
        
        .navbar-nav .nav-link.active:after {
            content: '';
            position: absolute;
            left: 1rem;
            right: 1rem;
            bottom: 0.25rem;
            height: 2px;
            background-color: var(--primary);
            border-radius: 2px;
        }
        
        .navbar-toggler {
            border: none;
            padding: 0.5rem;
            color: var(--text-color);
        }
        
        .navbar-toggler:focus {
            box-shadow: none;
        }
        
        /* Buttons */
        .btn {
            font-weight: 500;
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .btn-brand {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
        }
        
        .btn-brand:hover,
        .btn-brand:focus {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .btn-outline-brand {
            border-color: var(--primary);
            color: var(--primary);
        }
        
        .btn-outline-brand:hover,
        .btn-outline-brand:focus {
            background-color: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        /* Cards */
        .card {
            background-color: var(--card-bg);
            border: none;
            border-radius: 1rem;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow);
        }
        
        /* Forms */
        .form-control,
        .form-select {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            border: 1px solid var(--border-color);
            background-color: var(--input-bg);
            color: var(--text-color);
            transition: all 0.3s ease;
        }
        
        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(243, 156, 18, 0.25);
        }
        
        /* Hero Section */
        .hero-section {
            position: relative;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 6rem 0;
            overflow: hidden;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        /* Footer */
        .footer {
            background-color: var(--footer-bg);
            padding: 4rem 0 2rem;
            position: relative;
        }
        
        .footer-title {
            font-weight: 700;
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }
        
        .footer-title:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -0.5rem;
            width: 30px;
            height: 2px;
            background-color: var(--primary);
            border-radius: 2px;
        }
        
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .footer-links li {
            margin-bottom: 0.75rem;
        }
        
        .footer-links a {
            color: var(--text-muted);
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
        }
        
        .footer-links a:hover {
            color: var(--primary);
            transform: translateX(5px);
        }
        
        .footer-links a i {
            margin-right: 0.5rem;
            font-size: 0.75rem;
        }
        
        .social-links {
            display: flex;
            gap: 0.75rem;
        }
        
        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-light);
            color: var(--primary);
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            background-color: var(--primary);
            color: white;
            transform: translateY(-3px);
        }
        
        .copyright {
            padding-top: 2rem;
            margin-top: 2rem;
            border-top: 1px solid var(--border-color);
            color: var(--text-muted);
            font-size: 0.875rem;
        }
        
        /* Dark Mode Toggle */
        .dark-mode-toggle {
            width: 50px;
            height: 26px;
            border-radius: 13px;
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .dark-mode-toggle:after {
            content: '';
            position: absolute;
            top: 2px;
            left: 2px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: var(--primary);
            transition: all 0.3s ease;
        }
        
        .dark-mode .dark-mode-toggle:after {
            left: calc(100% - 22px);
        }
        
        /* Language Switcher */
        .language-switcher {
            position: relative;
        }
        
        .language-switcher .dropdown-menu {
            min-width: 100px;
            border: none;
            border-radius: 0.5rem;
            box-shadow: var(--shadow);
            background-color: var(--card-bg);
            padding: 0.5rem;
        }
        
        .language-switcher .dropdown-item {
            color: var(--text-color);
            border-radius: 0.25rem;
            padding: 0.5rem 1rem;
        }
        
        .language-switcher .dropdown-item:hover {
            background-color: var(--primary-light);
            color: var(--primary);
        }
        
        .language-switcher .dropdown-item.active {
            background-color: var(--primary);
            color: white;
        }
        
        /* Utilities */
        .bg-gradient-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        }
        
        .text-white-75 {
            color: rgba(255, 255, 255, 0.75);
        }
        
        .rounded-4 {
            border-radius: 1rem !important;
        }
        
        .z-1 { z-index: 1; }
        .z-2 { z-index: 2; }
        .z-3 { z-index: 3; }
        
        /* Responsive Adjustments */
        @media (max-width: 991.98px) {
            :root {
                --header-height: 70px;
            }
            
            .navbar-collapse {
                background-color: var(--card-bg);
                border-radius: 1rem;
                box-shadow: var(--shadow);
                padding: 1rem;
                margin-top: 1rem;
            }
            
            .navbar-nav .nav-link.active:after {
                left: 0;
                right: 0;
                bottom: 0;
            }
        }
        
        @media (max-width: 767.98px) {
            .hero-section {
                padding: 4rem 0;
            }
            
            .section-title:after {
                width: 40px;
            }
        }
        
        /* Back to Top Button */
        .back-to-top {
            position: fixed;
            right: 30px;
            bottom: 30px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--primary);
            color: white;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 99;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .back-to-top.active {
            opacity: 1;
            visibility: visible;
        }
        
        .back-to-top:hover {
            background-color: var(--primary-dark);
            transform: translateY(-5px);
        }
        
        /* Navbar Scrolled Effect */
        .navbar-scrolled {
            box-shadow: var(--shadow);
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
        
        .navbar-scrolled .navbar-brand img {
            height: 35px;
        }
        
        /* Dark mode improvements for dropdown menus */
        .dark-mode .dropdown-menu {
            background-color: var(--card-bg);
            border-color: var(--border-color);
        }

        .dark-mode .dropdown-item {
            color: var(--text-color);
        }

        .dark-mode .dropdown-item:hover, 
        .dark-mode .dropdown-item:focus {
            background-color: var(--primary-light);
            color: var(--primary);
        }

        .dark-mode .dropdown-divider {
            border-color: var(--border-color);
        }

        /* Fix for dark mode buttons */
        .btn-link {
            color: var(--icon-color) !important;
        }

        .text-body {
            color: var(--text-color) !important;
        }

        .dark-mode .btn-link,
        .dark-mode .text-body {
            color: var(--icon-color) !important;
        }

        .language-dropdown-text {
            color: var(--btn-text);
        }

        /* RTL Support */
        [dir="rtl"] .navbar-nav .nav-link.active:after {
            right: 1rem;
            left: 1rem;
        }

        [dir="rtl"] .footer-title:after {
            right: 0;
            left: auto;
        }

        [dir="rtl"] .footer-links a i {
            margin-right: 0;
            margin-left: 0.5rem;
        }

        [dir="rtl"] .footer-links a:hover {
            transform: translateX(-5px);
        }

        /* Footer dark mode improvements */
        .footer {
            color: var(--text-color);
        }

        .dark-mode .footer {
            color: var(--text-color);
        }

        .dark-mode .text-body-secondary {
            color: var(--text-muted) !important;
        }

        /* Mobile login button */
        @media (max-width: 991.98px) {
            .mobile-login-btn {
                display: block;
                margin-top: 1rem;
                width: 100%;
            }
        }
    </style>
    
    <!-- Additional Styles -->
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header class="header fixed-top">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('assets/logo.png') }}" alt="{{ config('app.name', 'Naftal') }}" class="logo">
                </a>
                
                <!-- Mobile Toggle -->
                <div class="d-flex align-items-center gap-3">
                    <!-- Dark Mode Toggle (Mobile) -->
                    <div class="d-lg-none">
                        <button class="btn btn-sm btn-link p-0" id="darkModeMobile">
                            <i class="bi bi-moon-fill fs-5" id="darkIconMobile"></i>
                        </button>
                    </div>
                    
                    <!-- Language Switcher (Mobile) -->
                    <div class="dropdown d-lg-none">
                        <button class="btn btn-sm btn-link p-0 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-globe fs-5"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ url('locale/fr') }}">Français</a></li>
                            <li><a class="dropdown-item" href="{{ url('locale/en') }}">English</a></li>
                            <li><a class="dropdown-item" href="{{ url('locale/ar') }}">العربية</a></li>
                            <li><a class="dropdown-item" href="{{ url('locale/tm') }}">Kabyle</a></li>
                        </ul>
                    </div>
                    
                    <!-- Navbar Toggler -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="bi bi-list fs-4"></i>
                    </button>
                </div>
                
                <!-- Navigation -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                                @lang('messages.home')
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('posts*') ? 'active' : '' }}" href="{{ url('/posts') }}">
                                @lang('messages.posts')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('faqs*') ? 'active' : '' }}" href="{{ url('/faqs') }}">
                                @lang('messages.faqs')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('contact*') ? 'active' : '' }}" href="{{ url('/contact-us') }}">
                                @lang('messages.contact_us')
                            </a>
                        </li>
                        <li class="nav-item d-lg-none">
                            @guest
                            <a href="{{ route('login') }}" class="btn btn-outline-brand  d-lg-none">
                                @lang('messages.login')
                            </a>
                            @else
                            <div class="dropdown">
                                <button class="btn btn-outline-brand  d-lg-none" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="{{ route('employee.profile.edit') }}">@lang('messages.profile')</a></li>
                                    @if (auth::user()->role=='user')
                                    <li><a class="dropdown-item" href="{{ route('dashboard') }}">@lang('messages.dashboard')</a></li>
                                    @elseif (auth::user()->role=='admin')
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">@lang('messages.admin_dashboard')</a></li>
                                    @elseif(auth::user()->role=='ingenieur')
                                    <li><a class="dropdown-item" href="{{ route('ingenieur.dashboard') }}">@lang('messages.engineer_dashboard')</a></li>
                                    @endif

                                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">@lang('messages.logout')</a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </ul>
                            </div>
                            @endguest
                        </li>
                    </ul>
                    
                    <div class="d-flex align-items-center gap-3">
                        <!-- Dark Mode Toggle (Desktop) -->
                        <div class="d-none d-lg-block">
                            <button class="btn btn-sm btn-link p-0" id="darkModeDesktop">
                                <i class="bi bi-moon-fill fs-5" id="darkIconDesktop"></i>
                            </button>
                        </div>
                        
                        <!-- Language Switcher (Desktop) -->
                        <div class="dropdown language-switcher d-none d-lg-block">
                            <button class="btn btn-sm btn-link p-0 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-globe fs-5 me-1"></i>
                                <span class="language-dropdown-text">{{ strtoupper(app()->getLocale()) }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}" href="{{ route('language.switch', 'en') }}">English</a></li>
                                <li><a class="dropdown-item {{ app()->getLocale() == 'fr' ? 'active' : '' }}" href="{{ route('language.switch', 'fr') }}">Français</a></li>
                                <li><a class="dropdown-item {{ app()->getLocale() == 'ar' ? 'active' : '' }}" href="{{ route('language.switch', 'ar') }}">العربية</a></li>
                                <li><a class="dropdown-item {{ app()->getLocale() == 'tm' ? 'active' : '' }}" href="{{ route('language.switch', 'tm') }}">Taqbaylit</a></li>
                            </ul>
                        </div>
                        
                        @guest
                        <a href="{{ route('login') }}" class="btn btn-outline-brand d-none d-lg-block">
                            @lang('messages.login')
                        </a>
                        @else
                        <div class="dropdown">
                            <button class="btn btn-outline-brand d-none d-lg-block" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('employee.profile.edit') }}">@lang('messages.profile')</a></li>
                                @if (auth::user()->role=='user')
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">@lang('messages.dashboard')</a></li>
                                @elseif (auth::user()->role=='admin')
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">@lang('messages.admin_dashboard')</a></li>
                                @elseif(auth::user()->role=='ingenieur')
                                <li><a class="dropdown-item" href="{{ route('ingenieur.dashboard') }}">@lang('messages.engineer_dashboard')</a></li>
                                @endif                                <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">@lang('messages.logout')</a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </div>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <!-- Company Info -->
                <div class="col-lg-4">
                    <a href="{{ url('/') }}" class="d-inline-block mb-4">
                        <img src="{{ asset('assets/logo.png') }}" alt="{{ config('app.name', 'Naftal') }}" height="40">
                    </a>
                    <p class="text-body-secondary mb-4">@lang('messages.footer_about')</p>

                </div>
                
                <!-- Quick Links -->
                <div class="col-lg-4 col-md-6">
                    <h5 class="footer-title">@lang('messages.quick_links')</h5>
                    <div class="row">
                        <div class="col-6">
                            <ul class="footer-links">
                                <li><a href="{{ url('/') }}"><i class="bi bi-chevron-right"></i> @lang('messages.home')</a></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="footer-links">
                                <li><a href="{{ url('/posts') }}"><i class="bi bi-chevron-right"></i> @lang('messages.posts')</a></li>
                                <li><a href="{{ url('/faqs') }}"><i class="bi bi-chevron-right"></i> @lang('messages.faqs')</a></li>
                                <li><a href="{{ url('/contact-us') }}"><i class="bi bi-chevron-right"></i> @lang('messages.contact_us')</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Info -->
                <div class="col-lg-4 col-md-6">
                    <h5 class="footer-title">@lang('messages.contact_info')</h5>
                    <ul class="footer-links">
                        <li>
                            <a href="#" class="d-flex align-items-center">
                                <div class="icon-circle bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px; flex-shrink: 0;">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                <span>123 Rue des Hydrocarbures, Alger 16000, Algérie</span>
                            </a>
                        </li>
                        <li>
                            <a href="tel:+21321XXXXXX" class="d-flex align-items-center">
                                <div class="icon-circle bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px; flex-shrink: 0;">
                                    <i class="bi bi-telephone"></i>
                                </div>
                                <span>+213 (0) 21 XX XX XX</span>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:contact@naftal.dz" class="d-flex align-items-center">
                                <div class="icon-circle bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px; flex-shrink: 0;">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                <span>contact@naftal.dz</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="copyright text-center">
                <div class="row">
                    <div class="col-md-6 text-md-start">
                        &copy; {{ date('Y') }} {{ config('app.name', 'Naftal') }}. @lang('messages.all_rights_reserved')
                    </div>
                    <div class="col-md-6 text-md-end">
                        <a href="#" class="text-body-secondary text-decoration-none me-3">@lang('messages.privacy_policy')</a>
                        <a href="#" class="text-body-secondary text-decoration-none">@lang('messages.terms_of_service')</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center" id="backToTop">
        <i class="bi bi-arrow-up"></i>
    </a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Main Script -->
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
        
        // Check for dark mode preference in localStorage
        document.addEventListener('DOMContentLoaded', function() {
            // Check if dark mode is stored in localStorage
            const isDarkMode = localStorage.getItem('dark') === 'true';
            const html = document.documentElement;
            
            // Apply dark mode if needed
            if (isDarkMode) {
                html.classList.add('dark-mode');
                updateDarkModeIcons(true);
            } else {
                html.classList.remove('dark-mode');
                updateDarkModeIcons(false);
            }
            
            // Dark Mode Toggle
            const darkModeDesktop = document.getElementById('darkModeDesktop');
            const darkModeMobile = document.getElementById('darkModeMobile');
            
            // Desktop dark mode toggle
            if (darkModeDesktop) {
                darkModeDesktop.addEventListener('click', function() {
                    toggleDarkMode();
                });
            }
            
            // Mobile dark mode toggle
            if (darkModeMobile) {
                darkModeMobile.addEventListener('click', function() {
                    toggleDarkMode();
                });
            }
            
            function toggleDarkMode() {
                const html = document.documentElement;
                const isDarkMode = html.classList.contains('dark-mode');
                
                // Toggle dark mode class
                if (isDarkMode) {
                    html.classList.remove('dark-mode');
                    updateDarkModeIcons(false);
                    localStorage.setItem('dark', 'false');
                } else {
                    html.classList.add('dark-mode');
                    updateDarkModeIcons(true);
                    localStorage.setItem('dark', 'true');
                }
            }
            
            function updateDarkModeIcons(isDarkMode) {
                const darkIconDesktop = document.getElementById('darkIconDesktop');
                const darkIconMobile = document.getElementById('darkIconMobile');
                
                if (darkIconDesktop) {
                    darkIconDesktop.className = isDarkMode ? 'bi bi-sun-fill fs-5' : 'bi bi-moon-fill fs-5';
                }
                
                if (darkIconMobile) {
                    darkIconMobile.className = isDarkMode ? 'bi bi-sun-fill fs-5' : 'bi bi-moon-fill fs-5';
                }
            }
        });
        
        // Back to Top Button
        document.addEventListener('DOMContentLoaded', function() {
            const backToTopButton = document.getElementById('backToTop');
            
            if (backToTopButton) {
                // Show/hide back to top button based on scroll position
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 300) {
                        backToTopButton.classList.add('active');
                    } else {
                        backToTopButton.classList.remove('active');
                    }
                });
                
                // Scroll to top when clicked
                backToTopButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
        });
        
        // Navbar Scroll Effect
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.querySelector('.navbar');
            
            if (navbar) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 50) {
                        navbar.classList.add('navbar-scrolled');
                    } else {
                        navbar.classList.remove('navbar-scrolled');
                    }
                });
            }
        });
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                if (href !== '#') {
                    e.preventDefault();
                    
                    const targetElement = document.querySelector(href);
                    if (targetElement) {
                        const headerOffset = 100;
                        const elementPosition = targetElement.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                        
                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>

