@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Dettaglio Corso</h1>
        <div>
            <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning">Modifica</a>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary">Torna alla lista</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Titolo</th>
                    <td>{{ $course->title }}</td>
                </tr>
                <tr>
                    <th>Descrizione</th>
                    <td>{{ $course->description }}</td>
                </tr>
                <tr>
                    <th>Categoria</th>
                    <td>{{ $course->category->name }}</td>
                </tr>
                <tr>
                    <th>Livello</th>
                    <td>{{ $course->level->name }}</td>
                </tr>
                <tr>
                    <th>Insegnante</th>
                    <td>{{ $course->teacher->name }} {{ $course->teacher->surname }}</td>
                </tr>
                <tr>
                    <th>Durata</th>
                    <td>{{ $course->duration_hours }} ore</td>
                </tr>
                <tr>
                    <th>Stato</th>
                    <td>{{ $course->status }}</td>
                </tr>
                <tr>
                    <th>Lingua</th>
                    <td>{{ $course->language }}</td>
                </tr>
                <tr>
                    <th>Modalità</th>
                    <td>{{ $course->delivery_mode }}</td>
                </tr>
                <tr>
                    <th>Immagine</th>
                    <td>
                        @if ($course->image)
                            <img src="{{ asset('storage/' . $course->image) }}" alt="Immagine corso"
                                style="max-width: 200px">
                        @else
                            <span class="text-muted">Nessuna immagine</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Data inizio</th>
                    <td>{{ $course->start_date }}</td>
                </tr>
                <tr>
                    <th>Data fine</th>
                    <td>{{ $course->end_date ?? 'N/A' }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
