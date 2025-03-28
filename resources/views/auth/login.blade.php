<!DOCTYPE html>
<html lang="en" dir="@lang('messages.dir')">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Naftal secure login portal - Access your account safely">
<meta name="theme-color" content="#f39c12">
<title>Naftal - Secure Login</title>

<!-- Bootstrap CSS -->
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --primary: #f39c12;
        --primary-dark: #e67e22;
        --secondary: #2c3e50;
        --secondary-dark: #1a252f;
        --light: #f8f9fa;
        --dark: #121212;
        --dark-card: #1E1E1E;
        --naftal-gradient: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        --header-gradient: linear-gradient(135deg, var(--secondary), #1a1a2e);
    }
    
    body {
        font-family: 'Tajawal', sans-serif;
        background-color: #f8f9fa;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        transition: background-color 0.3s ease;
    }
    
    body.dark-mode {
        background-color: var(--dark);
        color: #fff;
    }
    
    .main-content {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
    }
    
    /* Naftal branding */
    .naftal-logo {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--naftal-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1.5rem;
        box-shadow: 0 4px 10px rgba(243, 156, 18, 0.3);
    }
    
    .naftal-btn {
        background: var(--naftal-gradient);
        border: none;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        border-radius: 30px;
        position: relative;
        overflow: hidden;
        z-index: 1;
        box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
    }
    
    .naftal-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: all 0.6s ease;
        z-index: -1;
    }
    
    .naftal-btn:hover::before {
        left: 100%;
    }
    
    .naftal-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(243, 156, 18, 0.4);
        color: white;
    }
    
    /* Login card */
    .login-card {
        background: white;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 900px;
        transition: all 0.3s ease;
    }
    
    .dark-mode .login-card {
        background-color: var(--dark-card);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }
    
    .login-sidebar {
        background: var(--naftal-gradient);
        position: relative;
        min-height: 300px;
    }
    
    .login-sidebar-content {
        position: relative;
        z-index: 2;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 2rem;
        color: white;
    }
    
    .login-sidebar::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.2);
        z-index: 1;
    }
    
    .sidebar-circle {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
    }
    
    .circle-1 {
        width: 80px;
        height: 80px;
        top: 20%;
        right: 10%;
    }
    
    .circle-2 {
        width: 40px;
        height: 40px;
        bottom: 30%;
        left: 10%;
    }
    
    /* Form styling */
    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.25rem rgba(243, 156, 18, 0.25);
    }
    
    .form-check-input:checked {
        background-color: var(--primary);
        border-color: var(--primary);
    }
    
    .input-group-text {
        background-color: transparent;
    }
    
    .dark-mode .form-control,
    .dark-mode .input-group-text {
        background-color: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.1);
        color: white;
    }
    
    .dark-mode .form-control::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }
    
    .dark-mode .text-muted {
        color: rgba(255, 255, 255, 0.6) !important;
    }
    
    .dark-mode .text-dark {
        color: white !important;
    }
    
    /* Header & Footer - IMPROVED */
    .navbar {
        padding: 0.75rem 1rem;
        background: var(--header-gradient) !important;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }
    
    .navbar-brand {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .navbar-brand img {
        width: 50px;
        height: 50px;
        object-fit: contain;
        transition: transform 0.3s ease;
        filter: drop-shadow(0 0 5px rgba(255, 255, 255, 0.3));
    }
    
    .navbar-brand span, .navbar-brand small {
        color: white !important;
    }
    
    .dark-mode .navbar,
    .dark-mode .footer {
        background: var(--dark-card) !important;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
    }
    
    .footer {
        padding: 1rem;
        background: var(--header-gradient);
        box-shadow: 0 -2px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        color: white;
    }
    
    .footer .text-muted {
        color: rgba(255, 255, 255, 0.7) !important;
    }
    
    /* Language dropdown - IMPROVED to match home page */
    .btn-outline-brand {
        background: transparent;
        color: white;
        border: 2px solid var(--primary);
        font-weight: 600;
        transition: all 0.3s ease;
        border-radius: 30px;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }
    
    .btn-outline-brand::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 0%;
        height: 100%;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        transition: all 0.3s ease;
        z-index: -1;
    }
    
    .btn-outline-brand:hover::before {
        width: 100%;
    }
    
    .btn-outline-brand:hover {
        color: white;
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(243, 156, 18, 0.3);
    }
    
    .dropdown-menu {
        border-radius: 0.5rem;
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .dark-mode .dropdown-menu {
        background-color: var(--dark-card);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }
    
    .dropdown-item {
        padding: 0.5rem 1rem;
        transition: all 0.2s ease;
    }
    
    .dark-mode .dropdown-item {
        color: white;
    }
    
    .dropdown-item:hover {
        background-color: rgba(243, 156, 18, 0.1);
    }
    
    .dark-mode .dropdown-item:hover {
        background-color: rgba(243, 156, 18, 0.2);
    }
    
    /* Dark mode toggle */
    .dark-mode-toggle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        color: white;
    }
    
    .dark-mode-toggle:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }
    
    .dark-mode .dark-mode-toggle:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
    
    /* Error message */
    .error-message {
        background-color: rgba(220, 53, 69, 0.1);
        border-left: 4px solid #dc3545;
    }
    
    .dark-mode .error-message {
        background-color: rgba(220, 53, 69, 0.2);
    }
    
    /* Divider */
    .divider {
        display: flex;
        align-items: center;
        margin: 1.5rem 0;
    }
    
    .divider-line {
        flex: 1;
        height: 1px;
        background-color: #dee2e6;
    }
    
    .dark-mode .divider-line {
        background-color: rgba(255, 255, 255, 0.2);
    }
    
    .divider-text {
        padding: 0 1rem;
        font-size: 0.75rem;
        text-transform: uppercase;
        color: #6c757d;
    }
    
    .dark-mode .divider-text {
        color: rgba(255, 255, 255, 0.6);
    }
    
    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fade-in {
        animation: fadeIn 0.5s ease forwards;
    }
