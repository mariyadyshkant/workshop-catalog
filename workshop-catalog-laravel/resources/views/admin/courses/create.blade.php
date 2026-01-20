<h1>Crea Nuovo Corso</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li style="color:red">{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('courses.store') }}">
    @csrf

    <label>Titolo</label>
    <input type="text" name="title">
    <br>
    <label>Descrizione</label>
    <textarea name="description"></textarea>
    <br>
    <label>Durata (in ore)</label>
    <input type="number" name="duration_hours">
    <br>
    <label>Requisiti</label>
    <textarea name="requirements"></textarea>
    <br>
    <label>Stato</label>
    <input type="text" name="status">
    <br>
    <label>Data inizio</label>
    <input type="date" name="start_date">
    <br>
    <label>Data fine</label>
    <input type="date" name="end_date">
    <br>
    <label>Lingua</label>
    <input type="text" name="language">
    <br>
    <label>Modalità</label>
    <input type="text" name="delivery_mode">
    <br>
    <label>Categoria</label>
    <select name="category_id">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    <br>
    <label>Livello</label>
    <select name="level_id">
        @foreach ($levels as $level)
            <option value="{{ $level->id }}">
                {{ $level->name }}
            </option>
        @endforeach
    </select>
    <br>
    <label>Insegnante</label>
    <select name="teacher_id">
        @foreach ($teachers as $teacher)
            <option value="{{ $teacher->id }}">
                {{ $teacher->name }} {{ $teacher->surname }}
            </option>
        @endforeach
    </select>
    <br>
    <button type="submit">Crea Corso</button>
</form>
