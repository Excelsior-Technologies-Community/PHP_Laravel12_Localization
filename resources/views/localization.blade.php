<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ __('lang.page_title') }}
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            background: #f5f7fb;
            min-height: 100vh;
        }

        .localization-card {
            max-width: 900px;
            margin: 50px auto;
            border: none;
            border-radius: 18px;
            overflow: hidden;
        }

        .card-header-custom {
            padding: 30px;
        }

        .language-btn {
            min-width: 130px;
        }

        .info-box {
            border-radius: 12px;
            padding: 20px;
            height: 100%;
        }

        .message-box {
            border-radius: 12px;
            padding: 25px;
        }

        .translation-message {
            font-size: 1.25rem;
            font-weight: 500;
        }

        .current-language {
            font-size: 0.9rem;
        }

        .browser-box {
            border-radius: 12px;
            padding: 20px;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="card shadow localization-card">

        {{-- Header --}}
        <div class="card-header-custom bg-primary text-white">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>

                    <h2 class="mb-1">
                        {{ __('lang.page_title') }}
                    </h2>

                    <p class="mb-0 opacity-75">
                        {{ __('lang.page_description') }}
                    </p>

                </div>

                <span class="badge bg-light text-primary current-language">

                    {{ __('lang.current_language') }}:
                    {{ strtoupper(app()->getLocale()) }}

                </span>

            </div>

        </div>


        <div class="card-body p-4">

            {{-- Success Message --}}
            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show">

                    {{ session('success') }}

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                    </button>

                </div>

            @endif


            {{-- Error Message --}}
            @if(session('error'))

                <div class="alert alert-danger alert-dismissible fade show">

                    {{ session('error') }}

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                    </button>

                </div>

            @endif


            {{-- Language Switcher --}}
            <div class="mb-4">

                <h5 class="mb-3">
                    {{ __('lang.select_language') }}
                </h5>

                <div class="d-flex flex-wrap gap-2">

                    <a
                        href="{{ route('localization.change', 'en') }}"
                        class="btn
                        {{ app()->getLocale() === 'en'
                            ? 'btn-primary'
                            : 'btn-outline-primary' }}
                        language-btn"
                    >
                        🇬🇧 {{ __('lang.english') }}
                    </a>


                    <a
                        href="{{ route('localization.change', 'fr') }}"
                        class="btn
                        {{ app()->getLocale() === 'fr'
                            ? 'btn-primary'
                            : 'btn-outline-primary' }}
                        language-btn"
                    >
                        🇫🇷 {{ __('lang.french') }}
                    </a>


                    <a
                        href="{{ route('localization.change', 'de') }}"
                        class="btn
                        {{ app()->getLocale() === 'de'
                            ? 'btn-primary'
                            : 'btn-outline-primary' }}
                        language-btn"
                    >
                        🇩🇪 {{ __('lang.german') }}
                    </a>

                </div>

            </div>


            {{-- Browser Language Detection --}}
            <div class="browser-box bg-info bg-opacity-10 border border-info mb-4">

                <div class="d-flex align-items-start gap-3">

                    <div style="font-size: 30px;">
                        🌍
                    </div>

                    <div>

                        <h5 class="mb-1">
                            {{ __('lang.browser_detection') }}
                        </h5>

                        <p class="mb-2 text-muted">
                            {{ __('lang.browser_detection_description') }}
                        </p>

                        <div class="small">

                            <strong>
                                {{ __('lang.browser_language') }}:
                            </strong>

                            {{ request()->header('Accept-Language', 'Not available') }}

                        </div>

                    </div>

                </div>

            </div>


            {{-- Translation Message --}}
            <div class="message-box bg-light mb-4">

                <div class="text-muted small mb-2">

                    {{ __('lang.translated_message_label') }}

                </div>

                <div class="translation-message">

                    {{ __('lang.msg') }}

                </div>

            </div>


            {{-- Localization Information --}}
            <div class="row g-3 mb-4">


                {{-- Application Locale --}}
                <div class="col-md-4">

                    <div class="info-box bg-light">

                        <div class="text-muted small">

                            {{ __('lang.locale') }}

                        </div>

                        <h5 class="mb-0 mt-2">

                            {{ app()->getLocale() }}

                        </h5>

                    </div>

                </div>


                {{-- Fallback Locale --}}
                <div class="col-md-4">

                    <div class="info-box bg-light">

                        <div class="text-muted small">

                            {{ __('lang.fallback_locale') }}

                        </div>

                        <h5 class="mb-0 mt-2">

                            {{ config('app.fallback_locale') }}

                        </h5>

                    </div>

                </div>


                {{-- Session Language --}}
                <div class="col-md-4">

                    <div class="info-box bg-light">

                        <div class="text-muted small">

                            {{ __('lang.session_language') }}

                        </div>

                        <h5 class="mb-0 mt-2">

                            {{ session('locale', config('app.locale')) }}

                        </h5>

                    </div>

                </div>

            </div>


            {{-- Locale Formatting --}}
            <div>

                <h5 class="mb-3">

                    {{ __('lang.locale_formatting') }}

                </h5>

                <div class="row g-3">


                    {{-- Date --}}
                    <div class="col-md-6">

                        <div class="info-box border">

                            <div class="text-muted small">

                                {{ __('lang.formatted_date') }}

                            </div>

                            <h5 class="mb-0 mt-2">

                                {{ formatLocalizedDate(now()) }}

                            </h5>

                        </div>

                    </div>


                    {{-- Number --}}
                    <div class="col-md-6">

                        <div class="info-box border">

                            <div class="text-muted small">

                                {{ __('lang.formatted_number') }}

                            </div>

                            <h5 class="mb-0 mt-2">

                                {{ formatLocalizedNumber(1234567.89) }}

                            </h5>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Footer --}}
        <div class="card-footer bg-white text-center text-muted py-3">

            {{ __('lang.footer') }}

        </div>

    </div>

</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>