<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="@lang('messages.dir')">

<head>
    <meta charset="utf-8">
    <title>@lang('messages.title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="منصة نافطال - الحل المتكامل لإدارة خدماتك البترولية بكل سهولة وأمان">

    <!-- Bootstrap RTL CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

    <!-- Google Fonts - Tajawal -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap"
        rel="stylesheet">

    <!-- AOS Animation Library -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        /* عام */
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        a,
        span,
        div {
            font-family: 'Tajawal', sans-serif;
        }

        /* ألوان العلامة التجارية */
        :root {
            --primary-color: #f39c12;
            /* لون أصفر ذهبي */
            --secondary-color: #2c3e50;
            /* لون داكن للتباين */
            --light-color: #ecf0f1;
            --accent-color: #e74c3c;
        }

        /* قسم الـ Hero */
        .hero-section {
            background:
                linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                url('https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Aire_de_Hmadna_%D9%85%D8%AD%D8%B7%D8%A9_%D8%A7%D9%84%D8%AD%D9%85%D8%A7%D8%AF%D9%86%D8%A9_-_panoramio_%285%29.jpg/1200px-Aire_de_Hmadna_%D9%85%D8%AD%D8%B7%D8%A9_%D8%A7%D9%84%D8%AD%D9%85%D8%A7%D8%AF%D9%86%D8%A9_-_panoramio_%285%29.jpg');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            min-height: 90vh;
            color: #fff;
            display: flex;
            align-items: center;
        }

        .hero-content {
            z-index: 2;
        }

        /* تأثيرات وتحسينات */
        .navbar {
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-brand {
            background-color: var(--primary-color);
            color: white;
            transition: all 0.3s ease;
        }

        .btn-brand:hover {
            background-color: #e67e22;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(243, 156, 18, 0.2);
        }

        .btn-outline-brand {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .btn-outline-brand:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .text-brand {
            color: var(--primary-color);
        }

        .card {
            transition: all 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: rgba(243, 156, 18, 0.1);
            margin-bottom: 1.5rem;
        }

        .testimonial-card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .stat-card {
            padding: 2rem;
            border-radius: 12px;
            background-color: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .stat-card .number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .partner-logo {
            height: 60px;
            object-fit: contain;
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        .partner-logo:hover {
            opacity: 1;
        }

        .nav-link {
            position: relative;
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            font-weight: 500;
        }

        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: var(--primary-color);
            transition: all 0.3s ease;
        }
        .navbar-nav {
    margin-left: auto !important;
    margin-right: 0 !important;
}

[dir="rtl"] .navbar-nav {
    margin-left: 0 !important;
    margin-right: auto !important;
}
[dir="ltr"] .footer {
    margin-left: auto;
    margin-right: auto !important;
}
[dir="ltr"] .footer {
    margin-left: auto;
    margin-right: auto !important;
}

        .nav-link:hover:after,
        .nav-link.active:after {
            width: 80%;
            left: 10%;
        }

        .section-title {
            position: relative;
            margin-bottom: 3rem;
        }

        .section-title:after {
            content: '';
            position: absolute;
            width: 50px;
            height: 3px;
            background-color: var(--primary-color);
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }

        /* قسم الخدمات */
        .service-card {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .service-card .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        /* قسم المميزات */
        .feature-icon i {
            font-size: 2rem;
            color: var(--primary-color);
        }

        /* للأجهزة الصغيرة */
        @media (max-width: 768px) {
            .hero-section {
                min-height: 70vh;
            }
        }
    </style>
</head>

<body class="bg-light text-dark d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="{{url('/')}}">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/ce/LogoNAFTAL.svg/1280px-LogoNAFTAL.svg.png" alt="logp" style="width: 50px; height: 50px; border-radius: 10%;">

            <small class="d-block fs-6 text-muted">@lang('messages.platform_subtitle')</small>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @if (Route::has('login'))
                    @auth
                    <li class="nav-item">
                        <a class="nav-link btn btn-brand px-4 mx-2"
                            href="@if(Auth::user()->role === 'admin') 
                             {{route('admin.dashboard')}} 
                            @elseif(Auth::user()->role === 'ingenieur') 
                             {{route('ingenieur.dashboard')}}
                            @else
                             {{route('dashboard')}}
                            @endif">
                            <i class="bi bi-speedometer2 me-1"></i> لوحة التحكم
                        </a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-brand px-4 mx-2" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i> تسجيل الدخول
                        </a>
                    </li>
                    @endauth
                    @endif
                    <div class="btn-group">
  <button type="button" class="btn btn-outline-brand px-4 mx-2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="bi bi-translate me-1"></i> @lang('messages.langualge')
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="locale/fr">Francais</a></li>
    <li><a class="dropdown-item" href="locale/en">Anglais</a></li>
    <li><a class="dropdown-item" href="locale/ar">Arabe</a></li>
    <li><a class="dropdown-item" href="locale/tm">Kabyle</a></li>
  </ul>
</div>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section position-relative">
        <div class="container hero-content">
            <div class="row">
                <div class="col-lg-7 mb-4 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
                    <h1 class="display-4 fw-bold mb-3">@lang('messages.integrated_solution')</h1>
                    <p class="lead mb-4">
                       @lang('messages.description')
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="" class="btn btn-brand fw-semibold px-5 py-3 fs-5">
                            <i class="bi bi-rocket me-1"></i> @lang('messages.get_started')
                        </a>
                        <a href="#faq" class="btn btn-light text-dark fw-semibold px-5 py-3 fs-5">
                            <i class="bi bi-info-circle me-1"></i> @lang('messages.learn_more')
                        </a>
                    </div>

                </div>
                <div class="col-lg-5 d-none d-lg-block" data-aos="fade-left" data-aos-delay="300">
                    <!-- محتوى تصويري مثل مخطط أو لوحة تحكم (placeholder) -->
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section / الأرقام والإحصائيات -->
    <section class="py-5">
    <div class="container">
        <div class="row g-4 justify-content-center" data-aos="fade-up">
            <div class="col-md-3 col-sm-6">
                <div class="stat-card h-100">
                    <div class="number" data-value="5000">5000+</div>
                    <p class="mb-0 text-secondary">@lang('messages.clients_active')</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card h-100">
                    <div class="number" data-value="150">150+</div>
                    <p class="mb-0 text-secondary">@lang('messages.fuel_stations')</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card h-100">
                    <div class="number" data-value="99">99%</div>
                    <p class="mb-0 text-secondary">@lang('messages.customer_satisfaction')</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card h-100">
                    <div class="number" data-value="25">25+</div>
                    <p class="mb-0 text-secondary">@lang('messages.years_of_experience')</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section / قسم الخدمات -->

<!-- Features Section -->

<!-- How It Works / كيف تعمل المنصة -->

<!-- Testimonials / آراء العملاء -->

<!-- FAQ Section / الأسئلة الشائعة -->
<section id="faq" class="py-5 bg-light">
    <div class="container">
        <h2 class="fw-bold section-title text-center" data-aos="fade-up">@lang('messages.faq_title')</h2>
        <p class="text-muted mb-5 text-center mx-auto" style="max-width: 700px;" data-aos="fade-up" data-aos-delay="100">
            @lang('messages.faq_description')
        </p>
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item border-0 shadow-sm mb-3 rounded">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button bg-white text-dark fw-semibold rounded" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                aria-controls="collapseOne">
                                @lang('messages.register_question')
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                @lang('messages.register_answer')
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 shadow-sm mb-3 rounded">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed bg-white text-dark fw-semibold rounded"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                aria-expanded="false" aria-controls="collapseTwo">
                                @lang('messages.payment_methods_question')
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                @lang('messages.payment_methods_answer')
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 shadow-sm mb-3 rounded">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed bg-white text-dark fw-semibold rounded"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                aria-expanded="false" aria-controls="collapseThree">
                                @lang('messages.delivery_time_question')
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                @lang('messages.delivery_time_answer')
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 shadow-sm mb-3 rounded">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed bg-white text-dark fw-semibold rounded"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                aria-expanded="false" aria-controls="collapseFour">
                                @lang('messages.cancel_order_question')
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                @lang('messages.cancel_order_answer')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Contact Section / قسم التواصل -->

    <!-- Call to Action / دعوة للتسجيل -->

    <!-- Footer / التذييل -->
    <footer class="bg-dark text-white pt-5 pb-3">
        <div class="container footer">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <a class="d-block text-white text-decoration-none mb-3" href="#">
                        <h3 class="fw-bold text-brand">@lang('messages.platform_title')</h3>
                    </a>
                    <p class="text-muted text-white-50">
                        @lang('messages.company_description')
                    </p>




            </div>

            <hr class="mt-4 mb-3 border-secondary">

            <div  class=" row align-items-center justify-content-between text-center text-md-start">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0 text-muted small fw-bold text-white-50">
                        © {{ date('Y') }} @lang('messages.footer')
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-muted text-decoration-none me-3 text-white-50">
                        @lang('messages.developper_walid') ©
                    </a>


            </div>
        </div>
    </footer>
    <!-- Back to Top Button -->
    <a href="#"
        class="btn btn-brand btn-lg position-fixed bottom-0 end-0 m-4 rounded-circle d-flex justify-content-center align-items-center"
        style="width: 50px; height: 50px;">
        <i class="bi bi-arrow-up"></i>
    </a>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation Library -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <!-- Custom JavaScript -->
    <script>
        // Initialize AOS Animation
        document.addEventListener('DOMContentLoaded', function () {
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
        });
    </script>
</body>

</html>
</antArtifact>