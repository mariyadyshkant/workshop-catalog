@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Lista Insegnanti</h1>
        <a href="{{ route('teachers.create') }}" class="btn btn-primary">Crea Nuovo Insegnante</a>
    </div>

    @if ($teachers->isEmpty())
        <p class="text-muted">Nessun insegnante disponibile.</p>
    @else
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>Email</th>
                    <th style="width: 250px;">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->surname }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td style="width: 250px;">
                            <a href="{{ route('teachers.show', $teacher->id) }}"
                                class="btn btn-sm btn-outline-primary">Dettaglio</a>
                            <a href="{{ route('teachers.edit', $teacher->id) }}"
                                class="btn btn-sm btn-outline-warning">Modifica</a>
                            <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST"
                                style="display:inline" onsubmit="return confirm('Sei sicuro?')">
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
