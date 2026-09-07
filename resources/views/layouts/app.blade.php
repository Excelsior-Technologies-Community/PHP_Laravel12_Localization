<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ in_array(app()->getLocale(), ['ar']) ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('lang.welcome')) - Laravel Localization</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @if(in_array(app()->getLocale(), ['ar']))
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    @endif
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar-brand { font-weight: 700; font-size: 1.5rem; letter-spacing: -0.5px; }
        .lang-btn { border-radius: 20px; font-size: 0.75rem; padding: 4px 12px; margin: 2px; }
        .lang-btn.active { background: #0d6efd; color: white; border-color: #0d6efd; }
        .card { border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.08); border-radius: 16px; transition: transform 0.2s, box-shadow 0.2s; }
        .card:hover { transform: translateY(-3px); box-shadow: 0 8px 30px rgba(0,0,0,0.12); }
        .feature-card { transition: transform 0.2s; }
        .feature-card:hover { transform: translateY(-4px); }
        .badge-locale { font-size: 1rem; padding: 8px 20px; border-radius: 20px; }
        .rtl-note { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 12px; }
        .section-title { border-left: 4px solid #0d6efd; padding-left: 12px; margin-bottom: 16px; font-weight: 600; }
        [dir="rtl"] .section-title { border-left: none; border-right: 4px solid #0d6efd; padding-left: 0; padding-right: 12px; }
        .hero-card { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .footer { background: #1a1d21; color: #adb5bd; }
        .lang-dropdown-item { cursor: pointer; }
        .lang-dropdown-item:hover { background: #f8f9fa; }
        .alert-dismissible .btn-close { padding: 0.75rem 1rem; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand text-warning" href="{{ route('home') }}">
            <i class="fab fa-laravel me-2"></i>Laravel I18N
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold' : '' }}" href="{{ route('home') }}">
                        <i class="fas fa-home me-1"></i>{{ trans('lang.home') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.*') ? 'active fw-bold' : '' }}" href="{{ route('admin.index') }}">
                        <i class="fas fa-cog me-1"></i>{{ trans('lang.admin') }}
                    </a>
                </li>
            </ul>

            {{-- Language Switcher Dropdown --}}
            <div class="dropdown">
                <button class="btn btn-outline-light dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="fw-semibold">{{ strtoupper(app()->getLocale()) }}</span>
                    <i class="fas fa-globe"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow">
                    @php
                        $languages = [
                            'en' => ['flag' => '🇬🇧', 'name' => 'English',  'native' => 'English'],
                            'fr' => ['flag' => '🇫🇷', 'name' => 'French',   'native' => 'Français'],
                            'de' => ['flag' => '🇩🇪', 'name' => 'German',   'native' => 'Deutsch'],
                            'es' => ['flag' => '🇪🇸', 'name' => 'Spanish',  'native' => 'Español'],
                            'hi' => ['flag' => '🇮🇳', 'name' => 'Hindi',    'native' => 'हिन्दी'],
                            'ar' => ['flag' => '🇸🇦', 'name' => 'Arabic',   'native' => 'العربية'],
                            'gu' => ['flag' => '🇮🇳', 'name' => 'Gujarati', 'native' => 'ગુજરાતી'],
                        ];
                    @endphp
                    @foreach($languages as $code => $lang)
                        <li>
                            <a href="{{ route('locale.set', $code) }}"
                               class="dropdown-item lang-dropdown-item d-flex align-items-center justify-content-between {{ app()->getLocale() === $code ? 'active text-primary fw-bold' : '' }}">
                                <span>{{ $lang['flag'] }} {{ $lang['native'] }}</span>
                                @if(app()->getLocale() === $code)
                                    <i class="fas fa-check text-primary"></i>
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</nav>

{{-- Flash Messages --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show m-0 rounded-0" role="alert">
    <div class="container">
        <i class="fas fa-check-circle me-2"></i><strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show m-0 rounded-0" role="alert">
    <div class="container">
        <i class="fas fa-exclamation-circle me-2"></i><strong>{{ session('error') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

<div class="container py-4">
    @yield('content')
</div>

<footer class="footer text-center py-4 mt-5">
    <div class="container">
        <p class="mb-0">
            <i class="fab fa-laravel me-2"></i>Laravel 12 Localization Demo
        </p>
        <small class="text-muted">7 Languages Supported | Session + Cookie + Browser Auto-Detect | RTL Support</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
