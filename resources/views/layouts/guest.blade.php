<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ session('dark_mode', false) ? 'dark-mode' : '' }}"
    dir="@lang('messages.dir')">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Naftal') }} - @yield('title', 'HelpdesPk')</title>

    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/x-icon">


    <link href="{{ asset('assets/css/googleapis.css') }}" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('assets/css/bootstrapicons.css') }}">

    <link href="{{ asset('assets/css/bootstrapmin.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/aos.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">


    <!-- MA tevghid styles nniden -->
    @stack('styles')
</head>

<body>

    <!-- wagi d Header -->
    <header class="header fixed-top">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <!-- wagi d Logo -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('assets/logo.webp') }}" alt="{{ config('app.name', 'Naftal') }}"
                        class="logo">
                </a>

                <!-- Wagi d Mobile navbar -->
                <div class="d-flex align-items-center gap-3">
                    <!-- la button n Dark Mode Toggle (Mobile) -->
                    <div class="d-lg-none">
                        <button class="btn btn-sm btn-link p-0" id="darkModeMobile">
                            <i class="bi bi-moon-fill fs-5" id="darkIconMobile"></i>
                        </button>
                    </div>

                    <!-- Language Switcher (Mobile) -->
                    <div class="dropdown d-lg-none">
                        <button class="btn btn-sm btn-link p-0 dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
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
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="bi bi-list fs-4"></i>
                    </button>
                </div>

                <!-- Navigation -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                                @lang('messages.home')
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('posts*') ? 'active' : '' }}"
                                href="{{ url('/posts') }}">
                                @lang('messages.posts')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('faqs*') ? 'active' : '' }}"
                                href="{{ url('/faqs') }}">
                                @lang('messages.faqs')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('contact*') ? 'active' : '' }}"
                                href="{{ url('/contact-us') }}">
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
                                    <button class="btn btn-outline-brand  d-lg-none" type="button" id="userDropdown"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                        <li><a class="dropdown-item"
                                                href="{{ route('employee.profile.edit') }}">@lang('messages.profile')</a></li>
                                        @if (auth::user()->role == 'user')
                                            <li><a class="dropdown-item"
                                                    href="{{ route('dashboard') }}">@lang('messages.dashboard')</a></li>
                                        @elseif (auth::user()->role == 'admin')
                                            <li><a class="dropdown-item"
                                                    href="{{ route('admin.dashboard') }}">@lang('messages.admin_dashboard')</a></li>
                                        @elseif(auth::user()->role == 'ingenieur')
                                            <li><a class="dropdown-item"
                                                    href="{{ route('ingenieur.dashboard') }}">@lang('messages.engineer_dashboard')</a></li>
                                        @endif

                                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">@lang('messages.logout')</a>
                                        </li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
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
                            <button class="btn btn-sm btn-link p-0 dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-globe fs-5 me-1"></i>
                                <span class="language-dropdown-text">{{ strtoupper(app()->getLocale()) }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}"
                                        href="{{ route('language.switch', 'en') }}">English</a></li>
                                <li><a class="dropdown-item {{ app()->getLocale() == 'fr' ? 'active' : '' }}"
                                        href="{{ route('language.switch', 'fr') }}">Français</a></li>
                                <li><a class="dropdown-item {{ app()->getLocale() == 'ar' ? 'active' : '' }}"
                                        href="{{ route('language.switch', 'ar') }}">العربية</a></li>
                                <li><a class="dropdown-item {{ app()->getLocale() == 'tm' ? 'active' : '' }}"
                                        href="{{ route('language.switch', 'tm') }}">Taqbaylit</a></li>
                            </ul>
                        </div>

                        @guest
                            <a href="{{ route('login') }}" class="btn btn-outline-brand d-none d-lg-block">
                                @lang('messages.login')
                            </a>
                        @else
                            <div class="dropdown">
                                <button class="btn btn-outline-brand d-none d-lg-block" type="button" id="userDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item"
                                            href="{{ route('employee.profile.edit') }}">@lang('messages.profile')</a></li>
                                    @if (auth::user()->role == 'user')
                                        <li><a class="dropdown-item"
                                                href="{{ route('dashboard') }}">@lang('messages.dashboard')</a></li>
                                    @elseif (auth::user()->role == 'admin')
                                        <li><a class="dropdown-item"
                                                href="{{ route('admin.dashboard') }}">@lang('messages.admin_dashboard')</a></li>
                                    @elseif(auth::user()->role == 'ingenieur')
                                        <li><a class="dropdown-item"
                                                href="{{ route('ingenieur.dashboard') }}">@lang('messages.engineer_dashboard')</a></li>
                                    @endif
                                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">@lang('messages.logout')</a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
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

    <!-- section negh yield Main Content -->
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
                        <img src="{{ asset('assets/logo.webp') }}" alt="{{ config('app.name', 'Naftal') }}"
                            height="40">
                    </a>
                    <p class="text-body-secondary mb-4">@lang('messages.footer_about')</p>

                </div>

                <!-- Quick Links -->
                <div class="col-lg-4 col-md-6">
                    <h5 class="footer-title">@lang('messages.quick_links')</h5>
                    <div class="row">
                        <div class="col-6">
                            <ul class="footer-links">
                                <li><a href="{{ url('/') }}"><i class="bi bi-chevron-right"></i>
                                        @lang('messages.home')</a></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="footer-links">
                                <li><a href="{{ url('/posts') }}"><i class="bi bi-chevron-right"></i>
                                        @lang('messages.posts')</a></li>
                                <li><a href="{{ url('/faqs') }}"><i class="bi bi-chevron-right"></i>
                                        @lang('messages.faqs')</a></li>
                                <li><a href="{{ url('/contact-us') }}"><i class="bi bi-chevron-right"></i>
                                        @lang('messages.contact_us')</a></li>
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
                                <div class="icon-circle bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                                    style="width: 36px; height: 36px; flex-shrink: 0;">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                <span>123 Rue des Hydrocarbures, Alger 16000, Algérie</span>
                            </a>
                        </li>
                        <li>
                            <a href="tel:+21321XXXXXX" class="d-flex align-items-center">
                                <div class="icon-circle bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                                    style="width: 36px; height: 36px; flex-shrink: 0;">
                                    <i class="bi bi-telephone"></i>
                                </div>
                                <span>+213 (0) 21 XX XX XX</span>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:contact@naftal.dz" class="d-flex align-items-center">
                                <div class="icon-circle bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                                    style="width: 36px; height: 36px; flex-shrink: 0;">
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
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center" id="backToTop">
        <i class="bi bi-arrow-up"></i>
    </a>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrapbundlemin.js') }}"></script>

    <!-- AOS Animation Library -->
    <script src="{{ asset('assets/js/aos.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>




    @stack('scripts')
</body>

</html>
