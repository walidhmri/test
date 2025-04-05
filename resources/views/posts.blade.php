@extends('layouts.guest')

@section('title', __('messages.posts'))

@section('content')
<!-- Hero Section -->
<section class="py-5 bg-gradient-primary text-white">
    <div class="container py-5">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8" data-aos="fade-up">
                <h1 class="display-5 fw-bold mb-3">@lang('messages.blog')</h1>
                <p class="lead mb-0">@lang('messages.posts_subtitle')</p>
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

<!-- Posts Section -->
<section class="py-5">
    <div class="container py-4">
        <div class="row g-4">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Search Bar -->
                <div class="card mb-4 p-3" data-aos="fade-up">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="@lang('messages.search_posts')">
                        <button class="btn btn-brand" type="button">@lang('messages.search')</button>
                    </div>
                </div>
                
                <!-- Featured Post -->
                <div class="card mb-4 overflow-hidden" data-aos="fade-up">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <img src="{{ asset('assets/images/blog/featured.jpg') }}" alt="Featured Post" class="img-fluid h-100 object-cover">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body d-flex flex-column h-100 p-4">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="badge bg-primary me-2">@lang('messages.featured')</span>
                                    <small class="text-body-secondary">@lang('messages.april') 15, 2023</small>
                                </div>
                                <h3 class="card-title fw-bold mb-3">Naftal Launches New Eco-Friendly Fuel Initiative</h3>
                                <p class="card-text flex-grow-1">Naftal is proud to announce the launch of our new eco-friendly fuel initiative aimed at reducing carbon emissions and promoting sustainable energy solutions across Algeria.</p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <a href="#" class="btn btn-outline-brand">@lang('messages.read_more')</a>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('assets/images/avatars/1.jpg') }}" alt="Author" class="rounded-circle me-2" width="30" height="30">
                                        <span class="small">Ahmed Benali</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Posts Grid -->
                <div class="row g-4">
                    @for ($i = 1; $i <= 6; $i++)
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                        <div class="card h-100">
                            <img src="{{ asset('assets/images/blog/' . $i . '.jpg') }}" class="card-img-top" alt="Post Image">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="badge bg-{{ ['primary', 'success', 'info', 'warning'][array_rand(['primary', 'success', 'info', 'warning'])] }} me-2">
                                        {{ ['News', 'Events', 'Announcements', 'Press Releases'][array_rand(['News', 'Events', 'Announcements', 'Press Releases'])] }}
                                    </span>
                                    <small class="text-body-secondary">{{ rand(1, 30) }} @lang('messages.days_ago')</small>
                                </div>
                                <h5 class="card-title fw-bold">Post Title {{ $i }}</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quam velit, vulputate eu pharetra nec, mattis ac neque.</p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <a href="#" class="btn btn-sm btn-outline-brand">@lang('messages.read_more')</a>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('assets/images/avatars/' . rand(1, 5) . '.jpg') }}" alt="Author" class="rounded-circle me-2" width="24" height="24">
                                        <span class="small">Author Name</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
                
                <!-- Pagination -->
                <nav class="mt-5" aria-label="Page navigation" data-aos="fade-up">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Recent Posts -->
                <div class="card mb-4" data-aos="fade-up">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-4">@lang('messages.recent_posts')</h5>
                        <div class="d-flex flex-column gap-3">
                            @for ($i = 1; $i <= 4; $i++)
                            <div class="d-flex gap-3">
                                <img src="{{ asset('assets/images/blog/small-' . $i . '.jpg') }}" alt="Recent Post" class="rounded" width="80" height="60" style="object-fit: cover;">
                                <div>
                                    <h6 class="mb-1 fw-semibold">Recent Post Title {{ $i }}</h6>
                                    <p class="small text-body-secondary mb-0">{{ rand(1, 10) }} @lang('messages.days_ago')</p>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
                
                <!-- Newsletter -->
                <div class="card mb-4 bg-gradient-primary text-white" data-aos="fade-up">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold mb-3 text-white">@lang('messages.subscribe_newsletter')</h5>
                        <p class="card-text mb-3 text-white-75">@lang('messages.newsletter_description')</p>
                        <form>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="@lang('messages.your_email')">
                            </div>
                            <button type="submit" class="btn btn-light w-100">@lang('messages.subscribe')</button>
                        </form>
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
    
    .object-cover {
        object-fit: cover;
    }
    
    /* Card hover effect */
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow);
    }
    
    /* Pagination styling */
    .pagination .page-link {
        color: var(--primary);
        border-color: var(--border-color);
        background-color: var(--card-bg);
    }
    
    .pagination .page-item.active .page-link {
        background-color: var(--primary);
        border-color: var(--primary);
        color: white;
    }
    
    .pagination .page-item.disabled .page-link {
        color: var(--text-muted);
        background-color: var(--card-bg);
        border-color: var(--border-color);
    }
</style>
@endpush
@endsection