</style>
</head>
<body>
<!-- Header - IMPROVED to match home page -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/ce/LogoNAFTAL.svg/1280px-LogoNAFTAL.svg.png" alt="Naftal Logo" class="rounded">
            <div>
                <span class="fw-bold fs-4">@lang('messages.platform_title')</span>
                <small class="d-block fs-6 text-white-50">@lang('messages.platform_subtitle')</small>
            </div>
        </a>
        
        <div class="d-flex align-items-center">
            <!-- Language Dropdown - Matches home page style -->
            <div class="dropdown me-2">
                <button class="btn btn-outline-brand px-4 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-translate me-1"></i> @lang('messages.langualge')
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                    <li><a class="dropdown-item" href="{{ url('locale/fr') }}">Français</a></li>
                    <li><a class="dropdown-item" href="{{ url('locale/en') }}">English</a></li>
                    <li><a class="dropdown-item" href="{{ url('locale/ar') }}">العربية</a></li>
                    <li><a class="dropdown-item" href="{{ url('locale/tm') }}">Kabyle</a></li>
                </ul>
            </div>
            
            <!-- Dark Mode Toggle -->
            <div class="dark-mode-toggle" id="darkModeToggle">
                <i class="bi bi-moon"></i>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="main-content">
    <div class="login-card animate-fade-in">
        <div class="row g-0">
            <!-- Left sidebar with Naftal branding -->
            <div class="col-md-5 login-sidebar d-none d-md-block">
                <div class="sidebar-circle circle-1"></div>
                <div class="sidebar-circle circle-2"></div>
                <div class="login-sidebar-content">
                    <div>
                        <div class="d-flex align-items-center">
                            <div class="bg-white rounded-circle p-2">
                                <div class="naftal-logo" style="width: 40px; height: 40px; font-size: 1.2rem;">N</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">@lang('messages.tickets')</h2>
                        <p class="mb-0 opacity-75">@lang('messages.platform_subtitle')</p>
                    </div>
                </div>
            </div>
            
            <!-- Login form -->
            <div class="col-md-7">
                <div class="p-4 p-lg-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3 fw-bold text-dark mb-0">@lang('messages.welcome_back')</h1>
                        <span class="badge bg-transparent text-dark d-flex align-items-center">
                            <i class="fas fa-lock me-1"></i>
                            @lang('messages.secure_login')
                        </span>
                    </div>
                    <p class="text-muted mb-4">@lang('messages.signin_text')</p>
                    
                    @if ($errors->any())
                    <div class="error-message p-3 rounded mb-4">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-circle text-danger me-2"></i>
                            <p class="fw-medium text-danger mb-0">Authentication failed</p>
                        </div>
                        <ul class="ps-4 mt-2 mb-0 text-danger" style="font-size: 0.9rem;">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label fw-medium">@lang('messages.userid')</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-user text-muted"></i>
                                </span>
                                <input type="text" class="form-control" id="email" name="email" 
                                       value="{{ old('email') }}" placeholder="@lang('messages.userid')" required autofocus>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label fw-medium">@lang('messages.password')</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock text-muted"></i>
                                </span>
                                <input type="password" class="form-control" id="password" name="password" 
                                       placeholder="••••••••" required>
                                <button class="input-group-text bg-transparent border-start-0" type="button" id="togglePassword">
                                    <i class="fas fa-eye text-muted"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label text-muted" for="remember">
                                    @lang('messages.remember_me')
                                </label>
                            </div>
                        </div>
                        
                        <!-- IMPROVED Button -->
                        <button type="submit" class="btn naftal-btn w-100 py-2 mb-3">
                            <i class="fas fa-sign-in-alt me-2"></i> @lang('messages.login')
                        </button>
                    </form>
                    
                    <div class="divider">
                        <div class="divider-line"></div>
                        <span class="divider-text">@lang('messages.access')</span>
                        <div class="divider-line"></div>
                    </div>
                    <button type="submit" class="btn naftal-btn w-100 py-2 mb-3" onclick="ekchem('12','password')">
                        <i class="fas fa-sign-in-alt me-2"></i> Employee
                    </button>
                    <button type="submit" class="btn naftal-btn w-100 py-2 mb-3" onclick="ekchem('12345','password')">
                        <i class="fas fa-sign-in-alt me-2"></i> Admin
                    </button>
                    <button type="submit" class="btn naftal-btn w-100 py-2 mb-3" onclick="ekchem('1234','password')">
                        <i class="fas fa-sign-in-alt me-2"></i> Ingenieur
                    </button>
                    <div class="divider">
                        <div class="divider-line"></div>
                        <span class="divider-text">@lang('messages.system')</span>
                        <div class="divider-line"></div>
                    </div>
                    <div class="text-center text-muted" style="font-size: 0.875rem;">
                        <p class="mb-2">@lang('messages.last_update')<span class="fw-medium">Mars 8, 2025</span></p>
                        <a href="http://localhost/ticket" class="text-decoration-none" style="color: var(--primary);">@lang('messages.support')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer - IMPROVED with Language Dropdown -->
