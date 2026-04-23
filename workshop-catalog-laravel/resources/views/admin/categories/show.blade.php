@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Dettaglio Categoria</h1>
        <div>
            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Modifica</a>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Torna alla lista</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <td>{{ $category->id }}</td>
                </tr>
                <tr>
                    <th>Nome</th>
                    <td>{{ $category->name }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
