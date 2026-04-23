@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Crea Nuovo Corso</h1>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Torna alla lista</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('courses.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Titolo</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Descrizione</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Durata (ore)</label>
                        <input type="number" name="duration_hours" class="form-control"
                            value="{{ old('duration_hours') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stato</label>
                        <input type="text" name="status" class="form-control" value="{{ old('status') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Requisiti</label>
                    <textarea name="requirements" class="form-control" rows="3">{{ old('requirements') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Data inizio</label>
                        <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Data fine</label>
                        <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Lingua</label>
                        <input type="text" name="language" class="form-control" value="{{ old('language') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Modalità</label>
                        <input type="text" name="delivery_mode" class="form-control" value="{{ old('delivery_mode') }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Immagine</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="text-muted">Dimensione massima: 2MB</small>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Categoria</label>
                        <select name="category_id" class="form-select">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Livello</label>
                        <select name="level_id" class="form-select">
                            @foreach ($levels as $level)
                                <option value="{{ $level->id }}" {{ old('level_id') == $level->id ? 'selected' : '' }}>
                                    {{ $level->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Insegnante</label>
                        <select name="teacher_id" class="form-select">
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}"
                                    {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }} {{ $teacher->surname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Crea Corso</button>
            </form>
        </div>
    </div>
@endsection
