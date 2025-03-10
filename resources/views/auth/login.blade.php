<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Naftal secure login portal - Access your account safely" />
    <meta name="theme-color" content="#FF6B00" />
    <title>Naftal - Secure Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/tailwind.output.css') }}" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{ asset('assets/js/init-alpine.js') }}" defer></script>

    <!-- Custom styles for Naftal branding -->
    <style>
        :root {
            --naftal-orange: #FF6B00;
            --naftal-orange-dark: #E05A00;
            --naftal-yellow: #FFB800;
            --naftal-yellow-dark: #E0A000;
            --dark-bg: #1A1A1A;
            --dark-card: #292929;
        }
        
        .theme-dark {
            --naftal-text: #FFB800;
        }
        
        /* Fix for dark mode toggle */
        [x-cloak] { display: none !important; }
        
        /* Custom gradient for Naftal */
        .naftal-gradient {
            background: linear-gradient(135deg, var(--naftal-orange) 0%, var(--naftal-yellow) 100%);
        }
        
        .dark .naftal-gradient {
            background: linear-gradient(135deg, var(--naftal-orange-dark) 0%, var(--naftal-yellow-dark) 70%);
        }
        
        /* Button gradients */
        .naftal-btn {
            background: linear-gradient(to right, var(--naftal-orange), var(--naftal-yellow));
            transition: all 0.3s ease;
        }
        
        .naftal-btn:hover {
            background: linear-gradient(to right, var(--naftal-orange-dark), var(--naftal-yellow));
        }
        
        /* Custom inputs */
        .naftal-input:focus {
            border-color: var(--naftal-orange) !important;
            box-shadow: 0 0 0 2px rgba(255, 107, 0, 0.25);
        }
    </style>
