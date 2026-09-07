@extends('layouts.app')

@section('title', __('lang.welcome'))

@section('content')

{{-- Hero Section --}}
<div class="card hero-card text-white mb-4 border-0">
    <div class="card-body py-5 text-center">
        <h1 class="display-4 fw-bold mb-3">
            <i class="fas fa-globe me-3"></i>{{ trans('lang.welcome') }}
        </h1>
        <p class="lead mb-4 opacity-90">{{ trans('lang.msg') }}</p>
        <span class="badge bg-warning text-dark badge-locale fs-6">
            {{ trans('lang.current_language') }}: <strong>{{ strtoupper($locale) }}</strong>
        </span>
    </div>
</div>

{{-- RTL Note --}}
@if($isRtl)
<div class="rtl-note p-3 mb-4 text-center fw-semibold">
    <i class="fas fa-align-right me-2"></i>{{ trans('lang.rtl_note') }}
</div>
@endif

{{-- Browser Auto-detect Note --}}
@if(session('browser_detected'))
<div class="alert alert-info d-flex align-items-center">
    <i class="fas fa-robot me-2 fs-4"></i>
    <div><strong>{{ trans('lang.browser_detected') }}</strong></div>
</div>
@endif

<div class="row g-4">

    {{-- Language Switcher Card --}}
    <div class="col-lg-4">
        <div class="card feature-card h-100 border-0">
            <div class="card-body">
                <h5 class="section-title">
                    <i class="fas fa-language me-2 text-primary"></i>{{ trans('lang.select_language') }}
                </h5>
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
                <div class="row g-2">
                    @foreach($languages as $code => $lang)
                    <div class="col-6">
                        <a href="{{ route('locale.set', $code) }}"
                           class="btn w-100 text-start d-flex align-items-center gap-2 {{ $locale === $code ? 'btn-primary' : 'btn-outline-secondary' }}">
                            <span class="fs-5">{{ $lang['flag'] }}</span>
                            <span class="flex-grow-1">{{ $lang['native'] }}</span>
                            @if($locale === $code)
                                <i class="fas fa-check-circle ms-auto"></i>
                            @endif
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Date/Time Localization --}}
    <div class="col-lg-4">
        <div class="card feature-card h-100 border-0">
            <div class="card-body">
                <h5 class="section-title">
                    <i class="fas fa-calendar-alt me-2 text-success"></i>{{ trans('lang.current_date') }} & {{ trans('lang.current_time') }}
                </h5>
                <div class="mb-3 p-3 bg-light rounded">
                    <div class="text-muted small mb-1"><i class="far fa-calendar me-1"></i>{{ trans('lang.current_date') }}</div>
                    <div class="fs-5 fw-semibold text-success">📅 {{ $currentDate }}</div>
                </div>
                <div class="p-3 bg-light rounded">
                    <div class="text-muted small mb-1"><i class="far fa-clock me-1"></i>{{ trans('lang.current_time') }}</div>
                    <div class="fs-5 fw-semibold text-primary">🕐 {{ $currentTime }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Currency Formatting --}}
    <div class="col-lg-4">
        <div class="card feature-card h-100 border-0">
            <div class="card-body">
                <h5 class="section-title">
                    <i class="fas fa-money-bill-wave me-2 text-danger"></i>{{ trans('lang.price_label') }} (Number/Currency)
                </h5>
                <div class="p-4 bg-light rounded text-center">
                    <div class="text-muted small mb-1">{{ trans('lang.price_label') }} ({{ trans('lang.current_language') }}: {{ strtoupper($locale) }})</div>
                    <div class="display-4 fw-bold text-danger">{{ $formattedPrice }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Pluralization --}}
    <div class="col-lg-4">
        <div class="card feature-card h-100 border-0">
            <div class="card-body">
                <h5 class="section-title">
                    <i class="fas fa-list-ol me-2 text-warning"></i>Pluralization <code>trans_choice()</code>
                </h5>
                <p class="text-muted small mb-3">{{ trans('lang.items_count') }}</p>
                @foreach($itemCounts as $count)
                <div class="d-flex align-items-center mb-2 p-2 bg-light rounded">
                    <span class="badge bg-warning text-dark me-3" style="min-width:30px">{{ $count }}</span>
                    <span>{{ trans_choice('lang.items_count', $count, ['count' => $count]) }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- JSON Translations --}}
    <div class="col-lg-4">
        <div class="card feature-card h-100 border-0">
            <div class="card-body">
                <h5 class="section-title">
                    <i class="fas fa-file-code me-2 text-info"></i>JSON Translations <code>__()</code>
                </h5>
                @foreach(['Hello', 'Goodbye', 'Thank you'] as $key)
                <div class="d-flex justify-content-between align-items-center mb-2 p-2 bg-light rounded">
                    <span class="text-muted small">{{ $key }}</span>
                    <span class="badge bg-info text-dark fs-6">{{ __($key) }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- URL Prefix Routes --}}
    <div class="col-lg-4">
        <div class="card feature-card h-100 border-0">
            <div class="card-body">
                <h5 class="section-title">
                    <i class="fas fa-link me-2 text-secondary"></i>URL Prefix Routes
                </h5>
                <p class="text-muted small mb-3">Visit these URLs to change locale from URL prefix:</p>
                @foreach(['en','fr','de','es','hi','ar','gu'] as $code)
                <a href="{{ url($code . '/home') }}" class="btn btn-sm btn-outline-secondary me-1 mb-2">
                    /{{ $code }}/home
                </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Database Translations Preview --}}
    <div class="col-12">
        <div class="card feature-card border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="section-title mb-0">
                        <i class="fas fa-database me-2 text-primary"></i>{{ trans('lang.db_translations') }} ({{ strtoupper($locale) }})
                    </h5>
                    <a href="{{ route('admin.index') }}" class="btn btn-primary">
                        <i class="fas fa-cog me-1"></i>{{ trans('lang.admin') }}
                    </a>
                </div>
                @if($dbTranslations->isEmpty())
                    <div class="text-center py-4 text-muted">
                        <i class="fas fa-inbox fa-2x mb-2"></i>
                        <p>No database translations yet. Go to Admin Panel to add some!</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>{{ trans('lang.key') }}</th>
                                    <th>{{ trans('lang.value') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dbTranslations->take(5) as $t)
                                <tr>
                                    <td><code>{{ $t->key }}</code></td>
                                    <td>{{ $t->value }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($dbTranslations->count() > 5)
                    <div class="text-center mt-3">
                        <a href="{{ route('admin.index') }}" class="btn btn-outline-primary btn-sm">
                            View All {{ $dbTranslations->count() }} Translations
                        </a>
                    </div>
                    @endif
                @endif
            </div>
        </div>
    </div>

</div>
@endsection
