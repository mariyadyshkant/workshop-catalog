@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Dettaglio Livello</h1>
        <div>
            <a href="{{ route('levels.edit', $level->id) }}" class="btn btn-warning">Modifica</a>
            <a href="{{ route('levels.index') }}" class="btn btn-secondary">Torna alla lista</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <td>{{ $level->id }}</td>
                </tr>
                <tr>
                    <th>Nome</th>
                    <td>{{ $level->name }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
