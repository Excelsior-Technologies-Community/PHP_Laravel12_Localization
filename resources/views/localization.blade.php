<!DOCTYPE html>
<html
    lang="{{ $locale }}"
    dir="{{ $isRtl ? 'rtl' : 'ltr' }}">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        {{ __('lang.title') }}
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

        
    @if($isRtl)
    <style>
        body {
            direction: rtl;
            text-align: right;
        }
    </style>
    @endif

</head>

<body class="bg-light">

    <div class="container py-5">

        {{-- Success --}}

        @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

        @endif

        {{-- Error --}}

        @if(session('error'))

        <div class="alert alert-danger">
            {{ session('error') }}
        </div>

        @endif


        <div class="card shadow">

            <div class="card-body">

                <h1 class="mb-3">
                    {{ __('lang.title') }}
                </h1>

                <p class="text-muted">
                    {{ __('lang.welcome') }}
                </p>

                <hr>


                {{-- Current Language --}}

                <h5>
                    {{ __('lang.current_language') }}
                </h5>

                <div class="alert alert-info">

                    <strong>
                        {{ strtoupper($locale) }}
                    </strong>

                </div>


                {{-- Language Switcher --}}

                <h5>
                    {{ __('lang.select_language') }}
                </h5>

                <div class="d-flex gap-2 flex-wrap mb-4">

                    @foreach($supportedLocales as $language)

                    <a
                        href="{{ route('localization.change', $language) }}"
                        class="btn
                        {{ $locale === $language
                            ? 'btn-success'
                            : 'btn-outline-primary' }}">

                        @switch($language)

                        @case('en')
                        English
                        @break

                        @case('fr')
                        Français
                        @break

                        @case('de')
                        Deutsch
                        @break

                        @case('es')
                        Español
                        @break

                        @case('hi')
                        हिन्दी
                        @break

                        @case('ar')
                        العربية
                        @break

                        @case('gu')
                        ગુજરાતી
                        @break

                        @endswitch

                    </a>

                    @endforeach

                </div>


                {{-- RTL status --}}

                <div class="alert alert-secondary">

                    <strong>
                        RTL:
                    </strong>

                    {{ $isRtl ? 'Yes' : 'No' }}

                </div>


                {{-- Home Demo --}}

                <a
                    href="{{ route('localization.home') }}"
                    class="btn btn-dark">
                    Open Localization Demo
                </a>


                {{-- Admin --}}

                <a
                    href="{{ route('admin.index') }}"
                    class="btn btn-primary">
                    Translation Admin
                </a>

            </div>

        </div>

    </div>

</body>

</html>