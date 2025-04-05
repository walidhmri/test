@extends('layouts.guest')

@section('title', __('messages.contact_us'))

@section('content')
<!-- Hero Section -->
<section class="py-5 bg-gradient-primary text-white">
    <div class="container py-5">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8" data-aos="fade-up">
                <h1 class="display-5 fw-bold mb-3">@lang('messages.get_in_touch')</h1>
                <p class="lead mb-0">@lang('messages.contact_subtitle')</p>
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

<!-- Contact Section -->
<section class="py-5">
    <div class="container py-4">
        <div class="row g-5">
            <!-- Contact Form -->
            <div class="col-lg-7" data-aos="fade-up">
                <div class="card shadow-sm border-0 p-4">
                    <h3 class="fw-bold mb-4">@lang('messages.send_message')</h3>
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="name" placeholder="@lang('messages.name')">
                                    <label for="name">@lang('messages.name')</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" placeholder="@lang('messages.email')">
                                    <label for="email">@lang('messages.email')</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="subject" placeholder="@lang('messages.subject')">
                                    <label for="subject">@lang('messages.subject')</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="message" style="height: 150px" placeholder="@lang('messages.message')"></textarea>
                                    <label for="message">@lang('messages.message')</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-brand py-3 px-5">
                                    <i class="bi bi-send me-2"></i> @lang('messages.send_message')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Contact Info -->
            <div class="col-lg-5" data-aos="fade-up" data-aos-delay="200">
                <!-- Map Card -->
                <div class="card shadow-sm border-0 mb-4 overflow-hidden">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d102239.59090098582!2d3.0307860232067383!3d36.76266057454128!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x128fb26977ea659f%3A0x3e42c9f52b5c0e83!2sAlger!5e0!3m2!1sfr!2sdz!4v1649252148316!5m2!1sfr!2sdz" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
                
                <!-- Contact Info Card -->
                <div class="card shadow-sm border-0 p-4">
                    <h3 class="fw-bold mb-4">@lang('messages.contact_info')</h3>
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-circle bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; flex-shrink: 0;">
                            <i class="bi bi-geo-alt fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-semibold mb-1">@lang('messages.address')</h5>
                            <p class="text-body-secondary mb-0">123 Rue des Hydrocarbures, Alger 16000, Algérie</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-circle bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; flex-shrink: 0;">
                            <i class="bi bi-telephone fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-semibold mb-1">@lang('messages.phone')</h5>
                            <p class="text-body-secondary mb-0">+213 (0) 21 XX XX XX</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-circle bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; flex-shrink: 0;">
                            <i class="bi bi-envelope fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-semibold mb-1">@lang('messages.email')</h5>
                            <p class="text-body-secondary mb-0">contact@naftal.dz</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; flex-shrink: 0;">
                            <i class="bi bi-clock fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-semibold mb-1">@lang('messages.working_hours')</h5>
                            <p class="text-body-secondary mb-0">@lang('messages.weekdays'): 8:00 - 16:30<br>@lang('messages.weekend'): @lang('messages.closed')</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
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
    
    /* Form Styling */
    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label {
        color: var(--primary);
    }
    
    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.25rem rgba(243, 156, 18, 0.25);
    }
    
    /* Icon Animation */
    .icon-circle {
        transition: all 0.3s ease;
    }
    
    .d-flex:hover .icon-circle {
        transform: scale(1.1);
        background-color: var(--primary) !important;
        color: white !important;
    }

    /* RTL Support */
    [dir="rtl"] .icon-circle {
        margin-right: 0;
        margin-left: 1rem;
    }

    [dir="rtl"] .form-floating > label {
        right: 0;
        left: auto;
    }

    /* Dark mode improvements */
    .dark-mode .card {
        background-color: var(--card-bg);
    }

    .dark-mode .text-body-secondary {
        color: var(--text-muted) !important;
    }

    .dark-mode .form-floating > .form-control:focus ~ label,
    .dark-mode .form-floating > .form-control:not(:placeholder-shown) ~ label {
        color: var(--primary);
        background-color: var(--card-bg);
        padding: 0 0.5rem;
    }
</style>
@endpush
@endsection

