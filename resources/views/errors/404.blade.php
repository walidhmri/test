<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <title>منصة نافطال | خدمات بترولية متكاملة</title>
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
                url('https://images.unsplash.com/photo-1589758443084-128e504c3d5b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80');
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
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="{{ url('/') }}">
                <span class="text-brand">Naftal</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section position-relative">
        <div class="container hero-content">
            <h1 class=""> هذه الصفحة ليست متاحة او موجودة</h1>
            <p class="lead">الصفحة التي تبحث عنها غير موجودة أو تم نقلها. يرجى التحقق من الرابط والمحاولة مرة أخرى.</p>
            <a href="{{ url('/') }}" class="btn btn-brand mt-3">العودة للصفحة الرئيسية</a>
        </div>
    </section>
<!-- Back to Top Button -->

</body>

</html>
</antArtifact>