<footer class="footer">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="d-flex gap-2">
                    <a href="/" class="btn naftal-btn btn-sm">
                        <i class="fas fa-home me-1"></i> @lang('messages.home')
                    </a>
                </div>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="text-muted mb-0" style="font-size: 0.875rem;">
                    &copy; @lang('messages.copyrights')
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function ekchem(userid, password) {
        document.getElementById('email').value = userid;
        document.getElementById('password').value = password;
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Dark mode toggle
        const darkModeToggle = document.getElementById('darkModeToggle');
        const body = document.body;
        const icon = darkModeToggle.querySelector('i');
        
        // Check for saved dark mode preference
        if (localStorage.getItem('dark') === 'true') {
            body.classList.add('dark-mode');
            icon.classList.remove('bi-moon');
            icon.classList.add('bi-sun');
        }
        
        // Toggle dark mode
        darkModeToggle.addEventListener('click', function() {
            body.classList.toggle('dark-mode');
            
            if (body.classList.contains('dark-mode')) {
                icon.classList.remove('bi-moon');
                icon.classList.add('bi-sun');
                localStorage.setItem('dark', 'true');
            } else {
                icon.classList.remove('bi-sun');
                icon.classList.add('bi-moon');
                localStorage.setItem('dark', 'false');
            }
        });
        
        // Password visibility toggle
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
        
        // Add shine effect to login button
        const loginButton = document.querySelector('.naftal-btn');
        loginButton.addEventListener('mouseover', function() {
            this.style.transition = 'all 0.3s ease';
        });
        
        // Track user activity
        let lastActivity = Date.now();
        const inactivityTimeout = 15 * 60 * 1000; // 15 minutes
        
        function resetActivity() {
            lastActivity = Date.now();
        }
        
        function checkInactivity() {
            if (Date.now() - lastActivity > inactivityTimeout) {
                console.log('User inactive for 15 minutes');
                // Could implement auto-logout or warning here
            }
        }
        
        // Reset activity timer when user interacts
        ['mousemove', 'keypress', 'click', 'touchstart'].forEach(event => {
            window.addEventListener(event, resetActivity);
        });
        
        // Check inactivity every minute
        setInterval(checkInactivity, 60000);
    });
</script>
</body>
</html>