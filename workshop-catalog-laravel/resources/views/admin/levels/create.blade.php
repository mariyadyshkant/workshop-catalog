@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Crea Nuovo Livello</h1>
        <a href="{{ route('levels.index') }}" class="btn btn-secondary">Torna alla lista</a>
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
            <form method="POST" action="{{ route('levels.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                </div>
                <button type="submit" class="btn btn-primary">Crea Livello</button>
            </form>
        </div>
    </div>
@endsection
