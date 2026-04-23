@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Dettaglio Insegnante</h1>
        <div>
            <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-warning">Modifica</a>
            <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Torna alla lista</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <td>{{ $teacher->id }}</td>
                </tr>
                <tr>
                    <th>Nome</th>
                    <td>{{ $teacher->name }}</td>
                </tr>
                <tr>
                    <th>Cognome</th>
                    <td>{{ $teacher->surname }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $teacher->email }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
