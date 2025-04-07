@extends('layouts.guest')

@section('title', __('messages.faqs'))

@section('content')
<!-- Hero Section -->
<section class="py-5 bg-gradient-primary text-white">
    <div class="container py-5">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8" data-aos="fade-up">
                <h1 class="display-5 fw-bold mb-3">@lang('messages.help_center')</h1>
                <p class="lead mb-0">@lang('messages.faqs_subtitle')</p>
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

<!-- FAQs Section -->
<section class="py-5">
    <div class="container py-4">
    <form action="{{route('faqs')}}">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-6" data-aos="fade-up">
                <div class="card p-3">
                    <div class="input-group">
                        
                        <input type="text" class="inputs form-control" name="search" placeholder="@lang('messages.search_faqs')" value="{{ old('search') }}">
                        <button class="btn btn-search" type="submit">@lang('messages.search')</button>
                    
                    </div>
                </div>
            </div>
        </div>
    </form>
        <div class="row g-4">
            <!-- FAQ Accordion -->
            <div class="col-lg-8" data-aos="fade-up">
                <div class="accordion faq-accordion" id="faqAccordion">
                    <!-- FAQ Loop -->
                    <h3 class="fw-bold mb-4">@lang('messages.general_questions')</h3>

                    @foreach($faqs as $index => $faq)
                        <div class="accordion-item border-0 mb-4 rounded-4 shadow-sm overflow-hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed p-4 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $index }}" aria-expanded="false">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="faq{{ $index }}" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body p-4 pt-0 text-body-secondary">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @php
                    $currentPage = $faqs->currentPage(); // الصفحة الحالية
                    $totalPages = $faqs->lastPage(); // إجمالي الصفحات
                  @endphp
                    <nav>
                        <ul class="pagination justify-content-center">
                            <!-- زر السابق -->
                            <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $faqs->previousPageUrl() }}" tabindex="-1">« Previous</a>
                            </li>
                      
                            <!-- أرقام الصفحات -->
                            @for ($i = 1; $i <= $totalPages; $i++)
                                <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $faqs->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                      
                            <!-- زر التالي -->
                            <li class="page-item {{ $currentPage == $totalPages ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $faqs->nextPageUrl() }}">Next »</a>
                            </li>
                        </ul>
                      </nav>
                </div>

            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Need Help Card -->
                <div class="card mb-4 p-4" data-aos="fade-up">
                    <div class="text-center mb-4">
                        <div class="icon-circle bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="bi bi-question-circle fs-1"></i>
                        </div>
                        <h4 class="fw-bold">@lang('messages.need_help')</h4>
                        <p class="text-body-secondary">@lang('messages.cant_find_answer')</p>
                    </div>
                    <a href="{{ url('/contact') }}" class="btn btn-brand w-100">
                        <i class="bi bi-headset me-2"></i> @lang('messages.contact_support')
                    </a>
                </div>

                <!-- Contact Card -->
                <div class="card bg-gradient-primary text-white" data-aos="fade-up">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3 text-white">@lang('messages.still_have_questions')</h4>
                        <p class="mb-4 text-white-75">@lang('messages.contact_us_description')</p>
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-circle bg-white bg-opacity-20 text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; flex-shrink: 0;">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <div>
                                <div class="small text-white-75">@lang('messages.phone')</div>
                                <div class="fw-semibold">+213 (0) 21 XX XX XX</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-circle bg-white bg-opacity-20 text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; flex-shrink: 0;">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div>
                                <div class="small text-white-75">@lang('messages.email')</div>
                                <div class="fw-semibold">support@naftal.dz</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-white bg-opacity-20 text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; flex-shrink: 0;">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div>
                                <div class="small text-white-75">@lang('messages.working_hours')</div>
                                <div class="fw-semibold">@lang('messages.weekdays'): 8:00 - 16:30</div>
                            </div>
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
    .inputs{
        border-radius: 20px;
    }
    
    /* Icon Circle */
    .icon-circle {
        transition: all 0.3s ease;
    }
    
    .card:hover .icon-circle {
        transform: scale(1.1);
    }

    /* RTL Support */
    [dir="rtl"] .icon-circle {
        margin-right: 0;
        margin-left: 1rem;
    }

    [dir="rtl"] .accordion-button::after {
        margin-left: 0;
        margin-right: auto;
    }

    /* Dark mode improvements */
    .dark-mode .card {
        background-color: var(--card-bg);
    }

    .dark-mode .text-body-secondary {
        color: var(--text-muted) !important;
    }

    .dark-mode .badge {
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
</style>
@endpush
@endsection

