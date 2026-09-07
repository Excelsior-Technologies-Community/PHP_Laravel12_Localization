@extends('layouts.app')

@section('title', trans('lang.admin'))

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0">
        <i class="fas fa-cog me-2 text-primary"></i>{{ trans('lang.admin') }}
    </h2>
    <a href="{{ route('home') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i>{{ trans('lang.home') }}
    </a>
</div>

{{-- Add Translation Form --}}
<div class="card mb-4 border-0">
    <div class="card-header bg-primary text-white fw-semibold">
        <i class="fas fa-plus me-2"></i>{{ trans('lang.add_translation') }}
    </div>
    <div class="card-body">
        <form action="{{ route('admin.store') }}" method="POST">
            @csrf
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label fw-semibold">{{ trans('lang.language') }}</label>
                    <select name="locale" class="form-select" required>
                        @foreach(['en'=>'English','fr'=>'Français','de'=>'Deutsch','es'=>'Español','hi'=>'हिन्दी','ar'=>'العربية','gu'=>'ગુજરાતી'] as $code => $name)
                            <option value="{{ $code }}">{{ $code }} - {{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">{{ trans('lang.key') }}</label>
                    <input type="text" name="key" class="form-control" placeholder="e.g. greeting" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">{{ trans('lang.value') }}</label>
                    <input type="text" name="value" class="form-control" placeholder="Translation value" required>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Translations Table --}}
<div class="card border-0">
    <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
        <span><i class="fas fa-database me-2"></i>{{ trans('lang.db_translations') }}</span>
        <span class="badge bg-warning text-dark">{{ $translations->count() }} {{ trans('lang.db_translations') }}</span>
    </div>
    <div class="card-body p-0">
        @if($translations->isEmpty())
            <div class="text-center py-5 text-muted">
                <i class="fas fa-inbox fa-3x mb-3"></i>
                <p>No translations yet. Add one above!</p>
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>{{ trans('lang.language') }}</th>
                        <th>{{ trans('lang.key') }}</th>
                        <th>{{ trans('lang.value') }}</th>
                        <th>{{ trans('lang.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($translations as $translation)
                    <tr>
                        <td class="text-muted">{{ $translation->id }}</td>
                        <td>
                            <span class="badge bg-primary">{{ strtoupper($translation->locale) }}</span>
                        </td>
                        <td>
                            <form action="{{ route('admin.update', $translation) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="text" name="value" value="{{ $translation->value }}" class="form-control form-control-sm d-inline-block" style="width: 300px;" required>
                        </td>
                        <td>
                                <button type="submit" class="btn btn-sm btn-outline-success me-1">
                                    <i class="fas fa-save"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('admin.destroy', $translation) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this translation?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

@endsection