</head>
<body class="flex flex-col min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-300"
      x-data="{ dark: localStorage.getItem('darkMode') === 'true' }"
      x-init="$watch('dark', val => localStorage.setItem('darkMode', val))">

    <!-- Header -->
    <header class="py-3 bg-white dark:bg-gray-800 shadow-sm transition-colors duration-300">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="h-10 w-10 rounded-full naftal-gradient flex items-center justify-center">
                        <span class="text-white font-bold text-lg">N</span>
                    </div>
                    <span class="ml-3 text-lg font-semibold text-gray-800 dark:text-gray-200">Naftal</span>
                </div>
                <button @click="dark = !dark" class="p-2 rounded-md text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-400" aria-label="Toggle dark mode">
                    <svg x-show="!dark" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg x-show="dark" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Login Container -->
    <div class="flex flex-1 items-center justify-center p-6">
        <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-xl shadow-xl dark:bg-gray-800 transition-colors duration-300">
            <div class="flex flex-col md:flex-row">
                <!-- Image Section with Naftal branding -->
                <div class="h-48 md:h-auto md:w-1/2 relative overflow-hidden">
                    <div class="absolute inset-0 naftal-gradient"></div>
                    <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                    <div class="absolute top-0 left-0 right-0 p-6">
                        <div class="flex items-center">
                            <div class="h-16 w-16 rounded-full bg-white flex items-center justify-center">
                                <div class="h-12 w-12 rounded-full naftal-gradient flex items-center justify-center">
                                    <span class="text-white font-bold text-xl">N</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                        <h2 class="text-2xl font-bold mb-2">Tickets</h2>
                    </div>
                    <!-- Decorative elements -->
                    <div class="absolute top-1/4 right-8">
                        <div class="h-12 w-12 rounded-full bg-white bg-opacity-20"></div>
                    </div>
                    <div class="absolute top-1/2 left-8">
                        <div class="h-8 w-8 rounded-full bg-white bg-opacity-10"></div>
                    </div>
                </div>

                <!-- Login Form -->
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">
                        <div class="flex items-center justify-between mb-2">
                            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Welcome Back</h1>
                            <span class="flex items-center text-sm text-orange-600 dark:text-orange-400">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                </svg>
                                Secure Login
                            </span>
                        </div>
                        <p class="mb-6 text-gray-600 dark:text-gray-400">Sign in to access your Naftal account dashboard</p>

                        <div x-data="{ loginAttempts: 0 }">
                            @if ($errors->any())
                                <div x-init="loginAttempts++" class="mb-4 p-3 bg-red-100 border-l-4 border-red-500 text-red-700 dark:bg-red-900/50 dark:text-red-300 rounded-md">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        <p class="font-medium">Authentication failed</p>
                                    </div>
                                    <ul class="ml-6 mt-2 list-disc text-sm">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <template x-if="loginAttempts >= 3">
                                        <p class="mt-2 text-sm">
                                            Too many failed attempts? <a href="{{ route('password.request') }}" class="font-medium underline">Reset your password</a> or <a href="/support" class="font-medium underline">contact support</a>.
                                        </p>
                                    </template>
                                </div>
                            @endif
                            
                            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                                @csrf
                                <div>
                                    <label class="block text-sm font-medium mb-2" for="user-id">
                                        <span class="text-gray-700 dark:text-gray-300">User ID</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input id="user-id"
                                            class="naftal-input block w-full pl-10 pr-4 py-3 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 focus:outline-none dark:text-gray-300 transition-all duration-200"
                                            type="text" name="email" value="{{ old('email') }}" required autofocus 
                                            placeholder="Enter your user ID" />
                                    </div>
                                </div>

                                <div x-data="{ showPassword: false }">
                                    <label class="block text-sm font-medium mb-2" for="password">
                                        <span class="text-gray-700 dark:text-gray-300">Password</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input id="password"
                                            class="naftal-input block w-full pl-10 pr-10 py-3 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 focus:outline-none dark:text-gray-300 transition-all duration-200"
                                            :type="showPassword ? 'text' : 'password'" 
                                            name="password" required 
                                            placeholder="••••••••" />
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                            <button type="button" @click="showPassword = !showPassword" class="text-gray-400 hover:text-gray-500 focus:outline-none" tabindex="-1">
                                                <svg x-show="!showPassword" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                                </svg>
                                                <svg x-show="showPassword" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M3.28 2.22a.75.75 0 00-1.06 1.06l14.5 14.5a.75.75 0 101.06-1.06l-1.745-1.745a10.029 10.029 0 003.3-4.38 1.651 1.651 0 000-1.185A10.004 10.004 0 009.999 3a9.956 9.956 0 00-4.744 1.194L3.28 2.22zM7.752 6.69l1.092 1.092a2.5 2.5 0 013.374 3.373l1.091 1.092a4 4 0 00-5.557-5.557z" clip-rule="evenodd"></path>
                                                    <path d="M10.748 13.93l2.523 2.523a9.987 9.987 0 01-3.27.547c-4.258 0-7.894-2.66-9.337-6.41a1.651 1.651 0 010-1.186A10.007 10.007 0 012.839 6.02L6.07 9.252a4 4 0 004.678 4.678z"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                    <label class="inline-flex items-center mb-2 sm:mb-0">
                                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-orange-600 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-500 focus:ring-opacity-50" />
                                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                                    </label>
                                    @if (Route::has('password.request'))
                                        <a class="text-sm font-medium text-orange-600 dark:text-orange-400 hover:underline transition-colors duration-200" href="{{ route('password.request') }}">
                                            Forgot your password?
                                        </a>
                                    @endif
                                </div>

                                <button type="submit" class="naftal-btn block w-full px-4 py-3 text-sm font-medium text-center text-white 
                                    transition-all duration-200 border border-transparent rounded-lg 
                                    focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                                    <div class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M14.243 5.757a6 6 0 10-.986 9.284 1 1 0 111.087 1.678A8 8 0 1118 10a3 3 0 01-4.8 2.401A4 4 0 1114 10a1 1 0 102 0c0-1.537-.586-3.07-1.757-4.243zM12 10a2 2 0 10-4 0 2 2 0 004 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        S'identifier
                                    </div>
                                </button>
                            </form>
                        </div>

                        <div class="flex items-center my-6">
                            <hr class="flex-1 border-gray-200 dark:border-gray-700" />
                            <span class="px-3 text-xs text-gray-500 dark:text-gray-400 uppercase">System information</span>
                            <hr class="flex-1 border-gray-200 dark:border-gray-700" />
                        </div>

                        <div class="text-xs text-center text-gray-500 dark:text-gray-400 space-y-2">
                            <p>Dernier mise a jour: <span class="font-medium">Mars 8, 2025</span></p>
                            <div class="flex justify-center space-x-4 mt-2">
                                <a href="/support" class="hover:text-orange-600 dark:hover:text-orange-400 transition-colors duration-200">Support</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-4 px-6 bg-white dark:bg-gray-800 shadow-inner transition-colors duration-300">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-2 md:space-y-0">
                <div class="flex space-x-4">
                    <a href="/" class="naftal-btn px-4 py-2 text-sm font-medium text-white rounded-lg 
                    transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Accueil
                        </div>
                    </a>
                    <a href="/language" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg 
                    transition-all duration-200 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7 2a1 1 0 011 1v1h3a1 1 0 110 2H9.578a18.87 18.87 0 01-1.724 4.78c.29.354.596.696.914 1.026a1 1 0 11-1.44 1.389c-.188-.196-.373-.396-.554-.6a19.098 19.098 0 01-3.107 3.567 1 1 0 01-1.334-1.49 17.087 17.087 0 003.13-3.733 18.992 18.992 0 01-1.487-2.494 1 1 0 111.79-.89c.234.47.489.928.764 1.372.417-.934.752-1.913.997-2.927H3a1 1 0 110-2h3V3a1 1 0 011-1zm6 6a1 1 0 01.894.553l2.991 5.982a.869.869 0 01.02.037l.99 1.98a1 1 0 11-1.79.895L15.383 16h-4.764l-.724 1.447a1 1 0 11-1.788-.894l.99-1.98.019-.038 2.99-5.982A1 1 0 0113 8zm-1.382 6h2.764L13 11.236 11.618 14z" clip-rule="evenodd"></path>
                            </svg>
                            Français
                        </div>
                    </a>
                </div>
                <div class="flex items-center">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        &copy; 2025 Naftal. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Fix dark mode toggle script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize dark mode from localStorage
            const darkModeStored = localStorage.getItem('darkMode');
            if (darkModeStored === 'true') {
                document.documentElement.classList.add('theme-dark');
            } else if (darkModeStored === null && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.classList.add('theme-dark');
                localStorage.setItem('darkMode', 'true');
            }
            
            // Track user activity
            let lastActivity = Date.now();
            const inactivityTimeout = 15 * 60 * 1000; // 15 minutes
            
            function resetActivity() {
                lastActivity = Date.now();
            }
            
            function checkInactivity() {
                if (Date.now() - lastActivity > inactivityTimeout) {
                    // Could implement auto-logout or warning here
                    console.log('User inactive for 15 minutes');
                }
            }
            
            // Reset activity timer when user interacts
            window.addEventListener('mousemove', resetActivity);
            window.addEventListener('keypress', resetActivity);
            window.addEventListener('click', resetActivity);
            
            // Check inactivity every minute
            setInterval(checkInactivity, 60000);
        });
    </script>
</body>
</html>