<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en" dir="@lang('messages.dir')">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Naftal - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/chat-admin.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism.min.css" rel="stylesheet" />


    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/tailwind.output.css') }}" />

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{ asset('assets/js/init-alpine.js') }}"></script>

    <!-- Chart.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- Custom Scripts -->
    <script src="{{ asset('assets/js/charts-lines.js') }}" defer></script>
    <script src="{{ asset('assets/js/charts-pie.js') }}" defer></script>
    @stack('styles')
    @stack('head')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deskbar = document.getElementById('deskbar');
            var toggleBtn = document.getElementById('toggleDeskbar');

            // Check screen size and adjust sidebar visibility
            function checkScreenSize() {
                if (window.innerWidth < 768) {
                    deskbar.classList.add('md:hidden');
                } else {
                    var deskbarState = localStorage.getItem('deskbarState');
                    if (deskbarState === 'visible' || deskbarState === null) {
                        deskbar.classList.remove('md:hidden');
                    } else {
                        deskbar.classList.add('md:hidden');
                    }
                }
            }

            // Toggle sidebar visibility
            toggleBtn.addEventListener('click', function() {
                var isHidden = deskbar.classList.contains('md:hidden');
                if (isHidden) {
                    deskbar.classList.remove('md:hidden');
                    localStorage.setItem('deskbarState', 'visible');
                } else {
                    deskbar.classList.add('md:hidden');
                    localStorage.setItem('deskbarState', 'hidden');
                }
            });

            // Watch for screen size changes
            window.addEventListener('resize', checkScreenSize);

            // Initialize on page load
            checkScreenSize();
        });
    </script>
