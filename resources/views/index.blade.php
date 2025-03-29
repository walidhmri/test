<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="@lang('messages.dir')">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="منصة نافطال - الحل المتكامل لإدارة خدماتك البترولية بكل سهولة وأمان">
    <title>@lang('messages.title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet" id="rtl-stylesheet" disabled>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <!-- Google Fonts - Tajawal -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary: #f39c12;
            --primary-dark: #e67e22;
            --secondary: #2c3e50;
            --light: #f8f9fa;
            --dark: #1a252f;
            --success: #2ecc71;
            --danger: #e74c3c;
            --info: #3498db;
            --warning: #f1c40f;
            --dark-card: #253341;
        }

        /* Base Styles */
        body {
            font-family: 'Tajawal', sans-serif;
            overflow-x: hidden;
            position: relative;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* RTL Support */
        [dir="rtl"] .ms-auto {
            margin-right: auto !important;
            margin-left: 0 !important;
        }

        [dir="rtl"] .me-1, [dir="rtl"] .me-2, [dir="rtl"] .me-3 {
            margin-left: 0.25rem !important;
            margin-right: 0 !important;
        }

        /* Navbar Styles - IMPROVED */
        .navbar {
            padding: 0.75rem 0;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, var(--secondary), #1a1a2e) !important;
        }

        .navbar.scrolled {
            padding: 0.5rem 0;
            background: linear-gradient(135deg, var(--secondary), #1a1a2e) !important;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
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

        .navbar.scrolled .navbar-brand img {
            transform: scale(0.9);
        }

        .navbar-brand span, .navbar-brand small {
            color: white !important;
        }

        .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.3);
            color: white;
        }

        .navbar-toggler-icon {
            filter: invert(1);
        }

        .nav-link {
            position: relative;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .nav-link:hover {
            color: white !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: var(--primary);
            transition: all 0.3s ease;
        }

        .nav-link:hover::after, 
        .nav-link.active::after {
            width: 80%;
            left: 10%;
        }

        /* Button Styles - IMPROVED */
        .btn-brand {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
            border-radius: 30px;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        .btn-brand::before {
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

        .btn-brand:hover::before {
            left: 100%;
        }

        .btn-brand:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(243, 156, 18, 0.4);
        }

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

        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                url('https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Aire_de_Hmadna_%D9%85%D8%AD%D8%B7%D8%A9_%D8%A7%D9%84%D8%AD%D9%85%D8%A7%D8%AF%D9%86%D8%A9_-_panoramio_%285%29.jpg/1200px-Aire_de_Hmadna_%D9%85%D8%AD%D8%B7%D8%A9_%D8%A7%D9%84%D8%AD%D9%85%D8%A7%D8%AF%D9%86%D8%A9_-_panoramio_%285%29.jpg');
            background-position: center;
            background-size: cover;
            background-attachment: fixed;
            min-height: 90vh;
            color: white;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(243, 156, 18, 0.3), rgba(44, 62, 80, 0.6));
            z-index: 1;
            animation: gradientShift 15s ease infinite;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        /* Stats Section */
        .stat-card {
            padding: 2.5rem 1.5rem;
            border-radius: 16px;
            background-color: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
            height: 100%;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            background: linear-gradient(135deg, rgba(243, 156, 18, 0.1), rgba(44, 62, 80, 0.05));
            z-index: 0;
            transform: scale(0);
            border-radius: 16px;
            transition: all 0.4s ease;
        }

        .stat-card:hover::before {
            transform: scale(1);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .stat-card .number {
            position: relative;
            z-index: 1;
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
            margin-bottom: 0.5rem;
        }

        .stat-card p {
            position: relative;
            z-index: 1;
        }

        /* Section Titles */
        .section-title {
            position: relative;
            margin-bottom: 3.5rem;
            font-weight: 800;
        }

        .section-title::after {
            content: '';
            position: absolute;
            width: 60px;
            height: 4px;
            background: linear-gradient(to right, var(--primary), var(--primary-dark));
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        /* FAQ Section */
        .accordion-item {
            border: none;
            margin-bottom: 1rem;
            border-radius: 12px !important;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .accordion-item:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .accordion-button {
            padding: 1.2rem 1.5rem;
            font-weight: 600;
            background-color: white;
            transition: all 0.3s ease;
        }

        .accordion-button:not(.collapsed) {
            color: var(--primary);
            background-color: rgba(243, 156, 18, 0.05);
        }

        .accordion-button:focus {
            box-shadow: none;
            border-color: rgba(243, 156, 18, 0.25);
        }

        .accordion-body {
            padding: 1.5rem;
            color: #666;
        }

        /* Footer */
        footer {
            position: relative;
            margin-top: auto;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
        }

        /* Back to Top Button */
        .back-to-top {
            width: 50px;
            height: 50px;
            position: fixed;
            bottom: 30px;
            right: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border-radius: 50%;
            z-index: 99;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(243, 156, 18, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(243, 156, 18, 0); }
            100% { box-shadow: 0 0 0 0 rgba(243, 156, 18, 0); }
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .hero-section {
                min-height: 80vh;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                min-height: 70vh;
            }
            
            .hero-section h1 {
                font-size: 2.5rem;
            }
            
            .stat-card .number {
                font-size: 2.5rem;
            }

            .navbar-brand img {
                width: 40px;
                height: 40px;
            }
        }

        @media (max-width: 576px) {
            .hero-section h1 {
                font-size: 2rem;
            }

            .stat-card {
                padding: 1.5rem 1rem;
            }

            .stat-card .number {
                font-size: 2rem;
            }
        }

        /* Dark Mode Toggle */
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
        
        body.dark-mode {
            background-color: var(--dark);
            color: #fff;
        }
        
        .dark-mode .navbar,
        .dark-mode .footer {
            background: var(--dark-card) !important;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
        }
        
        .dark-mode .text-muted {
            color: rgba(255, 255, 255, 0.6) !important;
        }
        
        .dark-mode .text-dark {
            color: white !important;
        }
        
        .dark-mode .card,
        .dark-mode .accordion-item {
            background-color: var(--dark-card);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        
        .dark-mode .bg-light {
            background-color: var(--dark) !important;
        }
        
        .dark-mode .accordion-button {
            background-color: var(--dark-card);
            color: white;
        }
        
        .dark-mode .accordion-button:not(.collapsed) {
            color: var(--primary);
            background-color: rgba(243, 156, 18, 0.1);
        }
    </style>
</head>

<body>
    <!-- Navbar - IMPROVED -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{url('/')}}">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/ce/LogoNAFTAL.svg/1280px-LogoNAFTAL.svg.png" alt="Naftal Logo" class="rounded">
                <div>
                    <span class="fw-bold fs-4">@lang('messages.platform_title')</span>
                    <small class="d-block fs-6 text-white-50">@lang('messages.platform_subtitle')</small>
                </div>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a class="btn btn-brand px-4 mx-2" href="@if(Auth::user()->role === 'admin')
                                    {{route('admin.dashboard')}}
                                    @elseif(Auth::user()->role === 'ingenieur')
                                    {{route('ingenieur.dashboard')}}
                                    @else
                                    {{route('dashboard')}}
                                    @endif">
                                    <i class="bi bi-speedometer2 me-1"></i> @lang('messages.dashboard')
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="btn btn-outline-brand px-4 mx-2" href="{{ route('login') }}">
                                    <i class="bi bi-box-arrow-in-right me-1"></i> @lang('messages.login')
                                </a>
                            </li>
                        @endauth
                    @endif
                    
                    <!-- Language Dropdown -->
                    <li class="nav-item dropdown">
                        <button class="btn btn-outline-brand px-4 mx-2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-translate me-1"></i> @lang('messages.langualge')
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                            <li><a class="dropdown-item" href="locale/fr">Français</a></li>
                            <li><a class="dropdown-item" href="locale/en">English</a></li>
                            <li><a class="dropdown-item" href="locale/ar">العربية</a></li>
                            <li><a class="dropdown-item" href="locale/tm">Kabyle</a></li>
                        </ul>
                    </li>
                    
                    <!-- Dark Mode Toggle - ADDED -->
                    <li class="nav-item ms-2">
                        <div class="dark-mode-toggle" id="darkModeToggle">
                            <i class="bi bi-moon"></i>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container hero-content">
            <div class="row">
                <div class="col-lg-7 mb-4 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
                    <h1 class="display-4 fw-bold mb-3">@lang('messages.integrated_solution')</h1>
                    <p class="lead mb-4">@lang('messages.description')</p>
                    <div class="d-flex flex-wrap gap-3">
                        @guest
                        <a href="{{route('login')}}" class="btn btn-brand fw-semibold px-5 py-3 fs-5">
                            <i class="bi bi-rocket me-1"></i> @lang('messages.get_started')
                        </a>
                        @endguest
                        <a href="#faq" class="btn btn-light text-green fw-semibold px-5 py-3 fs-5">
                            <i class="bi bi-info-circle me-1"></i> @lang('messages.learn_more')
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block" data-aos="fade-left" data-aos-delay="300">
                    <!-- Placeholder for dashboard visualization or illustration -->
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4 justify-content-center" data-aos="fade-up">
                <div class="col-md-3 col-sm-6">
                    <div class="stat-card">
                        <div class="number" data-value="5000">5000+</div>
                        <p class="mb-0 text-secondary">@lang('messages.clients_active')</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-card">
                        <div class="number" data-value="150">150+</div>
                        <p class="mb-0 text-secondary">@lang('messages.fuel_stations')</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-card">
                        <div class="number" data-value="99">99%</div>
                        <p class="mb-0 text-secondary">@lang('messages.customer_satisfaction')</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-card">
                        <div class="number" data-value="25">25+</div>
                        <p class="mb-0 text-secondary">@lang('messages.years_of_experience')</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-5 bg-light">
        <div class="container">
            <h2 class="fw-bold section-title text-center" data-aos="fade-up">@lang('messages.faq_title')</h2>
            <p class="text-muted mb-5 text-center mx-auto" style="max-width: 700px;" data-aos="fade-up" data-aos-delay="100">
                @lang('messages.faq_description')
            </p>
            <div class="row justify-content-center">
                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                    <div class="accordion" id="faqAccordion">
                        @foreach($faqs as $faq)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $faq['id'] }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq['id'] }}" aria-expanded="false" aria-controls="collapse{{ $faq['id'] }}">
                                        {{ $faq['question'] }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $faq['id'] }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq['id'] }}" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        {{ $faq['answer'] }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
            
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-5 pb-3">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <h3 class="fw-bold text-primary mb-4">@lang('messages.platform_title')</h3>
                    <p class="text-white-50">
                        @lang('messages.company_description')
                    </p>
                </div>
            </div>
            
            <hr class="mt-4 mb-3 border-secondary">
            
            <div class="row align-items-center justify-content-between text-center text-md-start">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0 text-white-50 small fw-bold">
                        © {{ date('Y') }} @lang('messages.footer')
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-white-50 text-decoration-none me-3">
                        @lang('messages.developper_walid') ©
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top">
        <i class="bi bi-arrow-up"></i>
    </a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize AOS Animation
            AOS.init({
                duration: 800,
                once: true
            });

            // Navbar scroll effect
            window.addEventListener('scroll', function () {
                const navbar = document.querySelector('.navbar');
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // Number counter animation
            const countElements = document.querySelectorAll('.number');
            countElements.forEach(el => {
                const target = parseInt(el.getAttribute('data-value'));
                let count = 0;
                const duration = 2000; // ms
                const interval = 50; // ms
                const step = target / (duration / interval);

                const timer = setInterval(() => {
                    count += step;
                    if (count >= target) {
                        count = target;
                        clearInterval(timer);
                    }
                    el.innerText = Math.floor(count) + (el.innerText.includes('%') ? '%' : '+');
                }, interval);
            });
            
            // Dark mode toggle - UPDATED to use the same localStorage key
            const darkModeToggle = document.getElementById('darkModeToggle');
            const body = document.body;
            const icon = darkModeToggle.querySelector('i');
            
            // Check for saved dark mode preference using a consistent key
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
        });
    </script>
</body>
</html>