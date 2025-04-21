<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en" dir="@lang('messages.dir')">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Naftal -Ingenieur @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/chat-admin.css') }}">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/tailwind.output.css') }}" />

    <!-- Alpine.js -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{ asset('assets/js/init-alpine.js') }}"></script>

    <!-- Chart.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>

    <!-- Custom Scripts -->
    <script src="{{ asset('assets/js/charts-lines.js') }}" defer></script>
    <script src="{{ asset('assets/js/charts-pie.js') }}" defer></script>
    @stack('styles')
    @stack('head')
</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop sidebar -->
        @php
            use Illuminate\Support\Str;

            
            $isDashboardActive = request()->routeIs('ingenieur.dashboard');
            $isTicketsActive = Str::startsWith(request()->route()->getName(), 'ingenieur.Ticket');
            $isFaqsActive = Str::startsWith(request()->route()->getName(), 'ingenieur.comments');
            $isDepartmentsActive=Str::startsWith(request()->route()->getName(), 'ingenieur.department');

        @endphp


        <aside id="deskbar" class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block md:hidden">
            <div class="py-4 text-gray-500 dark:text-gray-400">
                <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
                    href="{{ route('ingenieur.dashboard') }}">
                    @lang('messages.title')
                </a>
                <ul class="mt-6">
                    <li class="relative px-6 py-3">
                        @if ($isDashboardActive)
                            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                                aria-hidden="true"></span>
                        @endif
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ $isDashboardActive ? 'text-gray-800 dark:text-gray-100' : '' }}"
                            href="{{ route('ingenieur.dashboard') }}">
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
                            href="{{ route('ingenieur.Ticket.list') }}">

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

           


                    <li class="relative px-6 py-3">
                        @if ($isFaqsActive)
                            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                                aria-hidden="true"></span>
                        @endif
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ $isFaqsActive ? 'text-gray-800 dark:text-gray-100' : '' }}"
                            href="{{ route('ingenieur.comments.list') }}">

                            <!-- Plus Icon -->
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M9 18a2 2 0 01-2-2V8a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2h-6zm0 0V8h6v8h-6z">
                                </path>
                            </svg>
                            <span class="ml-4"> @lang('messages.comments')</span>
                        </a>
                    </li>


                    <li class="relative px-6 py-3">
                        @if ($isDepartmentsActive)
                            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                                aria-hidden="true"></span>
                        @endif
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ $isDepartmentsActive ? 'text-gray-800 dark:text-gray-100' : '' }}"
                            href="{{ route('admin.department.list') }}">

                            <!-- New SVG Icon for Employees -->
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M5.5 21a1.5 1.5 0 01-1.5-1.5V17a4 4 0 014-4h8a4 4 0 014 4v2.5a1.5 1.5 0 01-1.5 1.5H5.5z">
                                </path>
                                <path d="M12 11a4 4 0 100-8 4 4 0 000 8z"></path>
                            </svg>

                            <span class="ml-4"> @lang('messages.departments')</span>
                        </a>
                    </li>
                </ul>

                <div class="px-6 my-6">
                    <a
                        class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-dark transition-colors duration-150 border border-transparent rounded-lg">
                        @lang('messages.looged_in_as') {{ Auth::user()->name }}
                    </a>
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
                <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
                    @lang('messages.platform_title')
                </a>
                <ul class="mt-6">
                    <li class="relative px-6 py-3">
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                            href="{{ route('dashboard') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            <span class="ml-4">Dashboard</span>
                        </a>
                    </li>
                </ul>
                <ul>
                    <li class="relative px-6 py-3">
                        <button
                            class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            @click="togglePagesMenu" aria-haspopup="true">
                            <span class="inline-flex items-center">
                                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path
                                        d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
                                    </path>
                                </svg>
                                <span class="ml-4">Tickets</span>
                            </span>
                            <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="{{ route('admin.employee.list') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                            <span class="ml-4">Employees</span>
                        </a>
                    </li>
                    </li>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="{{ route('admin.employee.list') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                            <span class="ml-4">Employees</span>
                        </a>
                    </li>


                </ul>

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
                        <!-- زر إظهار الشريط الجانبي -->
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

                        <!-- زر الدردشة يفتح في نافذة جديدة -->
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
                        <!-- Notifications menu -->
                        <li class="relative">
                            <button
                                class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-purple"
                                @click="toggleNotificationsMenu" @keydown.escape="closeNotificationsMenu"
                                aria-label="Notifications" aria-haspopup="true">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
                                    </path>
                                </svg>
                                <!-- Notification badge -->
                                <span aria-hidden="true"
                                    class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full dark:border-gray-800"></span>
                            </button>
                            <template x-if="isNotificationsMenuOpen">
                                <ul x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    @click.away="closeNotificationsMenu" @keydown.escape="closeNotificationsMenu"
                                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:text-gray-300 dark:border-gray-700 dark:bg-gray-700">
                                    <li class="flex">
                                        <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                            href="#">
                                            <span>Messages</span>
                                            <span
                                                class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600">
                                                13
                                            </span>
                                        </a>
                                    </li>
                                    <li class="flex">
                                        <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                            href="#">
                                            <span>Sales</span>
                                            <span
                                                class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600">
                                                2
                                            </span>
                                        </a>
                                    </li>
                                    <li class="flex">
                                        <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                            href="#">
                                            <span>Alerts</span>
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
                                            href="{{ route('ingenieur.profile.show', ['id' => auth::user()->id]) }}">
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
                <div class="container px-6 mx-auto grid">
                    <nav
                        class="text-sm text-gray-500 dark:text-gray-400 py-3 px-4 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-sm">
                        <ol class="list-reset flex items-center space-x-2">
                            <li class="flex items-center">
                                <a href="{{ route('ingenieur.dashboard') }}"
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
                    <footer class="px-6 py-2 text-gray-700 dark:text-gray-400">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deskbar = document.getElementById('deskbar');
            var toggleBtn = document.getElementById('toggleDeskbar');

            // إخفاء الشريط تلقائيًا على الشاشات الصغيرة
            function checkScreenSize() {
                if (window.innerWidth < 768) {
                    deskbar.style.display = 'none';
                } else {
                    var deskbarState = localStorage.getItem('deskbarState');
                    deskbar.style.display = deskbarState === 'visible' ? 'block' : 'none';
                }
            }

            // عند الضغط على الزر، يتم إظهار / إخفاء الشريط
            toggleBtn.addEventListener('click', function() {
                var isHidden = window.getComputedStyle(deskbar).display === 'none';
                deskbar.style.display = isHidden ? 'block' : 'none';
                localStorage.setItem('deskbarState', isHidden ? 'visible' : 'hidden');
            });

            // مراقبة تغيير حجم الشاشة وإعادة تطبيق القواعد
            window.addEventListener('resize', checkScreenSize);

            // استعادة الحالة عند تحميل الصفحة
            checkScreenSize();
        });
    </script>
</body>

</html>
