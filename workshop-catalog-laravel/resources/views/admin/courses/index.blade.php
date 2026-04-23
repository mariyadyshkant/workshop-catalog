@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Lista Corsi</h1>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">Crea Nuovo Corso</a>
    </div>

    @if ($courses->isEmpty())
        <p class="text-muted">Nessun corso disponibile.</p>
    @else
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Titolo</th>
                    <th>Categoria</th>
                    <th>Livello</th>
                    <th>Insegnante</th>
                    <th style="width: 250px;">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td>{{ $course->title }}</td>
                        <td>{{ $course->category->name }}</td>
                        <td>{{ $course->level->name }}</td>
                        <td>{{ $course->teacher->name }} {{ $course->teacher->surname }}</td>
                        <td style="width: 250px;">
                            <a href="{{ route('courses.show', $course->id) }}"
                                class="btn btn-sm btn-outline-primary">Dettaglio</a>
                            <a href="{{ route('courses.edit', $course->id) }}"
                                class="btn btn-sm btn-outline-warning">Modifica</a>
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline"
                                onsubmit="return confirm('Sei sicuro di voler eliminare questo corso?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Elimina</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
