@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Lista Livelli</h1>
        <a href="{{ route('levels.create') }}" class="btn btn-primary">Crea Nuovo Livello</a>
    </div>

    @if ($levels->isEmpty())
        <p class="text-muted">Nessun livello disponibile.</p>
    @else
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th style="width: 250px;">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($levels as $level)
                    <tr>
                        <td>{{ $level->name }}</td>
                        <td style="width: 250px;">
                            <a href="{{ route('levels.show', $level->id) }}"
                                class="btn btn-sm btn-outline-primary">Dettaglio</a>
                            <a href="{{ route('levels.edit', $level->id) }}"
                                class="btn btn-sm btn-outline-warning">Modifica</a>
                            <form action="{{ route('levels.destroy', $level->id) }}" method="POST" style="display:inline"
                                onsubmit="return confirm('Sei sicuro?')">
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
