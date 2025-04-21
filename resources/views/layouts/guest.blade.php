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

    <style>
        /* Custom styles for notification dropdown */
        #simpleNotificationButton:hover {
            color: var(--bs-primary);
        }

        #simpleNotificationDropdown .notification-item:hover {
            background-color: rgba(0, 0, 0, 0.03);
        }

        #simpleNotificationDropdown .hover-bg-light:hover {
            background-color: var(--header-bg);
        }


        .notification-list::-webkit-scrollbar {
            width: 5px;
        }

        .notification-list::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .notification-list::-webkit-scrollbar-thumb {
            background: var(--bs-primary);
            border-radius: 5px;
        }

        .notification-list::-webkit-scrollbar-thumb:hover {
            background: var(--bs-primary);
        }
    </style>

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
                        @auth

                            <div class="nav-item">
                                <!-- Enhanced button with ID -->
                                <a href="#" id="simpleNotificationButton" class="position-relative d-inline-block"
                                    style="width: 24px; height: 24px;">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                                        viewBox="0 0 24 24" class="d-block" style="color: var(--bs-body-color);">

                                        <!-- Icône de cloche -->
                                        <path fill="currentColor"
                                            d="M12 22q-.825 0-1.413-.588T10 20h4q0 .825-.588 1.413T12 22Zm6-6v-5q0-2.5-1.538-4.325T12 4Q9.075 4 7.538 5.825T6 10v5l-2 2v1h16v-1l-2-2Z" />

                                        <!-- Point rouge si notification -->
                                        @if (auth()->user()->unreadNotifications->where('type', App\Notifications\CreateSolutionNotification::class)->count())
                                            <circle cx="18" cy="6" r="4" fill="red" stroke="white"
                                                stroke-width="1" />
                                        @endif
                                    </svg>
                                </a>


                                <!-- Enhanced dropdown with ID -->
                                <div id="simpleNotificationDropdown" class="shadow position-absolute end-0"
                                    style="display: none; width: 320px; z-index: 1050; border-radius: 0.5rem; overflow: hidden;">

                                    <!-- Header -->
                                    <div class="border-bottom p-3 bg-body" style="color: var(--text-color);">
                                        <h6 class="mb-0 fw-bold text-center" style="color: black;">Notifications</h6>
                                    </div>

                                    <!-- Notification List -->
                                    <div class="notification-list bg-body text-body"
                                        style="max-height: 350px; overflow-y: auto; color: var(--text-color);">
                                        @forelse(auth()->user()->unreadNotifications->where('type', App\Notifications\CreateSolutionNotification::class)->take(5) as $notification)
                                            <div class="notification-item p-3 border-bottom bg-body text-body"
                                                style="transition: background-color 0.2s;"
                                                onmouseover="this.style.backgroundColor = getComputedStyle(document.body).getPropertyValue('--bs-secondary-bg')"
                                                onmouseout="this.style.backgroundColor = getComputedStyle(document.body).getPropertyValue('--bs-body-bg')">

                                                <div class="d-flex justify-content-between align-items-start mb-1">
                                                    <strong class="text-primary">
                                                        Ticket #{{ $notification->data['ticket_id'] }}
                                                    </strong>
                                                    <small class="text-muted">
                                                        {{ $notification->created_at->diffForHumans() }}
                                                    </small>
                                                </div>
                                                <p class="mb-2">Solution ajoutée par
                                                    {{ $notification->data['user_id'] }}</p>

                                                <form method="POST"
                                                    action="{{ route('solutionNotifications.markAsRead', $notification->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-primary w-100">
                                                        Marquer comme lu
                                                    </button>
                                                </form>
                                            </div>
                                        @empty
                                            <div class="p-4 text-center bg-body text-body">
                                                <i class="material-symbols-rounded d-block mb-2"
                                                    style="font-size: 2rem; opacity: 0.5; color: var(--text-color);">
                                                    notifications_off
                                                </i>
                                                <p class="text-muted mb-0">Aucune nouvelle notification</p>
                                            </div>
                                        @endforelse
                                    </div>

                                    <!-- Actions -->
                                    @if (auth()->user()->unreadNotifications->where('type', App\Notifications\CreateSolutionNotification::class)->count())
                                        <div class="p-3 border-top border-bottom bg-body">
                                            <form method="POST" action="{{ route('solutionNotifications.clearAll') }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger w-100" type="submit">
                                                    Tout marquer comme lu
                                                </button>
                                            </form>
                                        </div>
                                    @endif

                                    <!-- Footer -->
                                    <div class="p-3 text-center bg-body">
                                        <a href="{{ route('solutionNotifications.index') }}"
                                            class="text-decoration-none fw-semibold text-primary">
                                            Voir toutes les notifications
                                        </a>
                                    </div>
                                </div>
                            </div>




                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        // Get elements
                                        const button = document.getElementById('simpleNotificationButton');
                                        const dropdown = document.getElementById('simpleNotificationDropdown');

                                        if (!button || !dropdown) {
                                            console.error('Notification elements not found');
                                            return;
                                        }

                                        // Add click event with detailed logging
                                        button.addEventListener('click', function(event) {
                                            event.preventDefault();

                                            // Toggle dropdown
                                            const isCurrentlyHidden = dropdown.style.display === 'none' || dropdown.style.display ===
                                                '';
                                            dropdown.style.display = isCurrentlyHidden ? 'block' : 'none';

                                            // Position the dropdown properly
                                            positionDropdown();

                                            return false;
                                        });

                                        // Position dropdown appropriately
                                        function positionDropdown() {
                                            const buttonRect = button.getBoundingClientRect();
                                            const windowWidth = window.innerWidth;

                                            // If near the right edge, align right edge of dropdown with button
                                            if (buttonRect.right + 320 > windowWidth) {
                                                const rightOffset = windowWidth - buttonRect.right;
                                                dropdown.style.right = rightOffset + 'px';
                                                dropdown.style.left = 'auto';
                                            } else {
                                                dropdown.style.right = 'auto';
                                                dropdown.style.left = buttonRect.left + 'px';
                                            }
                                        }

                                        // Global click handler to close dropdown
                                        document.addEventListener('click', function(event) {
                                            if (dropdown.style.display === 'block' &&
                                                event.target !== button &&
                                                !button.contains(event.target) &&
                                                event.target !== dropdown &&
                                                !dropdown.contains(event.target)) {

                                                dropdown.style.display = 'none';
                                            }
                                        });

                                        // Handle window resize
                                        window.addEventListener('resize', function() {
                                            if (dropdown.style.display === 'block') {
                                                positionDropdown();
                                            }
                                        });
                                    });
                                </script>
                            @endauth
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
                                    <button class="btn btn-outline-brand d-none d-lg-block" type="button"
                                        id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
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
