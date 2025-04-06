@extends('layouts.guest')

@section('content')
<!-- Hero Section with Animated Background -->
<section id="home" class="hero-section position-relative overflow-hidden">
    <!-- Animated Background -->
    <div class="animated-background">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
        <div class="shape shape-5"></div>
    </div>
    
    <!-- Overlay -->
    <div class="hero-overlay"></div>

    <div class="container hero-content position-relative z-3">
        <div class="row align-items-center min-vh-75">
            <div class="col-lg-7 mb-4 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
              
                <h1 class="display-4 fw-bold mb-3 text-red">@lang('messages.integrated_solution')</h1>
            
            <p style="color: var(--text-color);
                 font-weight: 700;
                 background-color:var(--background-new);
                 
                 display:flex;
                 
                                  text-align:center;             
                " class="lead mb-4 text-dark-75">@lang('messages.description')</p>
                <div class="d-flex flex-wrap gap-3">
                    @guest
                    <a href="{{route('login')}}" class="btn btn-brand fw-semibold px-5 py-3 fs-5 btn-hover-scale">
                        <i class="bi bi-rocket me-1"></i> @lang('messages.get_started')
                    </a>
                    @endguest
                    <a href="#faq" class="btn btn-light fw-semibold px-5 py-3 fs-5 btn-hover-scale">
                        <i class="bi bi-info-circle me-1"></i> @lang('messages.learn_more')
                    </a>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block" data-aos="fade-left" data-aos-delay="300">
                <!-- 3D Dashboard Visualization -->
                <div class="dashboard-visual">
                    <div class="dashboard-card dashboard-card-1">
                        <div class="dashboard-icon">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <div class="dashboard-content">
                            <h5>@lang('messages.analytics')</h5>
                            <div class="dashboard-chart"></div>
                        </div>
                    </div>
                    <div class="dashboard-card dashboard-card-2">
                        <div class="dashboard-icon">
                            <i class="bi bi-fuel-pump"></i>
                        </div>
                        <div class="dashboard-content">
                            <h5>@lang('messages.fuel_management')</h5>
                            <div class="dashboard-progress"></div>
                        </div>
                    </div>
                    <div class="dashboard-card dashboard-card-3">
                        <div class="dashboard-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div class="dashboard-content">
                            <h5>@lang('messages.station_locator')</h5>
                            <div class="dashboard-map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Wave Separator -->
    <div class="wave-separator">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="var(--body-bg)" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,133.3C672,139,768,181,864,181.3C960,181,1056,139,1152,122.7C1248,107,1344,117,1392,122.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</section>

