@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Lista Categorie</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Crea Nuova Categoria</a>
    </div>

    @if ($categories->isEmpty())
        <p class="text-muted">Nessuna categoria disponibile.</p>
    @else
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th style="width: 250px;">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td style="width: 250px;">
                            <a href="{{ route('categories.show', $category->id) }}"
                                class="btn btn-sm btn-outline-primary">Dettaglio</a>
                            <a href="{{ route('categories.edit', $category->id) }}"
                                class="btn btn-sm btn-outline-warning">Modifica</a>

                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
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
