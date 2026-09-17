@extends('layouts.admin')

@section('content')
    <div class="mb-4">
        <h1 class="h3 mb-1">Bentornato, {{ auth()->user()->name }}</h1>
        <p class="text-muted mb-0">Ecco un riepilogo del catalogo.</p>
    </div>

    {{-- Statistiche --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <a href="{{ route('courses.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <small class="text-muted text-uppercase fw-bold">Corsi</small>
                        <div class="fs-2 fw-bold text-dark">{{ $stats['courses'] }}</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a href="{{ route('categories.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <small class="text-muted text-uppercase fw-bold">Categorie</small>
                        <div class="fs-2 fw-bold text-dark">{{ $stats['categories'] }}</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a href="{{ route('levels.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <small class="text-muted text-uppercase fw-bold">Livelli</small>
                        <div class="fs-2 fw-bold text-dark">{{ $stats['levels'] }}</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a href="{{ route('teachers.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <small class="text-muted text-uppercase fw-bold">Insegnanti</small>
                        <div class="fs-2 fw-bold text-dark">{{ $stats['teachers'] }}</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    {{-- Azioni rapide --}}
    <div class="mb-4">
        <h2 class="h6 text-uppercase text-muted mb-3">Azioni rapide</h2>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('courses.create') }}" class="btn btn-primary btn-sm">+ Nuovo corso</a>
            <a href="{{ route('categories.create') }}" class="btn btn-outline-secondary btn-sm">+ Nuova categoria</a>
            <a href="{{ route('levels.create') }}" class="btn btn-outline-secondary btn-sm">+ Nuovo livello</a>
            <a href="{{ route('teachers.create') }}" class="btn btn-outline-secondary btn-sm">+ Nuovo insegnante</a>
        </div>
    </div>

    {{-- Ultimi corsi --}}
    <div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h6 text-uppercase text-muted mb-0">Ultimi corsi aggiunti</h2>
            <a href="{{ route('courses.index') }}" class="small">Vedi tutti →</a>
        </div>

        @if ($latestCourses->isEmpty())
            <p class="text-muted">Nessun corso disponibile.</p>
        @else
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Titolo</th>
                        <th>Categoria</th>
                        <th>Stato</th>
                        <th style="width: 100px;">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($latestCourses as $course)
                        <tr>
                            <td>{{ $course->title }}</td>
                            <td>{{ $course->category->name }}</td>
                            <td>{{ $course->status }}</td>
                            <td>
                                <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-outline-warning">Modifica</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
