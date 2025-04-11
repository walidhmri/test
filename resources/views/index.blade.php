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
                    @push('styles')
                    <style>
                    .hero-overlay {
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background-image: url('{{ asset('assets/nftl.webp') }}');
                        background-repeat: no-repeat;
                        background-size: cover;
                    }
                    </style>
                    <link href="{{ asset('assets/css/index.css') }}" rel="stylesheet">

                    @endpush

                    <div class="display-4 fw-bold mb-3 text-red">
                        <div id="typed-container">
                            <span id="typed-text"></span><span id="typed-cursor"></span>
                            <div class="highlight-effect" id="highlight"></div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const texts = [
                                '@lang('messages.name_hero')',
                                '@lang('messages.support_center_hero')',
                                '@lang('messages.we_are_here_to_help_hero')',
                                '@lang('messages.trusted_support_hero')',
                                '@lang('messages.technical_support_hero')',
                                '@lang('messages.instant_help_hero')',
                                '@lang('messages.client_support_hero')',
                                '@lang('messages.support_available_24_hero')',

                            ];



                            const container = document.getElementById('typed-text');
                            const containerParent = document.getElementById('typed-container');
                            const cursor = document.getElementById('typed-cursor');
                            const highlight = document.getElementById('highlight');
                            let currentTextIndex = 0;

                            function startTyping() {
                                // Clear the container
                                container.innerHTML = '';

                                const text = texts[currentTextIndex];
                                let charIndex = 0;

                                // Reset highlight
                                highlight.style.width = '0';

                                // Check if text contains Arabic characters
                                const isRTL = /[\u0600-\u06FF\u0750-\u077F\u08A0-\u08FF\uFB50-\uFDFF\uFE70-\uFEFF]/.test(text);

                                // Set appropriate text direction
                                containerParent.style.direction = isRTL ? 'rtl' : 'ltr';

                                function typeChar() {
                                    if (charIndex < text.length) {
                                        // Instead of rendering character by character, use whole word rendering for Arabic
                                        if (isRTL && charIndex === 0) {
                                            // For RTL languages, render the whole text at once to avoid joining issues
                                            const span = document.createElement('span');
                                            span.className = 'char';
                                            span.innerHTML = text;
                                            container.appendChild(span);
                                            charIndex = text.length;
                                        } else if (!isRTL) {
                                            // For LTR languages, continue character by character
                                            const span = document.createElement('span');
                                            span.className = 'char';

                                            // Handle spaces properly
                                            const char = text[charIndex];
                                            span.textContent = char === ' ' ? '\u00A0' : char;

                                            container.appendChild(span);
                                            charIndex++;
                                        }

                                        // Continue typing with a delay
                                        const typingSpeed = Math.floor(Math.random() * 30) + 70;
                                        setTimeout(typeChar, typingSpeed);
                                    } else {
                                        // Show highlight effect under the text
                                        setTimeout(() => {
                                            highlight.style.width = '100%';
                                        }, 500);

                                        // Wait before moving to next text
                                        setTimeout(() => {
                                            fadeOut();
                                        }, 3000);
                                    }
                                }

                                function fadeOut() {
                                    // Fade out the current text
                                    const chars = container.querySelectorAll('.char');
                                    chars.forEach(char => {
                                        char.classList.add('delete');
                                    });

                                    // Reset highlight
                                    highlight.style.width = '0';

                                    // Move to next text after fade out
                                    setTimeout(() => {
                                        currentTextIndex = (currentTextIndex + 1) % texts.length;
                                        startTyping();
                                    }, 700);
                                }

                                // Start typing
                                typeChar();
                            }

                            // Initialize typing animation
                            startTyping();
                        });
                    </script>

                
                    <div class="d-flex flex-wrap gap-3">
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-brand fw-semibold px-5 py-3 fs-5 btn-hover-scale">
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
                <path fill="var(--body-bg)" fill-opacity="1"
                    d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,133.3C672,139,768,181,864,181.3C960,181,1056,139,1152,122.7C1248,107,1344,117,1392,122.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
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
                        @foreach ($faqs as $faq)
                            <div class="accordion-item border-0 mb-4 rounded-4 shadow-sm overflow-hidden">
                                <h2 class="accordion-header" id="heading{{ $faq['id'] }}">
                                    <button class="accordion-button collapsed p-4 fw-semibold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq['id'] }}"
                                        aria-expanded="false" aria-controls="collapse{{ $faq['id'] }}">
                                        {{ $faq['question'] }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $faq['id'] }}" class="accordion-collapse collapse"
                                    aria-labelledby="heading{{ $faq['id'] }}" data-bs-parent="#faqAccordion">
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
 



    @push('scripts')
        <script src="{{asset('assets/js/index.js')}}">
 
        </script>
    @endpush
@endsection