<!-- Stats Section -->
<section class="py-5 stats-section">
    <div class="container py-4">
        <div class="row g-4 justify-content-center">
            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="stat-number count-up" data-value="5000">0</div>
                    <div class="stat-label">@lang('messages.clients_active')</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-building-fill"></i>
                    </div>
                    <div class="stat-number count-up" data-value="150">0</div>
                    <div class="stat-label">@lang('messages.fuel_stations')</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-emoji-smile-fill"></i>
                    </div>
                    <div class="stat-number count-up" data-value="99">0</div>
                    <div class="stat-label">@lang('messages.customer_satisfaction')</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="400">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-calendar-check-fill"></i>
                    </div>
                    <div class="stat-number count-up" data-value="25">0</div>
                    <div class="stat-label">@lang('messages.years_of_experience')</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 features-section bg-light bg-opacity-50">
    <div class="container py-5">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8" data-aos="fade-up">
                <h2 class="section-title">@lang('messages.our_features')</h2>
                <p class="text-body-secondary">@lang('messages.features_description')</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-speedometer2"></i>
                    </div>
                    <h4>@lang('messages.feature_1_title')</h4>
                    <p>@lang('messages.feature_1_description')</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h4>@lang('messages.feature_2_title')</h4>
                    <p>@lang('messages.feature_2_description')</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-graph-up"></i>
                    </div>
                    <h4>@lang('messages.feature_3_title')</h4>
                    <p>@lang('messages.feature_3_description')</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <h4>@lang('messages.feature_4_title')</h4>
                    <p>@lang('messages.feature_4_description')</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-phone"></i>
                    </div>
                    <h4>@lang('messages.feature_5_title')</h4>
                    <p>@lang('messages.feature_5_description')</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-headset"></i>
                    </div>
                    <h4>@lang('messages.feature_6_title')</h4>
                    <p>@lang('messages.feature_6_description')</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section id="faq" class="py-5">
    <div class="container py-5">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8" data-aos="fade-up">
                <h2 class="section-title">@lang('messages.faq_title')</h2>
                <p class="text-body-secondary">@lang('messages.faq_description')</p>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                <div class="accordion faq-accordion" id="faqAccordion">
                    @foreach($faqs as $faq)
                        <div class="accordion-item border-0 mb-4 rounded-4 shadow-sm overflow-hidden">
                            <h2 class="accordion-header" id="heading{{ $faq['id'] }}">
                                <button class="accordion-button collapsed p-4 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq['id'] }}" aria-expanded="false" aria-controls="collapse{{ $faq['id'] }}">
                                    {{ $faq['question'] }}
                                </button>
                            </h2>
                            <div id="collapse{{ $faq['id'] }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq['id'] }}" data-bs-parent="#faqAccordion">
                                <div class="accordion-body p-4 pt-0 text-body-secondary">
                                    {{ $faq['answer'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="300">
            <a href="{{ url('/faqs') }}" class="btn btn-outline-brand px-4 py-2">
                @lang('messages.view_all_faqs') <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-light bg-opacity-50">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10" data-aos="fade-up">
                <div class="cta-card bg-gradient-primary text-white rounded-4 p-5 text-center position-relative overflow-hidden">
                    <!-- Animated Shapes -->
                    <div class="cta-shape cta-shape-1"></div>
                    <div class="cta-shape cta-shape-2"></div>
                    <div class="cta-shape cta-shape-3"></div>
                    
                    <div class="position-relative z-2">
                        <h2 class="display-6 fw-bold mb-3">@lang('messages.cta_title')</h2>
                        <p class="lead mb-4 text-white-75">@lang('messages.cta_description')</p>
                        <a href="{{ url('/contact') }}" class="btn btn-light btn-lg px-5 py-3 fw-semibold btn-hover-scale">
                            <i class="bi bi-chat-dots me-2"></i>@lang('messages.contact_us')
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    /* Hero Section Styles */
    .hero-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        position: relative;
        padding: 6rem 0;
        overflow: hidden;
    }
    
    .min-vh-75 {
        min-height: 75vh;
    }
    
    /* Animated Background */
    .animated-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }
    
    .shape {
        position: absolute;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        animation: float 15s infinite ease-in-out;
    }
    
    .shape-1 {
        width: 300px;
        height: 300px;
        top: -150px;
        left: -100px;
        animation-delay: 0s;
    }
    
    .shape-2 {
        width: 200px;
        height: 200px;
        top: 50%;
        right: -100px;
        animation-delay: 2s;
    }
    
    .shape-3 {
        width: 400px;
        height: 400px;
        bottom: -200px;
        left: 30%;
        animation-delay: 4s;
    }
    
    .shape-4 {
        width: 150px;
        height: 150px;
        top: 20%;
        left: 20%;
        animation-delay: 6s;
    }
    
    .shape-5 {
        width: 250px;
        height: 250px;
        bottom: 20%;
        right: 20%;
        animation-delay: 8s;
    }
    
    @keyframes float {
        0% {
            transform: translate(0, 0) rotate(0deg);
        }
        25% {
            transform: translate(10px, 15px) rotate(5deg);
        }
        50% {
            transform: translate(5px, 10px) rotate(10deg);
        }
        75% {
            transform: translate(15px, 5px) rotate(5deg);
        }
        100% {
            transform: translate(0, 0) rotate(0deg);
        }
    }
    
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url({{asset('assets/nftl.jpg')}});
        background-repeat: no-repeat;
        background-size:cover;
    }
    
    /* Wave Separator */
    .wave-separator {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        line-height: 0;
        direction: ltr;
    }
    
    .wave-separator svg {
        width: 100%;
        height: 80px;
    }
    
    /* Dashboard Visualization */
    .dashboard-visual {
        position: relative;
        height: 400px;
        perspective: 1000px;
    }
    
    .dashboard-card {
        position: absolute;
        width: 280px;
        height: 180px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 20px;
        display: flex;
        flex-direction: column;
        transition: all 0.5s ease;
        transform-style: preserve-3d;
        animation: float-card 6s infinite ease-in-out;
    }
    
    .dark-mode .dashboard-card {
        background: rgba(40, 40, 40, 0.9);
        color: var(--text-color);
    }
    
    .dashboard-card-1 {
        top: 0;
        left: 0;
        z-index: 3;
        animation-delay: 0s;
    }
    
    .dashboard-card-2 {
        top: 100px;
        left: 40px;
        z-index: 2;
        animation-delay: 2s;
    }
    
    .dashboard-card-3 {
        top: 200px;
        left: 80px;
        z-index: 1;
        animation-delay: 4s;
    }
    
    @keyframes float-card {
        0% {
            transform: translateZ(0) translateY(0);
        }
        50% {
            transform: translateZ(20px) translateY(-10px);
        }
        100% {
            transform: translateZ(0) translateY(0);
        }
    }
    
    .dashboard-icon {
        width: 40px;
        height: 40px;
        background: var(--primary);
        color: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin-bottom: 10px;
    }
    
    .dashboard-content h5 {
        font-size: 1rem;
        margin-bottom: 10px;
        color: var(--text-color);
    }
    
    .dashboard-chart, .dashboard-progress, .dashboard-map {
        height: 80px;
        background: rgba(243, 156, 18, 0.1);
        border-radius: 8px;
        position: relative;
        overflow: hidden;
    }
    
    .dashboard-chart::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        height: 2px;
        background: rgba(243, 156, 18, 0.3);
    }
    
    .dashboard-chart::after {
        content: '';
        position: absolute;
        bottom: 20px;
        left: 10px;
        width: 80%;
        height: 30px;
        background: var(--primary);
        opacity: 0.5;
        border-radius: 4px;
        clip-path: polygon(0 100%, 10% 70%, 20% 90%, 30% 50%, 40% 60%, 50% 30%, 60% 40%, 70% 20%, 80% 40%, 90% 10%, 100% 50%, 100% 100%);
    }
    
    .dashboard-progress::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 10%;
        width: 80%;
        height: 10px;
        background: rgba(243, 156, 18, 0.2);
        border-radius: 5px;
        transform: translateY(-50%);
    }
    
    .dashboard-progress::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 10%;
        width: 60%;
        height: 10px;
        background: var(--primary);
        border-radius: 5px;
        transform: translateY(-50%);
    }
    
    .dashboard-map {
        background-image: radial-gradient(circle, rgba(243, 156, 18, 0.2) 1px, transparent 1px);
        background-size: 10px 10px;
    }
    
    .dashboard-map::before {
        content: '';
        position: absolute;
        top: 30%;
        left: 40%;
        width: 15px;
        height: 15px;
        background: var(--primary);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        box-shadow: 0 0 0 5px rgba(243, 156, 18, 0.3);
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(243, 156, 18, 0.5);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(243, 156, 18, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(243, 156, 18, 0);
        }
    }
    
    /* Stats Section */
    .stats-section {
        position: relative;
        z-index: 1;
    }
    
    .stat-card {
        background-color: var(--card-bg);
        border-radius: 1rem;
        padding: 2rem;
        text-align: center;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    
    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow);
    }
    
    .stat-icon {
        width: 70px;
        height: 70px;
        background-color: var(--primary-light);
        color: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin-bottom: 1.5rem;
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 0.5rem;
        position: relative;
    }
    
    .stat-number::after {
        content: '+';
        position: absolute;
        font-size: 1.5rem;
        top: 0;
    }
    
    .stat-label {
        font-size: 1rem;
        color: var(--text-muted);
    }
    
    /* Features Section */
    .feature-card {
        background-color: var(--card-bg);
        border-radius: 1rem;
        padding: 2rem;
        height: 100%;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
        text-align: center;
    }
    
    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow);
    }
    
    .feature-icon {
        width: 80px;
        height: 80px;
        background-color: var(--primary-light);
        color: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin: 0 auto 1.5rem;
        transition: all 0.3s ease;
    }
    
    .feature-card:hover .feature-icon {
        background-color: var(--primary);
        color: white;
        transform: rotateY(180deg);
    }
    
    .feature-card h4 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: var(--text-color);
    }
    
    .feature-card p {
        color: var(--text-muted);
        margin-bottom: 0;
    }
    
    /* FAQ Accordion */
    .faq-accordion .accordion-item {
        transition: all 0.3s ease;
    }
    
    .faq-accordion .accordion-item:hover {
        transform: translateY(-5px);
    }
    
    .faq-accordion .accordion-button {
        background-color: var(--card-bg);
        color: var(--text-color);
    }
    
    .faq-accordion .accordion-button:not(.collapsed) {
        background-color: var(--primary-light);
        color: var(--primary);
        box-shadow: none;
    }
    
    .faq-accordion .accordion-button::after {
        transition: all 0.3s ease;
    }
    
    .dark-mode .faq-accordion .accordion-button::after {
        filter: invert(1);
    }
    
    /* CTA Section */
    .cta-card {
        overflow: hidden;
    }
    
    .cta-shape {
        position: absolute;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }
    
    .cta-shape-1 {
        width: 300px;
        height: 300px;
        top: -150px;
        right: -100px;
    }
    
    .cta-shape-2 {
        width: 200px;
        height: 200px;
        bottom: -100px;
        left: -50px;
    }
    
    .cta-shape-3 {
        width: 100px;
        height: 100px;
        top: 50px;
        left: 30%;
    }
    
    /* Button Hover Effect */
    .btn-hover-scale {
        transition: all 0.3s ease;
    }
    
    .btn-hover-scale:hover {
        transform: scale(1.05);
    }
    
    /* Count Up Animation */
    .count-up {
        display: inline-block;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
        .hero-section {
            padding: 4rem 0;
        }
        
        .dashboard-visual {
            height: 300px;
        }
        
        .dashboard-card {
            width: 220px;
            height: 150px;
        }
    }
    
    @media (max-width: 767.98px) {
        .dashboard-visual {
            display: none;
        }
        
        .stat-number {
            font-size: 2rem;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Count Up Animation
    document.addEventListener('DOMContentLoaded', function() {
        const countUpElements = document.querySelectorAll('.count-up');
        
        const options = {
            threshold: 0.5
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = entry.target;
                    const targetValue = parseInt(target.getAttribute('data-value'));
                    const duration = 2000; // 2 seconds
                    const step = targetValue / (duration / 16); // 60fps
                    
                    let current = 0;
                    const timer = setInterval(() => {
                        current += step;
                        if (current >= targetValue) {
                            target.textContent = targetValue;
                            clearInterval(timer);
                        } else {
                            target.textContent = Math.floor(current);
                        }
                    }, 16);
                    
                    observer.unobserve(target);
                }
            });
        }, options);
        
        countUpElements.forEach(element => {
            observer.observe(element);
        });
    });
    
    // Parallax Effect for Hero Section
    document.addEventListener('DOMContentLoaded', function() {
        const heroSection = document.querySelector('.hero-section');
        
        if (heroSection) {
            window.addEventListener('scroll', function() {
                const scrollPosition = window.scrollY;
                const shapes = document.querySelectorAll('.shape');
                
                shapes.forEach((shape, index) => {
                    const speed = 0.1 + (index * 0.05);
                    const yPos = scrollPosition * speed;
                    shape.style.transform = `translateY(${yPos}px)`;
                });
            });
        }
    });
</script>
@endpush
@endsection