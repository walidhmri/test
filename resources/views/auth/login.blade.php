@extends('layouts.guest')

@section('title', __('messages.secure_login'))

@section('content')
<!-- Main Content -->
<div class="login-section py-5">
    <div class="container">
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
                                <i class="bi bi-shield-lock me-1"></i>
                                @lang('messages.secure_login')
                            </span>
                        </div>
                        <p class="text-muted mb-4">@lang('messages.signin_text')</p>
                        
                        @if ($errors->any())
                        <div class="error-message p-3 rounded mb-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-exclamation-circle text-danger me-2"></i>
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
                                        <i class="bi bi-person text-muted"></i>
                                    </span>
                                    <input type="text" class="form-control" id="email" name="email" 
                                           value="{{ old('email') }}" placeholder="@lang('messages.userid')" required autofocus>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label fw-medium">@lang('messages.password')</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock text-muted"></i>
                                    </span>
                                    <input type="password" class="form-control" id="password" name="password" 
                                           placeholder="••••••••" required>
                                    <button class="input-group-text bg-transparent border-start-0" type="button" id="togglePassword">
                                        <i class="bi bi-eye text-muted"></i>
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
                            
                            <button type="submit" class="btn naftal-btn w-100 py-2 mb-3">
                                <i class="bi bi-box-arrow-in-right me-2"></i> @lang('messages.login')
                            </button>
                        </form>
                        
                        <div class="divider">
                            <div class="divider-line"></div>
                            <span class="divider-text">@lang('messages.access')</span>
                            <div class="divider-line"></div>
                        </div>
                        <button type="button" class="btn naftal-btn w-100 py-2 mb-3" onclick="ekchem('12','password')">
                            <i class="bi bi-person-badge me-2"></i> Employee
                        </button>
                        <button type="button" class="btn naftal-btn w-100 py-2 mb-3" onclick="ekchem('12345','password')">
                            <i class="bi bi-person-lock me-2"></i> Admin
                        </button>
                        <button type="button" class="btn naftal-btn w-100 py-2 mb-3" onclick="ekchem('1234','password')">
                            <i class="bi bi-person-gear me-2"></i> Ingenieur
                        </button>
                        <div class="divider">
                            <div class="divider-line"></div>
                            <span class="divider-text">@lang('messages.system')</span>
                            <div class="divider-line"></div>
                        </div>
                        <div class="text-center text-muted" style="font-size: 0.875rem;">
                            <p class="mb-2">@lang('messages.last_update') <span class="fw-medium">Mars 8, 2025</span></p>
                            <a href="http://localhost/Ticket" class="text-decoration-none" style="color: var(--primary);">@lang('messages.support')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Login Page Styles */
    .login-section {
        min-height: calc(100vh - var(--header-height) - 80px);
        display: flex;
        align-items: center;
    }
    
    /* Login card */
    .login-card {
        background: var(--card-bg);
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: var(--shadow);
        width: 100%;
        max-width: 900px;
        margin: 0 auto;
        transition: all 0.3s ease;
    }
    
    .login-sidebar {
        background-image: url('{{ asset('assets/nftl.jpg') }}');
        background-repeat: no-repeat;
        background-size: cover;
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
    
    /* Naftal branding */
    .naftal-logo {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1.5rem;
        box-shadow: 0 4px 10px rgba(243, 156, 18, 0.3);
    }
    
    .naftal-btn {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
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
    
    /* RTL Support */
    [dir="rtl"] .circle-1 {
        right: auto;
        left: 10%;
    }
    
    [dir="rtl"] .circle-2 {
        left: auto;
        right: 10%;
    }
    
    [dir="rtl"] .input-group-text:first-child {
        border-radius: 0 0.5rem 0.5rem 0;
    }
    
    [dir="rtl"] .input-group-text:last-child {
        border-radius: 0.5rem 0 0 0.5rem;
    }
</style>
@endpush

@push('scripts')
<script>
    function ekchem(userid, password) {
        document.getElementById('email').value = userid;
        document.getElementById('password').value = password;
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Password visibility toggle
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        
        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                const icon = this.querySelector('i');
                icon.classList.toggle('bi-eye');
                icon.classList.toggle('bi-eye-slash');
            });
        }
        
        // Add shine effect to login button
        const loginButtons = document.querySelectorAll('.naftal-btn');
        loginButtons.forEach(button => {
            button.addEventListener('mouseover', function() {
                this.style.transition = 'all 0.3s ease';
            });
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
@endpush
@endsection
