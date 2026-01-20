<h1>Lista Corsi</h1>
<a href="{{ route('courses.create')}}">
    Crea Nuovo Corso
</a>

@if ($courses->isEmpty())
    <p>Nessun corso disponibile.</p>
@else
    <ul>
        @foreach ($courses as $course)
            <li>
                <strong>{{ $course->title }}</strong>
                <br>
                Categoria: {{ $course->category->name }}
                <br>
                Livello: {{ $course->level->name }}
                <br>
                Insegnante: {{ $course->teacher->name}} {{ $course->teacher->surname}}
            </li>
            <a href="{{ route('courses.edit', $course->id)}}">Modifica</a>
            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Sei sicuro di voler eliminare questo corso?')">
                @csrf
                @method('DELETE')
                <button type="submit">Elimina Corso</button>
            </form>
        @endforeach
    </ul>
@endif