</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop sidebar -->
        @php
            use Illuminate\Support\Str;

            // تحقق مما إذا كان المسار الحالي ينتمي إلى فئة معينة
            $isDashboardActive = request()->routeIs('admin.dashboard');
            $isTicketsActive = Str::startsWith(request()->route()->getName(), 'admin.Tickets');
            $isEmployeesActive = Str::startsWith(request()->route()->getName(), 'admin.employee');
            $isIngenActive = Str::startsWith(request()->route()->getName(), 'admin.ingenieur');
            $isFaqsActive = Str::startsWith(request()->route()->getName(), 'admin.faqs');
            $isDepartmentsActive = Str::startsWith(request()->route()->getName(), 'admin.department');

        @endphp


        <aside id="deskbar"
            class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0 shadow-md">
            <div class="py-4 text-gray-500 dark:text-gray-400">
                <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
                    href="{{ route('admin.dashboard') }}">
                    @lang('messages.title')
                </a>
                <ul class="mt-6">
                    <li class="relative px-6 py-3">
                        @if ($isDashboardActive)
                            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                                aria-hidden="true"></span>
                        @endif
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ $isDashboardActive ? 'text-gray-800 dark:text-gray-100' : '' }}"
                            href="{{ route('admin.dashboard') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            <span class="ml-4"> @lang('messages.dashboard')</span>
                        </a>
                    </li>
                </ul>

                <ul>
                    <!-- Tickets Section -->
                    <li class="relative px-6 py-3">
                        @if ($isTicketsActive)
                            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                                aria-hidden="true"></span>
                        @endif
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ $isTicketsActive ? 'text-gray-800 dark:text-gray-100' : '' }}"
                            href="{{ route('admin.tickets.list') }}">

                            <!-- New SVG Icon for Tickets -->
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 9V7a2 2 0 012-2h14a2 2 0 012 2v2a3 3 0 000 6v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-2a3 3 0 000-6z">
                                </path>
                            </svg>
                            <span class="ml-4"> @lang('messages.tickets')</span>
                        </a>
                    </li>

                    <!-- Employees Section -->
                    <li class="relative px-6 py-3">
                        @if ($isEmployeesActive)
                            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                                aria-hidden="true"></span>
                        @endif
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ $isEmployeesActive ? 'text-gray-800 dark:text-gray-100' : '' }}"
                            href="{{ route('admin.employee.list') }}">

                            <!-- New SVG Icon for Employees -->
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M5.5 21a1.5 1.5 0 01-1.5-1.5V17a4 4 0 014-4h8a4 4 0 014 4v2.5a1.5 1.5 0 01-1.5 1.5H5.5z">
                                </path>
                                <path d="M12 11a4 4 0 100-8 4 4 0 000 8z"></path>
                            </svg>

                            <span class="ml-4"> @lang('messages.employees')</span>
                        </a>
                    </li>

                    <!-- Ingenieurs Section -->
                    <li class="relative px-6 py-3">
                        @if ($isIngenActive)
                            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                                aria-hidden="true"></span>
                        @endif
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ $isIngenActive ? 'text-gray-800 dark:text-gray-100' : '' }}"
                            href="{{ route('admin.ingenieurs.list') }}">

                            <!-- Plus Icon -->
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span class="ml-4"> @lang('messages.ingenieurs')</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        @if ($isFaqsActive)
                            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                                aria-hidden="true"></span>
                        @endif
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ $isFaqsActive ? 'text-gray-800 dark:text-gray-100' : '' }}"
                            href="{{ route('admin.faqs.list') }}">

                            <!-- Plus Icon -->
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M9 18a2 2 0 01-2-2V8a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2h-6zm0 0V8h6v8h-6z">
                                </path>
                            </svg>
                            <span class="ml-4"> @lang('messages.faqs')</span>
                        </a>
                    </li>


                    <li class="relative px-6 py-3">
                        @if ($isDepartmentsActive)
                            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                                aria-hidden="true"></span>
                        @endif
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ $isDepartmentsActive ? 'text-gray-800 dark:text-gray-100' : '' }}"
                            href="{{ route('admin.department.list') }}">

                            <!-- New SVG Icon for Departments -->
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>

                            <span class="ml-4"> @lang('messages.departments')</span>
                        </a>
                    </li>

                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="#">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                </path>
                            </svg>

                            <span class="ml-4"> @lang('messages.reviews')</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="#">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                </path>
                            </svg>

                            <span class="ml-4"> @lang('messages.posts')</span>
                        </a>
                    </li>

                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="#">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>

                            <span class="ml-4"> @lang('messages.settings')</span>
                        </a>
                    </li>



                </ul>

                <div class="px-6 my-6">
                    <div
                        class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-dark transition-colors duration-150 border border-transparent rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-gray-200">
                        @lang('messages.looged_in_as') {{ Auth::user()->name }}
                    </div>
                </div>
            </div>
        </aside>

        <!-- Mobile sidebar -->
        <!-- Backdrop -->
        <div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
        </div>
        <aside
            class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
            x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
            @keydown.escape="closeSideMenu">
            <div class="py-4 text-gray-500 dark:text-gray-400">
                <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
                    href="{{ route('admin.dashboard') }}">
                    @lang('messages.title')
                </a>
                <ul class="mt-6">
                    <li class="relative px-6 py-3">
                        @if ($isDashboardActive)
                            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                                aria-hidden="true"></span>
                        @endif
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ $isDashboardActive ? 'text-gray-800 dark:text-gray-100' : '' }}"
                            href="{{ route('admin.dashboard') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            <span class="ml-4">@lang('messages.dashboard')</span>
                        </a>
                    </li>
                </ul>
                <ul>
                    <!-- Tickets Section -->
                    <li class="relative px-6 py-3">
                        @if ($isTicketsActive)
                            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                                aria-hidden="true"></span>
                        @endif
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ $isTicketsActive ? 'text-gray-800 dark:text-gray-100' : '' }}"
                            href="{{ route('admin.tickets.list') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 9V7a2 2 0 012-2h14a2 2 0 012 2v2a3 3 0 000 6v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-2a3 3 0 000-6z">
                                </path>
                            </svg>
                            <span class="ml-4">@lang('messages.tickets')</span>
                        </a>
                    </li>

                    <!-- Employees Section -->
                    <li class="relative px-6 py-3">
                        @if ($isEmployeesActive)
                            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                                aria-hidden="true"></span>
                        @endif
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ $isEmployeesActive ? 'text-gray-800 dark:text-gray-100' : '' }}"
                            href="{{ route('admin.employee.list') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M5.5 21a1.5 1.5 0 01-1.5-1.5V17a4 4 0 014-4h8a4 4 0 014 4v2.5a1.5 1.5 0 01-1.5 1.5H5.5z">
                                </path>
                                <path d="M12 11a4 4 0 100-8 4 4 0 000 8z"></path>
                            </svg>
                            <span class="ml-4">@lang('messages.employees')</span>
                        </a>
                    </li>

                    <!-- Ingenieurs Section -->
                    <li class="relative px-6 py-3">
                        @if ($isIngenActive)
                            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                                aria-hidden="true"></span>
                        @endif
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ $isIngenActive ? 'text-gray-800 dark:text-gray-100' : '' }}"
                            href="{{ route('admin.ingenieurs.list') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span class="ml-4">@lang('messages.ingenieurs')</span>
                        </a>
                    </li>

                    <!-- FAQs Section -->
                    <li class="relative px-6 py-3">
                        @if ($isFaqsActive)
                            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                                aria-hidden="true"></span>
                        @endif
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ $isFaqsActive ? 'text-gray-800 dark:text-gray-100' : '' }}"
                            href="{{ route('admin.faqs.list') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M9 18a2 2 0 01-2-2V8a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2h-6zm0 0V8h6v8h-6z">
                                </path>
                            </svg>
                            <span class="ml-4">@lang('messages.faqs')</span>
                        </a>
                    </li>

                    <!-- Departments Section -->
                    <li class="relative px-6 py-3">
                        @if ($isDepartmentsActive)
                            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                                aria-hidden="true"></span>
                        @endif
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ $isDepartmentsActive ? 'text-gray-800 dark:text-gray-100' : '' }}"
                            href="{{ route('admin.department.list') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            <span class="ml-4">@lang('messages.departments')</span>
                        </a>
                    </li>

                    <!-- Reviews Section -->
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="#">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                </path>
                            </svg>
                            <span class="ml-4">@lang('messages.reviews')</span>
                        </a>
                    </li>

                    <!-- Posts Section -->
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="#">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                </path>
                            </svg>
                            <span class="ml-4">@lang('messages.posts')</span>
                        </a>
                    </li>

                    <!-- Settings Section -->
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="#">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="ml-4">@lang('messages.settings')</span>
                        </a>
                    </li>
                </ul>

                <div class="px-6 my-6">
                    <div
                        class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-dark transition-colors duration-150 border border-transparent rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-gray-200">
                        @lang('messages.looged_in_as') {{ Auth::user()->name }}
                    </div>
                </div>
            </div>
        </aside>
        <div class="flex flex-col flex-1 w-full">
            <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
                <div
                    class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300">
                    <!-- Mobile hamburger -->
                    <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
                        @click="toggleSideMenu" aria-label="Menu">
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <!-- Search input -->
                    <div class="flex flex-1 lg:mr-32 items-center space-x-4">
                        <!-- Toggle sidebar button -->
                        <button id="toggleDeskbar"
                            class="p-2 rounded-md focus:outline-none focus:shadow-outline-purple hidden md:block"
                            @click="toggleDeskbar" aria-label="Toggle Deskbar">
                            <svg class="w-6 h-6 text-gray-700 dark:text-gray-200" aria-hidden="true"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4 6a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM4 11a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM4 16a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <!-- Chat button -->
                        <a href="https://dashboard.tawk.to/#/chat" target="_blank" rel="noopener noreferrer"
                            class="p-2 rounded-md focus:outline-none focus:shadow-outline-purple hidden md:block">
                            <svg class="w-6 h-6 text-gray-700 dark:text-gray-200" aria-hidden="true"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 3C6.48 3 2 6.92 2 12c0 2.14.72 4.12 1.93 5.75L2 21l3.26-1.48C7.14 20.5 9.47 21 12 21c5.52 0 10-3.92 10-9s-4.48-9-10-9zm0 16c-2.43 0-4.64-.79-6.43-2.14L4 17.5l.43-1.86C3.52 13.92 3 12.49 3 12c0-4.07 4.03-7 9-7s9 2.93 9 7-4.03 7-9 7zm-1-10h2v2h-2zm0 4h2v2h-2z">
                                </path>
                            </svg>
                        </a>
                    </div>


                    <ul class="flex items-center flex-shrink-0 space-x-6">
                        <!-- Theme toggler -->
                        <li class="flex">
                            <button class="rounded-md focus:outline-none focus:shadow-outline-purple"
                                @click="toggleTheme" aria-label="Toggle color mode">
                                <template x-if="!dark">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z">
                                        </path>
                                    </svg>
                                </template>
                                <template x-if="dark">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </template>
                            </button>
                        </li>
                       <!-- Bouton de notifications -->
                       <li class="relative" x-data="{ isNotificationsMenuOpen: false }">
                        <button @click="isNotificationsMenuOpen = !isNotificationsMenuOpen"
                            class="relative align-middle rounded-md focus:outline-none">
                            <svg class="w-6 h-6 text-gray-500 dark:text-gray-300" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                    
                            @if(auth()->user()->unreadNotifications->count())
                                <span aria-hidden="true"
                                    class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full dark:border-gray-800"></span>
                            @endif
                        </button>
                    
                        <template x-if="isNotificationsMenuOpen">
                            <ul x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                @click.away="isNotificationsMenuOpen = false" @keydown.escape="isNotificationsMenuOpen = false"
                                class="absolute right-0 w-80 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:text-gray-300 dark:border-gray-700 dark:bg-gray-700 z-50">
                    
                                @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
                                    <li class="flex">
                                        <form method="POST" action="{{ route('notifications.markAsRead', $notification->id) }}" class="w-full">
                                            @csrf
                                            <button type="submit"
                                                class="text-left w-full inline-flex flex-col px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                                                <span class="font-medium">{{ $notification->data['etat'] ?? 'New'}} Ticket #{{ $notification->data['ticket_id'] }}</span>
                                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                                    Created by {{ $notification->data['user_id'] }}
                                                </span>
                                                <span class="text-xs text-right text-gray-400">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </span>
                                            </button>
                                        </form>
                                    </li>
                                @empty
                                    <li class="text-sm text-center text-gray-500 dark:text-gray-400">
                                        Aucune nouvelle notification
                                    </li>
                                @endforelse
                    
                                @if(auth()->user()->unreadNotifications->count())
                                    <li>
                                        <form method="POST" action="{{ route('notifications.clearAll') }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-full px-4 py-2 text-sm font-medium text-red-600 text-center hover:underline dark:text-red-400">
                                                Supprimer toutes les notifications
                                            </button>
                                        </form>
                                    </li>
                                @endif
                    
                                <li>
                                    <a href="{{ route('notifications.index') }}"
                                        class="block px-4 py-2 text-center text-sm font-medium text-blue-600 hover:underline dark:text-blue-400">
                                        Voir toutes les notifications
                                    </a>
                                </li>
                            </ul>
                        </template>
                    </li>
                    

                        <!-- Profile menu -->
                        <li class="relative">
                            <button class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none"
                                @click="toggleProfileMenu" @keydown.escape="closeProfileMenu" aria-label="Account"
                                aria-haspopup="true">
                                <svg class="w-8 h-8 rounded-full text-gray-700 dark:text-gray-300" viewBox="0 0 24 24"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="8" r="4" />
                                    <path d="M4 20c0-4 4-6 8-6s8 2 8 6" />
                                </svg>
                            </button>
                            <template x-if="isProfileMenuOpen">
                                <ul x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    @click.away="closeProfileMenu" @keydown.escape="closeProfileMenu"
                                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
                                    aria-label="submenu">
                                    <li class="flex">
                                        <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                            href="{{ route('admin.profile.show', ['id' => auth::user()->id]) }}">
                                            <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                            <span> @lang('messages.profile')</span>
                                        </a>
                                    </li>
                                    <li class="flex">
                                        <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                            href="{{ route('admin.employee.editemployee', ['id' => auth::user()->id]) }}">
                                            <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path
                                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                                </path>
                                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span> @lang('messages.settings')</span>
                                        </a>
                                    </li>
                                    <li class="flex">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                                                <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path
                                                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                                    </path>
                                                </svg>
                                                <span>@lang('messages.logout')</span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </template>
                        </li>
                    </ul>
                </div>
            </header>

            <main class="h-full overflow-y-auto">
                <div class="container px-4 sm:px-6 mx-auto grid">
                    <nav
                        class="text-sm text-gray-500 dark:text-gray-400 py-3 px-4 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-sm my-4">
                        <ol class="list-reset flex flex-wrap items-center space-x-2">
                            <li class="flex items-center">
                                <a href="{{ route('admin.dashboard') }}"
                                    class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white flex items-center">
                                    <svg class="w-5 h-5 mr-1 text-gray-400 dark:text-gray-300" fill="none"
                                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 9.75L12 3l9 6.75M4.5 10.5V19.5a1.5 1.5 0 001.5 1.5h12a1.5 1.5 0 001.5-1.5V10.5">
                                        </path>
                                    </svg>
                                    @lang('messages.dashboard')
                                </a>
                            </li>

                            @php
                                $segments = request()->segments();
                                $url = '';
                            @endphp

                            @foreach ($segments as $index => $segment)
                                @php $url .= '/' . $segment; @endphp
                                <li class="text-gray-400 dark:text-gray-500">›</li>

                                @if ($index !== count($segments) - 1)
                                    <li>
                                        <a href="{{ url($url) }}"
                                            class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white capitalize">
                                            {{ str_replace('-', ' ', $segment) }}
                                        </a>
                                    </li>
                                @else
                                    <li class="text-black font-semibold dark:text-white capitalize">
                                        {{ str_replace('-', ' ', $segment) }}
                                    </li>
                                @endif
                            @endforeach
                        </ol>
                    </nav>
                    @if (session('demo'))
                        <div id="demo-alert"
                            class="px-4 py-3 rounded relative transition-all duration-300 w-full max-w-full overflow-hidden"
                            role="alert"
                            style="background-color: #dbeafe; border: 1px solid #60a5fa; color: #1e40af;">
                            <!-- Light mode styles applied directly -->
                            <div class="flex items-start">
                                <div class="flex-grow">
                                    <strong class="font-bold block mb-1"
                                        style="color: #1e40af;">{{ session('demo') }}</strong>
                                    <span class="block" style="color: #1e40af;">
                                        Ce mode est une version de démonstration.
                                        Vous pouvez naviguer dans l'interface, tester les fonctionnalités et simuler des
                                        actions.
                                        Cependant, aucune donnée ne sera réellement enregistrée.
                                    </span>
                                </div>
                                <button onclick="document.getElementById('demo-alert').style.display='none';"
                                    class="ml-4 focus:outline-none" aria-label="Close" style="color: #3b82f6;">
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <script>
                            setTimeout(() => {
                                const alertBox = document.getElementById('demo-alert');
                                if (alertBox) {
                                    alertBox.style.opacity = '0';
                                    setTimeout(() => {
                                        alertBox.style.display = 'none';
                                    }, 500);
                                }
                            }, 9000);
                        </script>
                    @endif


                    @yield('content')

                    <footer
                        class="px-6 py-4 mt-8 text-gray-700 dark:text-gray-400 border-t border-gray-200 dark:border-gray-700">
                        <div class="container mx-auto flex justify-end">
                            <p class="text-right text-sm">
                                @lang('messages.copyrights')
                                <strong>Béjaia (Akbou)</strong>
                            </p>
                        </div>
                    </footer>
                </div>
            </main>
        </div>
    </div>

  

</body>

</html>
