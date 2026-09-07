<!DOCTYPE html>
<html
    lang="{{ app()->getLocale() }}"
    dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Translation Admin
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    @if(app()->getLocale() === 'ar')
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

        {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h1 class="mb-1">
                    Translation Admin
                </h1>

                <p class="text-muted mb-0">
                    Manage translations for all supported languages.
                </p>

            </div>

            <div>

                <a
                    href="{{ route('localization.index') }}"
                    class="btn btn-dark">

                    Home

                </a>

            </div>

        </div>


        {{-- =========================================================
         SUCCESS MESSAGE
    ========================================================== --}}

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


        {{-- =========================================================
         ERROR MESSAGE
    ========================================================== --}}

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


        {{-- =========================================================
         SEARCH + FILTER + ACTIONS
    ========================================================== --}}

        <div class="card shadow-sm mb-4">

            <div class="card-body">

                <form
                    method="GET"
                    action="{{ route('admin.index') }}">

                    <div class="row g-3 align-items-end">

                        {{-- Search --}}

                        <div class="col-md-5">

                            <label class="form-label">
                                Search
                            </label>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control"
                                placeholder="Search key or value...">

                        </div>


                        {{-- Language --}}

                        <div class="col-md-3">

                            <label class="form-label">
                                Language
                            </label>

                            <select
                                name="locale"
                                class="form-select">

                                <option value="">
                                    All Languages
                                </option>

                                <option
                                    value="en"
                                    {{ request('locale') === 'en' ? 'selected' : '' }}>
                                    EN
                                </option>

                                <option
                                    value="fr"
                                    {{ request('locale') === 'fr' ? 'selected' : '' }}>
                                    FR
                                </option>

                                <option
                                    value="de"
                                    {{ request('locale') === 'de' ? 'selected' : '' }}>
                                    DE
                                </option>

                                <option
                                    value="es"
                                    {{ request('locale') === 'es' ? 'selected' : '' }}>
                                    ES
                                </option>

                                <option
                                    value="hi"
                                    {{ request('locale') === 'hi' ? 'selected' : '' }}>
                                    HI
                                </option>

                                <option
                                    value="ar"
                                    {{ request('locale') === 'ar' ? 'selected' : '' }}>
                                    AR
                                </option>

                                <option
                                    value="gu"
                                    {{ request('locale') === 'gu' ? 'selected' : '' }}>
                                    GU
                                </option>

                            </select>

                        </div>


                        {{-- Search Button --}}

                        <div class="col-md-2">

                            <button
                                type="submit"
                                class="btn btn-primary w-100">

                                Search

                            </button>

                        </div>


                        {{-- Reset --}}

                        <div class="col-md-2">

                            <a
                                href="{{ route('admin.index') }}"
                                class="btn btn-secondary w-100">

                                Reset

                            </a>

                        </div>

                    </div>

                </form>


                {{-- Action Buttons --}}

                <div class="mt-3 d-flex gap-2 flex-wrap">

                    <button
                        type="button"
                        class="btn btn-success"
                        data-bs-toggle="modal"
                        data-bs-target="#addTranslationModal">

                        Add Translation

                    </button>


                    <a
                        href="{{ route('admin.export') }}"
                        class="btn btn-outline-primary">

                        Export CSV

                    </a>


                    <a
                        href="{{ route('admin.cache.clear') }}"
                        class="btn btn-outline-warning">

                        Clear Cache

                    </a>

                </div>

            </div>

        </div>


        {{-- =========================================================
         TRANSLATION TABLE
    ========================================================== --}}

        <div class="card shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <h4 class="mb-0">
                        All Translations
                    </h4>

                    <span class="badge bg-primary">

                        {{ $translations->total() }}

                        Records

                    </span>

                </div>


                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-dark">

                            <tr>

                                <th>
                                    ID
                                </th>

                                <th>
                                    Locale
                                </th>

                                <th>
                                    Key
                                </th>

                                <th>
                                    Value
                                </th>

                                <th style="width: 220px;">
                                    Actions
                                </th>

                            </tr>

                        </thead>

                        
                        <tbody>

                            @forelse($translations as $translation)

                            <tr>


                                <td>
                                    {{ $translations->firstItem() + $loop->index }}
                                </td>

                                <td>

                                    <span class="badge bg-info text-dark">

                                        {{ strtoupper($translation->locale) }}

                                    </span>

                                </td>

                                <td>

                                    <code>
                                        {{ $translation->key }}
                                    </code>

                                </td>

                                <td>

                                    {{ $translation->value }}

                                </td>

                                <td>

                                    <div class="d-flex gap-2">

                                        {{-- Edit --}}

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editTranslation{{ $translation->id }}">

                                            Edit

                                        </button>


                                        {{-- Delete --}}

                                        <form
                                            method="POST"
                                            action="{{ route('admin.destroy', $translation) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this translation?');">

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger">

                                                Delete

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>


                            {{-- =================================================
                                 EDIT MODAL
                            ================================================== --}}

                            <div
                                class="modal fade"
                                id="editTranslation{{ $translation->id }}"
                                tabindex="-1"
                                aria-hidden="true">

                                <div class="modal-dialog">

                                    <div class="modal-content">

                                        <div class="modal-header">

                                            <h5 class="modal-title">
                                                Edit Translation
                                            </h5>

                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal">
                                            </button>

                                        </div>


                                        <form
                                            method="POST"
                                            action="{{ route('admin.update', $translation) }}">

                                            @csrf

                                            @method('PUT')


                                            <div class="modal-body">

                                                <div class="mb-3">

                                                    <label class="form-label">
                                                        Locale
                                                    </label>

                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        value="{{ strtoupper($translation->locale) }}"
                                                        disabled>

                                                </div>


                                                <div class="mb-3">

                                                    <label class="form-label">
                                                        Key
                                                    </label>

                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        value="{{ $translation->key }}"
                                                        disabled>

                                                </div>


                                                <div class="mb-3">

                                                    <label class="form-label">
                                                        Value
                                                    </label>

                                                    <textarea
                                                        name="value"
                                                        class="form-control"
                                                        rows="4"
                                                        required>{{ $translation->value }}</textarea>

                                                </div>

                                            </div>


                                            <div class="modal-footer">

                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    data-bs-dismiss="modal">

                                                    Cancel

                                                </button>

                                                <button
                                                    type="submit"
                                                    class="btn btn-primary">

                                                    Update

                                                </button>

                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </div>

                            @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="text-center py-4">

                                    No translations found.

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- =========================================================
                 NUMERIC PAGINATION ONLY
            ========================================================== --}}

                @if($translations->hasPages())

                <div class="d-flex justify-content-center mt-4">

                    <ul class="pagination mb-0">

                        @for(
                        $page = 1;
                        $page <= $translations->lastPage();
                            $page++
                            )

                            <li
                                class="page-item
                                {{ $translations->currentPage() == $page
                                    ? 'active'
                                    : '' }}">

                                <a
                                    class="page-link"
                                    href="{{ $translations->url($page) }}">

                                    {{ $page }}

                                </a>

                            </li>

                            @endfor

                    </ul>

                </div>

                @endif

            </div>

        </div>

    </div>


    {{-- =========================================================
     ADD TRANSLATION MODAL
========================================================== --}}

    <div
        class="modal fade"
        id="addTranslationModal"
        tabindex="-1"
        aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        Add Translation
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>


                <form
                    method="POST"
                    action="{{ route('admin.store') }}">

                    @csrf


                    <div class="modal-body">

                        {{-- Locale --}}

                        <div class="mb-3">

                            <label class="form-label">
                                Language
                            </label>

                            <select
                                name="locale"
                                class="form-select"
                                required>

                                <option value="">
                                    Select Language
                                </option>

                                <option value="en">
                                    English
                                </option>

                                <option value="fr">
                                    Français
                                </option>

                                <option value="de">
                                    Deutsch
                                </option>

                                <option value="es">
                                    Español
                                </option>

                                <option value="hi">
                                    हिन्दी
                                </option>

                                <option value="ar">
                                    العربية
                                </option>

                                <option value="gu">
                                    ગુજરાતી
                                </option>

                            </select>

                        </div>


                        {{-- Key --}}

                        <div class="mb-3">

                            <label class="form-label">
                                Translation Key
                            </label>

                            <input
                                type="text"
                                name="key"
                                class="form-control"
                                placeholder="Example: welcome"
                                required>

                        </div>


                        {{-- Value --}}

                        <div class="mb-3">

                            <label class="form-label">
                                Translation Value
                            </label>

                            <textarea
                                name="value"
                                class="form-control"
                                rows="4"
                                placeholder="Enter translation..."
                                required></textarea>

                        </div>

                    </div>


                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                            Cancel

                        </button>

                        <button
                            type="submit"
                            class="btn btn-success">

                            Save Translation

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>