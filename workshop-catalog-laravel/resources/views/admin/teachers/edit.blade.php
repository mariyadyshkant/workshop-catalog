@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Modifica Insegnante</h1>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Torna alla lista</a>
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
            <form method="POST" action="{{ route('teachers.update', $teacher->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $teacher->name) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Cognome</label>
                    <input type="text" name="surname" class="form-control"
                        value="{{ old('surname', $teacher->surname) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $teacher->email) }}">
                </div>
                <button type="submit" class="btn btn-primary">Aggiorna Insegnante</button>
            </form>
        </div>
    </div>
@endsection
